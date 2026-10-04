<?php

declare(strict_types=1);

class ProductoRepository
{
  public function __construct(private readonly Database $database) {}

  public function contarDisponibles(): int
  {
    return (int) $this->database->getConnection()->query("SELECT COUNT(*) FROM productos")->fetchColumn();
  }

  public function listar(?int $limit): array
  {
    $sql = "SELECT p.*, c.nombre AS categoria_nombre
            FROM productos p
            LEFT JOIN categorias c ON c.id = p.categoria_id
            ORDER BY p.id DESC";

    if ($limit !== null) {
      $sql .= " LIMIT :limit";
    }

    $stmt = $this->database->getConnection()->prepare($sql);

    if ($limit !== null) {
      $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
    }

    $stmt->execute();

    return $stmt->fetchAll();
  }

  public function buscarPorId(int $id): array|false
  {
    $stmt = $this->database->getConnection()->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->execute([":id" => $id]);

    return $stmt->fetch();
  }

  public function buscarConCategoria(int $id): array|false
  {
    $stmt = $this->database->getConnection()->prepare(
      "SELECT p.*, c.nombre AS categoria_nombre
       FROM productos p
       LEFT JOIN categorias c ON c.id = p.categoria_id
       WHERE p.id = :id"
    );
    $stmt->execute([":id" => $id]);

    return $stmt->fetch();
  }

  public function existe(int $id): bool
  {
    $stmt = $this->database->getConnection()->prepare("SELECT id FROM productos WHERE id = :id");
    $stmt->execute([":id" => $id]);

    return $stmt->fetch() !== false;
  }

  public function crear(array $valores): int
  {
    return $this->database->runTransaction(function (PDO $conn) use ($valores) {
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
  }

  public function actualizar(int $id, array $valores): void
  {
    $this->database->runTransaction(function (PDO $conn) use ($id, $valores) {
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
  }

  public function eliminar(int $id): bool
  {
    return $this->database->runTransaction(function (PDO $conn) use ($id) {
      $stmt = $conn->prepare("DELETE FROM productos WHERE id = :id");
      $stmt->execute([":id" => $id]);

      return $stmt->rowCount() > 0;
    });
  }
}
