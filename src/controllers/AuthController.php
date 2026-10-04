<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class AuthController
{
  public function __construct(
    private readonly PhpRenderer $renderer,
    private readonly AuthService $auth,
  ) {}

  public function showRegister(Request $request, Response $response): Response
  {
    return view($this->renderer, $response, "auth/register.php");
  }

  public function register(Request $request, Response $response): Response
  {
    $data = $request->getParsedBody() ?? [];

    $resultado = $this->auth->registrar($data);

    if (!empty($resultado["errores"])) {
      return view($this->renderer, $response->withStatus(422), "auth/register.php", [
        "errores" => $resultado["errores"],
        "old" => $data,
      ]);
    }

    return $response->withHeader("Location", "/auth/login?registrado=1")->withStatus(303);
  }

  public function showLogin(Request $request, Response $response): Response
  {
    $params = $request->getQueryParams();

    return view($this->renderer, $response, "auth/login.php", [
      "registrado" => ($params["registrado"] ?? "") === "1",
      "redirect" => $params["redirect"] ?? null,
    ]);
  }

  public function login(Request $request, Response $response): Response
  {
    $data = $request->getParsedBody() ?? [];

    $email = trim((string) ($data["email"] ?? ""));
    $password = (string) ($data["password"] ?? "");
    $redirect = $data["redirect"] ?? null;

    $resultado = $this->auth->autenticar($email, $password);

    if (!empty($resultado["errores"])) {
      return view($this->renderer, $response->withStatus(422), "auth/login.php", [
        "errores" => $resultado["errores"],
        "old" => $data,
        "redirect" => $redirect,
      ]);
    }

    $usuario = $resultado["usuario"];

    session_regenerate_id(true);
    $_SESSION["user_id"] = $usuario["id"];
    $_SESSION["user_nombre"] = $usuario["nombre"];

    $destino = is_string($redirect) && str_starts_with($redirect, "/") ? $redirect : "/entidad";

    return $response->withHeader("Location", $destino)->withStatus(303);
  }

  public function logout(Request $request, Response $response): Response
  {
    $_SESSION = [];
    session_destroy();

    return $response->withHeader("Location", "/auth/login")->withStatus(303);
  }
}
