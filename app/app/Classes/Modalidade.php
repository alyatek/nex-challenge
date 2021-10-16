<?php

namespace App\Classes;

use App\Models\Modalidade as ModelsModalidade;

abstract class Modalidade
{
    private $name, $atributos, $modalidade;

    public function __construct(ModelsModalidade $model)
    {
        $this->model = $model;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAtributos()
    {
        return $this->atributos;
    }

    public function setAtributos($atributos)
    {
        // mapeia os atributos para ter como key o atributo_id para facilitar a insercao
        $this->atributos = collect($atributos)->map(function ($item) {
            return ["atributo_id" => $item];
        });
    }

    public function getModalidade()
    {
        return $this->modalidade;
    }

    public function setModalidade(ModelsModalidade $modalidade)
    {
        $this->modalidade = $modalidade;
    }
}
