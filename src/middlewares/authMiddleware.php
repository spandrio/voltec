<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;

/**
 * src/middlewares/authMiddleware.php
 * TP N°12 | Middlewares
 *
 * Protege rutas que requieren que el usuario haya iniciado sesión.
 * Se agrega individualmente a cada ruta que lo necesite con ->add(authMiddleware(...)).
 *
 * Si no hay sesión activa:
 *  - a los pedidos que esperan JSON (fetch de las vistas de edición/borrado) les
 *    responde 401 en JSON.
 *  - al resto (navegación normal del navegador) los redirige a /auth/login.
 */
function authMiddleware(Request $request, RequestHandler $handler): Response
{
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  if (!isset($_SESSION['user_id'])) {
    $aceptaJson = str_contains($request->getHeaderLine('Accept'), 'application/json')
      || str_contains($request->getHeaderLine('Content-Type'), 'application/json');

    $response = new SlimResponse();

    if ($aceptaJson) {
      $response->getBody()->write(json_encode([
        'error' => 'No autenticado. Iniciá sesión para continuar.',
      ]));

      return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(401);
    }

    $volverA = urlencode((string) $request->getUri()->getPath());

    return $response
      ->withHeader('Location', "/auth/login?redirect={$volverA}")
      ->withStatus(302);
  }

  return $handler->handle($request);
}
