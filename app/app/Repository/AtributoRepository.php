<?php

namespace App\Repository;

use App\Classes\Atributo;

class AtributoRepository extends Atributo
{
    public function create(string $nome)
    {
        if ($this->model->findByNome($nome)) return ["error" => "Ja existe"];

        $this->setNome($nome);

        $this->save();

        return $this->getAtributo();
    }

    public function find(int $id)
    {
        if (!$atributo = $this->model->findById($id)) return ["error" => "Nao encontrado"];

        return $atributo;
    }

    public function update(int $id, string $name)
    {
        if (!$atributo = $this->model->findById($id)) return ["error" => "Nao encontrado"];

        $atributo->nome = $name;

        if ($atributo->isDirty()) $atributo->save();

        return $atributo;
    }

    public function delete(int $id)
    {
        if (!$atributo = $this->model->findById($id)) return ["error" => "Nao encontrado"];

        return $atributo->delete();
    }

    private function save()
    {
        $this->model->nome = $this->getNome();

        $this->model->save();

        $this->setAtributo($this->model->find($this->model->id));
    }
}
