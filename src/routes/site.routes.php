<?php

use Psr\Http\Message\ServerRequestInterface;

function validarContacto(array $data): array
{
  $errores = [];

  $nombre = trim((string) ($data["nombre"] ?? ""));
  $email = trim((string) ($data["email"] ?? ""));
  $mensaje = trim((string) ($data["mensaje"] ?? ""));

  if ($nombre === "") {
    $errores[] = "Ingresá tu nombre.";
  }

  if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "Ingresá un email válido.";
  }

  if ($mensaje === "") {
    $errores[] = "Contanos brevemente qué necesitás.";
  }

  return $errores;
}

$app->get("/", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "site/home.php", ["active" => "/"], "layouts/site.php");
});

$app->get("/servicios", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "site/servicios.php", ["active" => "/servicios"], "layouts/site.php");
});

$app->get("/equipo", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "site/equipo.php", ["active" => "/equipo"], "layouts/site.php");
});

$app->get("/trabajos", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "site/trabajos.php", ["active" => "/trabajos"], "layouts/site.php");
});

$app->get("/contacto", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "site/contacto.php", ["active" => "/contacto"], "layouts/site.php");
});

$app->post("/contacto", function (ServerRequestInterface $request, $response) use ($renderer) {
  $data = $request->getParsedBody() ?? [];
  $errores = validarContacto($data);

  if (!empty($errores)) {
    return view($renderer, $response->withStatus(422), "site/contacto.php", [
      "active" => "/contacto",
      "errores" => $errores,
      "old" => $data,
    ], "layouts/site.php");
  }

  return view($renderer, $response, "site/contacto.php", [
    "active" => "/contacto",
    "enviado" => true,
  ], "layouts/site.php");
});
