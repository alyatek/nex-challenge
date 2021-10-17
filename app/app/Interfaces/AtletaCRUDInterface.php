<?php

namespace App\Interfaces;

interface AtletaCRUDInterface
{
    public function create(string $nome, int $nif, string $morada, int $telefone, string $email, string $dataNascimento, float $altura, int $peso, array $modalidadeAtributos): array;
    public function find(int $id): array;
    public function update(int $id, array $data, array $modalidadeAtributos): array;
    public function delete(int $id): array;
}
