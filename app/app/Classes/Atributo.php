<?php

namespace App\Classes;

use App\Models\Atributo as Model;

abstract class Atributo
{
    protected $model;
    private $nome, $atributo;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getAtributo(): Model
    {
        return $this->atributo;
    }

    public function setAtributo(Model $atributo)
    {
        $this->atributo = $atributo;
    }
}
