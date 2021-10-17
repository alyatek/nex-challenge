<?php

namespace App\Interfaces;

interface NotaCRUDInterface

{
    public function create(string $titulo, string $texto, int $atletaId): array;
    public function find(int $int): array;
    public function update(int $id, string $titulo, string $texto): array;
    public function delete(int $id): array;
}
