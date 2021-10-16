<?php

namespace App\Repository;

use App\Classes\Modalidade;
use App\Models\ModalidadeAtributos;

class ModalidadeRepository extends Modalidade
{
    /**
     * cria um recurso e os atributos
     *
     * @param [type] $name
     * @param array $atributos
     * @return void
     */
    public function create(string $name, array $atributos)
    {
        // atribui as variaveis para utilizacao
        $this->setName($name);
        $this->setAtributos($atributos);

        $this->save(); // cria o modelo 
        $this->saveAtributos(); // cria os atributos

        return $this->getModalidade();
    }

    /** encontra um recurso
     * 
     */
    public function find(int $id)
    {
        if (!$modalidade = $this->model->with('atributosWithName')->find($id)) {
            return ["error" => "Nao encontrado"];
        }

        return $modalidade;
    }

    /**
     * atualiza um recurso e os atributos
     */

    public function update($id, $nome, $atributos)
    {
        if (!$modalidade = $this->model->with('atributos')->find($id)) {
            return ["error" => "Nao encontrado"];
        }

        $modalidade->nome = $nome;

        // verifica se o nome foi mudado e se sim atualiza
        if ($modalidade->isDirty()) {
            $modalidade->save();
        }

        // atribui o novo modelo da modalidade para poder ser usado no objeto
        $this->setModalidade($modalidade);

        // atribui os atributos e remove os atuais para colocar os novos
        $this->setAtributos($atributos);
        $this->removeAtributos();
        $this->saveAtributos();

        // vai buscar o model com a mais recente atualizacao
        return $this->model->with('atributosWithName')->find($modalidade->id);
    }

    public function delete(int $id)
    {
        if (!$modalidade = $this->model->with('atributos')->find($id)) {
            return ["error" => "Nao encontrado"];
        }

        // atribui a modalidade para os atributos poderem ser removidos
        $this->setModalidade($modalidade);
        $this->removeAtributos();

        // apaga a modalidade
        $this->getModalidade()->delete();

        return ["status" => true];
    }

    /**
     * guarda um modelo
     *
     * @return void
     */
    private function save()
    {
        // cria o novo modelo
        $this->model->nome = $this->getName();
        $this->model->save();

        // define a modalidade e devolve o inserido
        $this->setModalidade($this->model->find($this->model->id));
    }

    /**
     * Cria os respetivos atributos
     *
     * @return void
     */
    private function saveAtributos()
    {
        $modalidade = $this->getModalidade();

        return $modalidade->atributos()->createMany($this->getAtributos());
    }

    /**
     * remove os atributos todos de um modelo
     *
     * @return void
     */
    private function removeAtributos()
    {
        return ModalidadeAtributos::where('modalidade_id', $this->getModalidade()->id)->delete();
    }
}
