<?php

function validarProducto(array $data): array
{
  $errores = [];

  $nombre = trim((string) ($data["nombre"] ?? ""));
  $precio = $data["precio"] ?? "";
  $stock = $data["stock"] ?? "";
  $categoriaIdRaw = $data["categoria_id"] ?? "";
  $descripcion = trim((string) ($data["descripcion"] ?? ""));
  $disponible = !empty($data["disponible"]);

  if ($nombre === "") {
    $errores[] = "El nombre es obligatorio.";
  }

  if ($precio === "" || $precio === null || !is_numeric($precio) || (float) $precio < 0) {
    $errores[] = "El precio debe ser un número válido mayor o igual a 0.";
  }

  if ($stock === "" || $stock === null || !is_numeric($stock) || (int) $stock < 0) {
    $errores[] = "El stock debe ser un número entero mayor o igual a 0.";
  }

  $categoriaId = null;
  if ($categoriaIdRaw !== "" && $categoriaIdRaw !== null) {
    if (!is_numeric($categoriaIdRaw)) {
      $errores[] = "La categoría seleccionada no es válida.";
    } else {
      $categoriaId = (int) $categoriaIdRaw;
    }
  }

  $valores = [
    "nombre" => $nombre,
    "precio" => $precio !== "" && $precio !== null && is_numeric($precio) ? (float) $precio : 0,
    "stock" => $stock !== "" && $stock !== null && is_numeric($stock) ? (int) $stock : 0,
    "categoria_id" => $categoriaId,
    "descripcion" => $descripcion,
    "disponible" => $disponible,
  ];

  return [$errores, $valores];
}

$app->get("/entidad", function ($request, $response) use ($renderer, $db) {
  $totalDisponible = (int) $db->getConnection()->query("SELECT COUNT(*) FROM productos")->fetchColumn();

  $limitParam = $request->getQueryParams()["limit"] ?? null;
  $limit = null;

  if ($limitParam !== null && is_numeric($limitParam) && (int) $limitParam > 0) {
    $limit = (int) $limitParam;
  }

  $sql = "SELECT p.*, c.nombre AS categoria_nombre
          FROM productos p
          LEFT JOIN categorias c ON c.id = p.categoria_id
          ORDER BY p.id DESC";

  if ($limit !== null) {
    $sql .= " LIMIT :limit";
  }

  $stmt = $db->getConnection()->prepare($sql);

  if ($limit !== null) {
    $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
  }

  $stmt->execute();
  $productos = $stmt->fetchAll();

  return view($renderer, $response, "entidad/index.php", [
    "productos" => $productos,
    "totalDisponible" => $totalDisponible,
    "limit" => $limit,
  ]);
});

$app->get("/entidad/create", function ($request, $response) use ($renderer, $db) {
  $categorias = $db->getConnection()->query("SELECT id, nombre FROM categorias ORDER BY nombre")->fetchAll();

  return view($renderer, $response, "entidad/create.php", [
    "categorias" => $categorias,
  ]);
})->add(authMiddleware(...));

$app->get("/entidad/update/{id}", function ($request, $response, $args) use ($renderer, $db) {
  $id = $args["id"];

  if (!is_numeric($id)) {
    return view($renderer, $response->withStatus(404), "entidad/not_found.php", ["id" => $id]);
  }

  $stmt = $db->getConnection()->prepare("SELECT * FROM productos WHERE id = :id");
  $stmt->execute([":id" => (int) $id]);
  $producto = $stmt->fetch();

  if ($producto === false) {
    return view($renderer, $response->withStatus(404), "entidad/not_found.php", ["id" => $id]);
  }

  $categorias = $db->getConnection()->query("SELECT id, nombre FROM categorias ORDER BY nombre")->fetchAll();

  return view($renderer, $response, "entidad/update.php", [
    "producto" => $producto,
    "categorias" => $categorias,
  ]);
})->add(authMiddleware(...));

$app->get("/entidad/{id}", function ($request, $response, $args) use ($renderer, $db) {
  $id = $args["id"];

  if (!is_numeric($id)) {
    return view($renderer, $response->withStatus(404), "entidad/not_found.php", ["id" => $id]);
  }

  $stmt = $db->getConnection()->prepare(
    "SELECT p.*, c.nombre AS categoria_nombre
     FROM productos p
     LEFT JOIN categorias c ON c.id = p.categoria_id
     WHERE p.id = :id"
  );
  $stmt->execute([":id" => (int) $id]);
  $producto = $stmt->fetch();

  if ($producto === false) {
    return view($renderer, $response->withStatus(404), "entidad/not_found.php", ["id" => $id]);
  }

  return view($renderer, $response, "entidad/show.php", ["producto" => $producto]);
});

$app->post("/entidad", function ($request, $response) use ($renderer, $db) {
  $data = $request->getParsedBody() ?? [];

  [$errores, $valores] = validarProducto($data);

  if (!empty($errores)) {
    $categorias = $db->getConnection()->query("SELECT id, nombre FROM categorias ORDER BY nombre")->fetchAll();

    return view($renderer, $response->withStatus(422), "entidad/create.php", [
      "errores" => $errores,
      "old" => $data,
      "categorias" => $categorias,
    ]);
  }

  $id = $db->runTransaction(function (PDO $conn) use ($valores) {
    $stmt = $conn->prepare(
      "INSERT INTO productos (categoria_id, nombre, precio, stock, disponible, descripcion)
       VALUES (:categoria_id, :nombre, :precio, :stock, :disponible, :descripcion)"
    );
    $stmt->execute([
      ":categoria_id" => $valores["categoria_id"],
      ":nombre" => $valores["nombre"],
      ":precio" => $valores["precio"],
      ":stock" => $valores["stock"],
      ":disponible" => $valores["disponible"] ? 1 : 0,
      ":descripcion" => $valores["descripcion"],
    ]);

    return (int) $conn->lastInsertId();
  });

  return $response->withHeader("Location", "/entidad/{$id}")->withStatus(303);
})->add(authMiddleware(...));

$app->put("/entidad/{id}", function ($request, $response, $args) use ($db) {
  $id = (int) $args["id"];
  $data = $request->getParsedBody() ?? [];

  $stmtCheck = $db->getConnection()->prepare("SELECT id FROM productos WHERE id = :id");
  $stmtCheck->execute([":id" => $id]);

  if ($stmtCheck->fetch() === false) {
    $response->getBody()->write(json_encode(["error" => "El producto no existe."]));
    return $response->withHeader("Content-Type", "application/json")->withStatus(404);
  }

  [$errores, $valores] = validarProducto($data);

  if (!empty($errores)) {
    $response->getBody()->write(json_encode(["errores" => $errores]));
    return $response->withHeader("Content-Type", "application/json")->withStatus(422);
  }

  $db->runTransaction(function (PDO $conn) use ($id, $valores) {
    $stmt = $conn->prepare(
      "UPDATE productos
       SET categoria_id = :categoria_id, nombre = :nombre, precio = :precio,
           stock = :stock, disponible = :disponible, descripcion = :descripcion
       WHERE id = :id"
    );
    $stmt->execute([
      ":categoria_id" => $valores["categoria_id"],
      ":nombre" => $valores["nombre"],
      ":precio" => $valores["precio"],
      ":stock" => $valores["stock"],
      ":disponible" => $valores["disponible"] ? 1 : 0,
      ":descripcion" => $valores["descripcion"],
      ":id" => $id,
    ]);
  });

  $response->getBody()->write(json_encode(["id" => $id]));
  return $response->withHeader("Content-Type", "application/json")->withStatus(200);
})->add(authMiddleware(...));

$app->delete("/entidad/{id}", function ($request, $response, $args) use ($db) {
  $id = (int) $args["id"];

  $eliminado = $db->runTransaction(function (PDO $conn) use ($id) {
    $stmt = $conn->prepare("DELETE FROM productos WHERE id = :id");
    $stmt->execute([":id" => $id]);

    return $stmt->rowCount() > 0;
  });

  if (!$eliminado) {
    $response->getBody()->write(json_encode(["error" => "El producto no existe."]));
    return $response->withHeader("Content-Type", "application/json")->withStatus(404);
  }

  $response->getBody()->write(json_encode(["ok" => true]));
  return $response->withHeader("Content-Type", "application/json")->withStatus(200);
})->add(authMiddleware(...));
