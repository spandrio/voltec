<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

function logMiddleware(Request $request, RequestHandler $handler): Response
{
  $inicio = microtime(true);

  $response = $handler->handle($request);

  $duracionMs = (microtime(true) - $inicio) * 1000;

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

  $stdout = fopen('php://stdout', 'wb');
  fwrite($stdout, $linea . PHP_EOL);
  fclose($stdout);

  $logDir = dirname(__DIR__, 2) . '/storage/logs';
  if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
  }

  file_put_contents($logDir . '/app.log', $linea . PHP_EOL, FILE_APPEND | LOCK_EX);

  return $response;
}
