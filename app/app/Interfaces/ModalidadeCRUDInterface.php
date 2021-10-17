<?php

namespace App\Interfaces;

interface ModalidadeCRUDInterface
{
    public function create(string $name, array $atributos): array;
    public function find(int $id): array;
    public function update(int $id, string $nome, array $atributos): array;
    public function delete(int $id): array;
}
