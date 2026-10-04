<?php

declare(strict_types=1);

class CategoriaRepository
{
  public function __construct(private readonly Database $database) {}

  public function listar(): array
  {
    return $this->database->getConnection()
      ->query("SELECT id, nombre FROM categorias ORDER BY nombre")
      ->fetchAll();
  }
}
