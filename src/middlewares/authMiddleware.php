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
 */
function authMiddleware(Request $request, RequestHandler $handler): Response
{
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  $userId = $_SESSION['user_id'] ?? null;

  if ($userId === null || $userId === '') {
    // Las vistas de editar/borrar llaman a estas rutas con fetch() y esperan
    // JSON, así que un redirect normal no les sirve: si no, el fetch termina
    // devolviendo el HTML del login como si fuera la respuesta buena.
    $esFetch = str_contains($request->getHeaderLine('Accept'), 'application/json')
      || str_contains($request->getHeaderLine('Content-Type'), 'application/json');

    if ($esFetch) {
      $response = new SlimResponse();
      $response->getBody()->write(json_encode([
        'error' => 'No autenticado. Iniciá sesión para continuar.',
      ]));

      return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(401);
    }

    $volverA = urlencode((string) $request->getUri()->getPath());

    return (new SlimResponse())
      ->withHeader('Location', "/auth/login?redirect={$volverA}")
      ->withStatus(302);
  }

  $request = $request->withAttribute('user_id', $userId);

  return $handler->handle($request);
}
