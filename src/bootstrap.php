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

require __DIR__ . '/routes/productos.routes.php';
require __DIR__ . '/routes/auth.routes.php';

$app->addErrorMiddleware($debug, true, true);

return $app;
