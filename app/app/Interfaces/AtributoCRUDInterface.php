<?php

namespace App\Interfaces;

interface AtributoCRUDInterface
{
    public function create(string $name): array;
    public function find(int $id): array;
    public function update(int $id, string $name): array;
    public function delete(int $id):array
}
