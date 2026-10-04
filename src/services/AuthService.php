<?php

declare(strict_types=1);

class AuthService
{
  public function __construct(private readonly UsuarioRepository $usuarios) {}

  public function registrar(array $data): array
  {
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

    if (empty($errores) && $this->usuarios->existeEmail($email)) {
      $errores[] = "Ya existe una cuenta registrada con ese email.";
    }

    if (!empty($errores)) {
      return ["errores" => $errores];
    }

    $this->usuarios->crear($nombre, $email, password_hash($password, PASSWORD_DEFAULT));

    return ["errores" => []];
  }

  public function autenticar(string $email, string $password): array
  {
    if ($email === "" || $password === "") {
      return ["errores" => ["Ingresá tu email y contraseña."], "usuario" => null];
    }

    $usuario = $this->usuarios->buscarPorEmail($email);

    if ($usuario === false || !password_verify($password, $usuario["password_hash"])) {
      return ["errores" => ["Email o contraseña incorrectos."], "usuario" => null];
    }

    return ["errores" => [], "usuario" => $usuario];
  }
}
