<?php

declare(strict_types=1);

class ProductoService
{
  public function __construct(
    private readonly ProductoRepository $productos,
    private readonly CategoriaRepository $categorias,
  ) {}

  public function categorias(): array
  {
    return $this->categorias->listar();
  }

  public function listar(?int $limit): array
  {
    return [
      "productos" => $this->productos->listar($limit),
      "totalDisponible" => $this->productos->contarDisponibles(),
    ];
  }

  public function obtener(int $id): array|null
  {
    $producto = $this->productos->buscarConCategoria($id);

    return $producto === false ? null : $producto;
  }

  public function obtenerParaEditar(int $id): array|null
  {
    $producto = $this->productos->buscarPorId($id);

    return $producto === false ? null : $producto;
  }

  public function validar(array $data): array
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

  public function crear(array $data): array
  {
    [$errores, $valores] = $this->validar($data);

    if (!empty($errores)) {
      return ["errores" => $errores, "id" => null];
    }

    return ["errores" => [], "id" => $this->productos->crear($valores)];
  }

  public function actualizar(int $id, array $data): array
  {
    if (!$this->productos->existe($id)) {
      return ["errores" => [], "notFound" => true];
    }

    [$errores, $valores] = $this->validar($data);

    if (!empty($errores)) {
      return ["errores" => $errores, "notFound" => false];
    }

    $this->productos->actualizar($id, $valores);

    return ["errores" => [], "notFound" => false];
  }

  public function eliminar(int $id): bool
  {
    return $this->productos->eliminar($id);
  }
}
