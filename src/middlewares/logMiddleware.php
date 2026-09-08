<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

/**
 * src/middlewares/logMiddleware.php
 * TP N°12 | Middlewares
 *
 * Middleware global que registra cada request: fecha/hora, método HTTP,
 * ruta solicitada, código de estado de la respuesta y tiempo de ejecución
 * en milisegundos. Se registra tanto por consola (STDOUT, visible con
 * `composer serve`) como en un archivo .log dentro de storage/logs/.
 *
 * No modifica la respuesta: simplemente la deja pasar.
 */
function logMiddleware(Request $request, RequestHandler $handler): Response
{
  // 1. Registrar el tiempo inicial ANTES de ejecutar la ruta.
  $inicio = microtime(true);

  // 2. Permitir que la ruta se ejecute y obtener su respuesta.
  $response = $handler->handle($request);

  // 3. Calcular cuánto tiempo tardó en ejecutarse, en milisegundos.
  $duracionMs = (microtime(true) - $inicio) * 1000;

  // 4. Construir la línea de log.
  $fecha = date('Y-m-d H:i:s');
  $metodo = $request->getMethod();
  $ruta = (string) $request->getUri()->getPath();
  $query = $request->getUri()->getQuery();
  if ($query !== '') {
    $ruta .= '?' . $query;
  }
  $status = $response->getStatusCode();

  $linea = sprintf(
    '[%s] %s %s -> %d (%.2fms)',
    $fecha,
    $metodo,
    $ruta,
    $status,
    $duracionMs,
  );

  // 5. Imprimir en la consola y escribir la línea de log al final de un archivo .log.
  // No se usa la constante STDOUT porque el servidor embebido de PHP
  // (`php -S`, usado por `composer serve`) no la define.
  $stdout = fopen('php://stdout', 'wb');
  fwrite($stdout, $linea . PHP_EOL);
  fclose($stdout);

  $logDir = dirname(__DIR__, 2) . '/storage/logs';
  if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
  }

  file_put_contents($logDir . '/app.log', $linea . PHP_EOL, FILE_APPEND | LOCK_EX);

  // 6. Devolver la respuesta SIN MODIFICAR.
  return $response;
}
