<?php

namespace App\Classes;

use App\Models\Atleta;
use App\Models\Nota as ModelsNota;

abstract class Nota
{
    private $titulo, $texto, $atleta;
    private $nota;
    public function __construct(ModelsNota $model)
    {
        $this->model = $model;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getTexto(): string
    {
        return $this->texto;
    }

    public function getAtleta(): Atleta
    {
        return $this->atleta;
    }

    public function getNota(): ModelsNota
    {
        return $this->nota;
    }

    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;
    }

    public function setTexto(string $texto)
    {
        $this->texto = $texto;
    }

    public function setAtleta(Atleta $atleta)
    {
        $this->atleta = $atleta;
    }

    public function setNota(ModelsNota $nota)
    {
        $this->nota = $nota;
    }
}
