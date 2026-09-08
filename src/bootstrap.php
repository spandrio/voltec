<?php

use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();

$env = $_ENV["APP_ENV"] ?? "prod";
$allowedEnvs = ["dev", "prod"];

if (!in_array($env, $allowedEnvs, true)) {
  throw new RuntimeException("APP_ENV inválido: $env");
}

$debug = $env === "dev";

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/middlewares/logMiddleware.php';
require_once __DIR__ . '/middlewares/authMiddleware.php';

$db = new Database();

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

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->add(logMiddleware(...));

$renderer = new PhpRenderer(
  templatePath: __DIR__ . "/views",
  attributes: ["title" => "Voltec Ergon"],
);

$app->get("/", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "index.php");
});

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


$app->get("/auth/register", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "auth/register.php");
});

$app->post("/auth/register", function ($request, $response) use ($renderer, $db) {
  $data = $request->getParsedBody() ?? [];

  $nombre = trim((string) ($data["nombre"] ?? ""));
  $email = trim((string) ($data["email"] ?? ""));
  $password = (string) ($data["password"] ?? "");
  $passwordConfirmacion = (string) ($data["password_confirmation"] ?? "");

  $errores = [];

  if ($nombre === "") {
    $errores[] = "El nombre es obligatorio.";
  }

  if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "Ingresá un email válido.";
  }

  if (strlen($password) < 8) {
    $errores[] = "La contraseña debe tener al menos 8 caracteres.";
  }

  if ($password !== $passwordConfirmacion) {
    $errores[] = "Las contraseñas no coinciden.";
  }

  if (empty($errores)) {
    $stmt = $db->getConnection()->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute([":email" => $email]);

    if ($stmt->fetch() !== false) {
      $errores[] = "Ya existe una cuenta registrada con ese email.";
    }
  }

  if (!empty($errores)) {
    return view($renderer, $response->withStatus(422), "auth/register.php", [
      "errores" => $errores,
      "old" => $data,
    ]);
  }

  $db->runTransaction(function (PDO $conn) use ($nombre, $email, $password) {
    $stmt = $conn->prepare(
      "INSERT INTO usuarios (nombre, email, password_hash) VALUES (:nombre, :email, :password_hash)"
    );
    $stmt->execute([
      ":nombre" => $nombre,
      ":email" => $email,
      ":password_hash" => password_hash($password, PASSWORD_DEFAULT),
    ]);
  });

  return $response->withHeader("Location", "/auth/login?registrado=1")->withStatus(303);
});

$app->get("/auth/login", function ($request, $response) use ($renderer) {
  $params = $request->getQueryParams();

  return view($renderer, $response, "auth/login.php", [
    "registrado" => ($params["registrado"] ?? "") === "1",
    "redirect" => $params["redirect"] ?? null,
  ]);
});

$app->post("/auth/login", function ($request, $response) use ($renderer, $db) {
  $data = $request->getParsedBody() ?? [];

  $email = trim((string) ($data["email"] ?? ""));
  $password = (string) ($data["password"] ?? "");
  $redirect = $data["redirect"] ?? null;

  $errores = [];
  $usuario = null;

  if ($email === "" || $password === "") {
    $errores[] = "Ingresá tu email y contraseña.";
  } else {
    $stmt = $db->getConnection()->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute([":email" => $email]);
    $usuario = $stmt->fetch();

    if ($usuario === false || !password_verify($password, $usuario["password_hash"])) {
      $errores[] = "Email o contraseña incorrectos.";
      $usuario = null;
    }
  }

  if (!empty($errores) || $usuario === null) {
    return view($renderer, $response->withStatus(422), "auth/login.php", [
      "errores" => $errores,
      "old" => $data,
      "redirect" => $redirect,
    ]);
  }

  session_regenerate_id(true);
  $_SESSION["user_id"] = $usuario["id"];
  $_SESSION["user_nombre"] = $usuario["nombre"];

  $destino = is_string($redirect) && str_starts_with($redirect, "/") ? $redirect : "/entidad";

  return $response->withHeader("Location", $destino)->withStatus(303);
});

$app->get("/auth/logout", function ($request, $response) {
  $_SESSION = [];
  session_destroy();

  return $response->withHeader("Location", "/auth/login")->withStatus(303);
});


$app->addErrorMiddleware($debug, true, true);

return $app;
