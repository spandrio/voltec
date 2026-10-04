<?php

declare(strict_types=1);

class UsuarioRepository
{
  public function __construct(private readonly Database $database) {}

  public function buscarPorEmail(string $email): array|false
  {
    $stmt = $this->database->getConnection()->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute([":email" => $email]);

    return $stmt->fetch();
  }

  public function existeEmail(string $email): bool
  {
    $stmt = $this->database->getConnection()->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute([":email" => $email]);

    return $stmt->fetch() !== false;
  }

  public function crear(string $nombre, string $email, string $passwordHash): int
  {
    return $this->database->runTransaction(function (PDO $conn) use ($nombre, $email, $passwordHash) {
      $stmt = $conn->prepare(
        "INSERT INTO usuarios (nombre, email, password_hash) VALUES (:nombre, :email, :password_hash)"
      );
      $stmt->execute([
        ":nombre" => $nombre,
        ":email" => $email,
        ":password_hash" => $passwordHash,
      ]);

      return (int) $conn->lastInsertId();
    });
  }
}
