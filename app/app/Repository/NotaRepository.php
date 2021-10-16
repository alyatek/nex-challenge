<?php

namespace App\Repository;

use App\Classes\Nota;
use App\Models\Atleta;

class NotaRepository extends Nota
{
    public function create(string $titulo, string $texto, int $atletaId)
    {
        $this->setTitulo($titulo);
        $this->setTexto($texto);

        if (!$atleta = Atleta::find($atletaId)) return ["error" => "Nenhum atleta encontrado"];

        $this->setAtleta($atleta);

        $this->save();

        return $this->getNota();
    }

    public function find(int $int)
    {
        if (!$nota = $this->model->find($int)) return ["error" => "Nao encontrado"];

        return $nota;
    }

    public function update(int $id, string $titulo, string $texto)
    {
        if (!$nota = $this->model->find($id)) return ["error" => "Nao encontrado"];

        $nota->titulo = $titulo;
        $nota->texto = $texto;

        if ($nota->isDirty()) $nota->save();

        return $nota;
    }

    public function delete(int $id)
    {
        if (!$nota = $this->model->find($id)) return ["error" => "Nao encontrado"];
        return $nota->delete();
    }

    private function save()
    {
        $this->model->titulo = $this->getTitulo();
        $this->model->texto = $this->getTexto();
        $this->model->atleta_id = $this->getAtleta()->id;
        $this->model->user_id = 1; // user ficticio

        $this->model->save();

        $this->setNota($this->model->find($this->model->id));
    }
}
