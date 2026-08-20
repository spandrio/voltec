<?php

use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Cargar variables de entorno desde el .env
Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();

$env = $_ENV["APP_ENV"] ?? "prod";
$allowedEnvs = ["dev", "prod"];

if (!in_array($env, $allowedEnvs, true)) {
  throw new RuntimeException("APP_ENV inválido: $env");
}

$debug = $env === "dev";

// Crear la aplicacion de Slim
$app = AppFactory::create();

// Necesario para poder leer $request->getParsedBody() en los POST de formularios
$app->addBodyParsingMiddleware();

// Crear el motor de plantillas
$renderer = new PhpRenderer(
  templatePath: __DIR__ . "/views",
  attributes: ["title" => "PDI | Slim Template 2026"],
);

// Ruta/Vista principal
$app->get("/", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "index.php");
});


// NUEVAS RUTAS DEL TP 7

// Array asociativo con el listado de productos (todavía no viene de una base de datos)
$productos = [
  ['id' => 1, 'name' => 'Toma inteligente Eco Smart Grid', 'price' => 45000],
  ['id' => 2, 'name' => 'Sensor PZEM-004T V3.0', 'price' => 18500],
  ['id' => 3, 'name' => 'Módulo relé de alta capacidad', 'price' => 9200],
  ['id' => 4, 'name' => 'Pantalla OLED 0.96"', 'price' => 6800],
  ['id' => 5, 'name' => 'Carcasa impresa en 3D', 'price' => 4300],
  ['id' => 6, 'name' => 'Kit de instalación completo', 'price' => 72000],
];

// Listado de productos
$app->get("/entidad", function ($request, $response) use ($renderer, $productos) {
  $totalDisponible = count($productos);

  // Query param ?limit= — solo se aplica si es un entero positivo
  $limitParam = $request->getQueryParams()["limit"] ?? null;
  $limit = null;

  if ($limitParam !== null && is_numeric($limitParam) && (int) $limitParam > 0) {
    $limit = (int) $limitParam;
  }

  $listado = $limit !== null ? array_slice($productos, 0, $limit) : $productos;

  return view($renderer, $response, "entidad/index.php", [
    "productos" => $listado,
    "totalDisponible" => $totalDisponible,
    "limit" => $limit,
  ]);
});

// Detalle de un producto
$app->get("/entidad/{id}", function ($request, $response, $args) use ($renderer) {
  $id = $args["id"];

  return view($renderer, $response, "entidad/show.php", [
    "id" => $id
  ]);
});

// Formulario para crear un producto
$app->get("/create/entidad", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "entidad/store.php");
});

// Recibe el formulario y muestra los datos enviados
$app->post("/entidad", function ($request, $response) use ($renderer) {
  $data = $request->getParsedBody() ?? [];

  $nombre = trim($data["nombre"] ?? "");
  $precio = trim($data["precio"] ?? "");
  $descripcion = trim($data["descripcion"] ?? "");

  // Validación mínima
  $errores = [];
  if ($nombre === "") {
    $errores[] = "El nombre es obligatorio.";
  }
  if ($precio === "" || !is_numeric($precio) || (float) $precio < 0) {
    $errores[] = "El precio debe ser un número válido mayor o igual a 0.";
  }

  if (!empty($errores)) {
    return view($renderer, $response->withStatus(422), "entidad/store.php", [
      "errores" => $errores,
      "old" => $data,
    ]);
  }

  return view($renderer, $response, "entidad/created.php", [
    "nombre" => $nombre,
    "precio" => $precio,
    "descripcion" => $descripcion,
  ]);
});


$app->addErrorMiddleware($debug, true, true);

return $app;