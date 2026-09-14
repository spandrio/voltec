<?php

$app->get("/auth/register", function ($request, $response) use ($renderer) {
  return view($renderer, $response, "auth/register.php");
});

$app->post("/auth/register", function ($request, $response) use ($renderer, $db) {
  $data = $request->getParsedBody() ?? [];

  $nombre = trim((string) ($data["nombre"] ?? ""));
  $email = trim((string) ($data["email"] ?? ""));
  $password = (string) ($data["password"] ?? "");
  $passwordConfirmacion = (string) ($data["password_confirmation"] ?? "");

  $errores = [];

  if ($nombre === "") {
    $errores[] = "El nombre es obligatorio.";
  }

  if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "Ingresá un email válido.";
  }

  if (strlen($password) < 8) {
    $errores[] = "La contraseña debe tener al menos 8 caracteres.";
  }

  if ($password !== $passwordConfirmacion) {
    $errores[] = "Las contraseñas no coinciden.";
  }

  if (empty($errores)) {
    $stmt = $db->getConnection()->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute([":email" => $email]);

    if ($stmt->fetch() !== false) {
      $errores[] = "Ya existe una cuenta registrada con ese email.";
    }
  }

  if (!empty($errores)) {
    return view($renderer, $response->withStatus(422), "auth/register.php", [
      "errores" => $errores,
      "old" => $data,
    ]);
  }

  $db->runTransaction(function (PDO $conn) use ($nombre, $email, $password) {
    $stmt = $conn->prepare(
      "INSERT INTO usuarios (nombre, email, password_hash) VALUES (:nombre, :email, :password_hash)"
    );
    $stmt->execute([
      ":nombre" => $nombre,
      ":email" => $email,
      ":password_hash" => password_hash($password, PASSWORD_DEFAULT),
    ]);
  });

  return $response->withHeader("Location", "/auth/login?registrado=1")->withStatus(303);
});

$app->get("/auth/login", function ($request, $response) use ($renderer) {
  $params = $request->getQueryParams();

  return view($renderer, $response, "auth/login.php", [
    "registrado" => ($params["registrado"] ?? "") === "1",
    "redirect" => $params["redirect"] ?? null,
  ]);
});

$app->post("/auth/login", function ($request, $response) use ($renderer, $db) {
  $data = $request->getParsedBody() ?? [];

  $email = trim((string) ($data["email"] ?? ""));
  $password = (string) ($data["password"] ?? "");
  $redirect = $data["redirect"] ?? null;

  $errores = [];
  $usuario = null;

  if ($email === "" || $password === "") {
    $errores[] = "Ingresá tu email y contraseña.";
  } else {
    $stmt = $db->getConnection()->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute([":email" => $email]);
    $usuario = $stmt->fetch();

    if ($usuario === false || !password_verify($password, $usuario["password_hash"])) {
      $errores[] = "Email o contraseña incorrectos.";
      $usuario = null;
    }
  }

  if (!empty($errores) || $usuario === null) {
    return view($renderer, $response->withStatus(422), "auth/login.php", [
      "errores" => $errores,
      "old" => $data,
      "redirect" => $redirect,
    ]);
  }

  session_regenerate_id(true);
  $_SESSION["user_id"] = $usuario["id"];
  $_SESSION["user_nombre"] = $usuario["nombre"];

  $destino = is_string($redirect) && str_starts_with($redirect, "/") ? $redirect : "/entidad";

  return $response->withHeader("Location", $destino)->withStatus(303);
});

$app->get("/auth/logout", function ($request, $response) {
  $_SESSION = [];
  session_destroy();

  return $response->withHeader("Location", "/auth/login")->withStatus(303);
});
