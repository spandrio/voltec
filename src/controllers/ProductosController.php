<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class ProductosController
{
  public function __construct(
    private readonly PhpRenderer $renderer,
    private readonly ProductoService $productos,
  ) {}

  public function index(Request $request, Response $response): Response
  {
    $limitParam = $request->getQueryParams()["limit"] ?? null;
    $limit = null;

    if ($limitParam !== null && is_numeric($limitParam) && (int) $limitParam > 0) {
      $limit = (int) $limitParam;
    }

    $datos = $this->productos->listar($limit);

    return view($this->renderer, $response, "entidad/index.php", [
      "productos" => $datos["productos"],
      "totalDisponible" => $datos["totalDisponible"],
      "limit" => $limit,
    ]);
  }

  public function create(Request $request, Response $response): Response
  {
    return view($this->renderer, $response, "entidad/create.php", [
      "categorias" => $this->productos->categorias(),
    ]);
  }

  public function edit(Request $request, Response $response, array $args): Response
  {
    $id = $args["id"];

    if (!is_numeric($id)) {
      return view($this->renderer, $response->withStatus(404), "entidad/not_found.php", ["id" => $id]);
    }

    $producto = $this->productos->obtenerParaEditar((int) $id);

    if ($producto === null) {
      return view($this->renderer, $response->withStatus(404), "entidad/not_found.php", ["id" => $id]);
    }

    return view($this->renderer, $response, "entidad/update.php", [
      "producto" => $producto,
      "categorias" => $this->productos->categorias(),
    ]);
  }

  public function show(Request $request, Response $response, array $args): Response
  {
    $id = $args["id"];

    if (!is_numeric($id)) {
      return view($this->renderer, $response->withStatus(404), "entidad/not_found.php", ["id" => $id]);
    }

    $producto = $this->productos->obtener((int) $id);

    if ($producto === null) {
      return view($this->renderer, $response->withStatus(404), "entidad/not_found.php", ["id" => $id]);
    }

    return view($this->renderer, $response, "entidad/show.php", ["producto" => $producto]);
  }

  public function store(Request $request, Response $response): Response
  {
    $data = $request->getParsedBody() ?? [];

    $resultado = $this->productos->crear($data);

    if (!empty($resultado["errores"])) {
      return view($this->renderer, $response->withStatus(422), "entidad/create.php", [
        "errores" => $resultado["errores"],
        "old" => $data,
        "categorias" => $this->productos->categorias(),
      ]);
    }

    return $response->withHeader("Location", "/entidad/{$resultado['id']}")->withStatus(303);
  }

  public function update(Request $request, Response $response, array $args): Response
  {
    $id = (int) $args["id"];
    $data = $request->getParsedBody() ?? [];

    $resultado = $this->productos->actualizar($id, $data);

    if ($resultado["notFound"]) {
      $response->getBody()->write(json_encode(["error" => "El producto no existe."]));
      return $response->withHeader("Content-Type", "application/json")->withStatus(404);
    }

    if (!empty($resultado["errores"])) {
      $response->getBody()->write(json_encode(["errores" => $resultado["errores"]]));
      return $response->withHeader("Content-Type", "application/json")->withStatus(422);
    }

    $response->getBody()->write(json_encode(["id" => $id]));
    return $response->withHeader("Content-Type", "application/json")->withStatus(200);
  }

  public function destroy(Request $request, Response $response, array $args): Response
  {
    $id = (int) $args["id"];

    $eliminado = $this->productos->eliminar($id);

    if (!$eliminado) {
      $response->getBody()->write(json_encode(["error" => "El producto no existe."]));
      return $response->withHeader("Content-Type", "application/json")->withStatus(404);
    }

    $response->getBody()->write(json_encode(["ok" => true]));
    return $response->withHeader("Content-Type", "application/json")->withStatus(200);
  }
}
