<?php

namespace App\Repository;

use App\Classes\Nota;
use App\Interfaces\NotaCRUDInterface;
use App\Models\Atleta;
use App\Models\Nota as ModelsNota;

class NotaRepository extends Nota implements NotaCRUDInterface
{
    /**
     * cria uma nota se o atleta respetivo existir
     *
     * @param string $titulo
     * @param string $texto
     * @param integer $atletaId
     * @return void
     */
    public function create(string $titulo, string $texto, int $atletaId): array
    {
        $this->setTitulo($titulo);
        $this->setTexto($texto);

        if (!$atleta = Atleta::find($atletaId)) return ["error" => "Nenhum atleta encontrado"];

        $this->setAtleta($atleta);

        $this->save();

        return $this->getNota()->toArray();
    }

    /**
     * encontra uma nota se existir
     *
     * @param integer $int
     * @return void
     */
    public function find(int $int): array
    {
        if (!$nota = $this->model->find($int)) return ["error" => "Nao encontrado"];

        return $nota->toArray();
    }

    /**
     * atualiza uma nota
     *
     * @param integer $id
     * @param string $titulo
     * @param string $texto
     * @return void
     */
    public function update(int $id, string $titulo, string $texto): array
    {
        if (!$nota = $this->model->find($id)) return ["error" => "Nao encontrado"];

        $nota->titulo = $titulo;
        $nota->texto = $texto;

        if ($nota->isDirty()) $nota->save();

        return $nota->toArray();
    }

    /**
     * apaga uma respetiva nota se existir
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): array
    {
        if (!$nota = $this->model->find($id)) return ["error" => "Nao encontrado"];
        return ["status" => $nota->delete()];
    }

    /**
     * guarda na bd a nota
     *
     * @return void
     */
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
