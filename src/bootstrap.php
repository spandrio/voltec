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

require_once __DIR__ . '/persistence/ProductoRepository.php';
require_once __DIR__ . '/persistence/CategoriaRepository.php';
require_once __DIR__ . '/persistence/UsuarioRepository.php';

require_once __DIR__ . '/services/ProductoService.php';
require_once __DIR__ . '/services/AuthService.php';

require_once __DIR__ . '/controllers/ProductosController.php';
require_once __DIR__ . '/controllers/AuthController.php';

$db = new Database();

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->add(logMiddleware(...));

$renderer = new PhpRenderer(
  templatePath: __DIR__ . "/views",
  attributes: ["title" => "Voltec Ergon"],
);

$productoRepository = new ProductoRepository($db);
$categoriaRepository = new CategoriaRepository($db);
$usuarioRepository = new UsuarioRepository($db);

$productoService = new ProductoService($productoRepository, $categoriaRepository);
$authService = new AuthService($usuarioRepository);

$productosController = new ProductosController($renderer, $productoService);
$authController = new AuthController($renderer, $authService);

$app->get("/", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "index.php");
});

require __DIR__ . '/routes/productos.routes.php';
require __DIR__ . '/routes/auth.routes.php';

$app->addErrorMiddleware($debug, true, true);

return $app;
