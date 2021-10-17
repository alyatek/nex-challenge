<?php

namespace App\Repository;

use App\Classes\Atributo;
use App\Interfaces\AtributoCRUDInterface;
use App\Models\Atributo as ModelsAtributo;

class AtributoRepository extends Atributo implements AtributoCRUDInterface
{
    /**
     * guarda e devolve um atributo criado
     *
     * @param string $nome
     * @return ModelsAtributo
     */
    public function create(string $nome): array
    {
        if ($this->model->findByNome($nome)) return ["error" => "Ja existe"];

        $this->setNome($nome);

        $this->save();

        return $this->getAtributo()->toArray();
    }

    /** 
     * devolve o atributo se contrado
     * 
     */
    public function find(int $id): array
    {
        if (!$atributo = $this->model->findById($id)) return ["error" => "Nao encontrado"];

        return $atributo->toArray();
    }

    /**
     * atualiza, se mudado, o atributo
     *
     * @param integer $id
     * @param string $name
     * @return void
     */
    public function update(int $id, string $name): array
    {
        if (!$atributo = $this->model->findById($id)) return ["error" => "Nao encontrado"];

        $atributo->nome = $name;

        if ($atributo->isDirty()) $atributo->save();

        return $atributo->toArray();
    }

    /**
     * apaga um atributo da bd
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): array
    {
        if (!$atributo = $this->model->findById($id)) return ["error" => "Nao encontrado"];

        return ["status" => $atributo->delete()];
    }

    /**
     * Guarda na bd o atributo
     *
     * @return void
     */
    private function save()
    {
        $this->model->nome = $this->getNome();

        $this->model->save();

        $this->setAtributo($this->model->find($this->model->id));
    }
}
