<?php

namespace App\Repository;

use App\Classes\Atleta;
use App\Models\AtletasModalidadeAtributo as ModelsAtletasModalidadeAtributo;
use App\Models\ModalidadeAtributos;

class AtletaRepository extends Atleta
{
    /**
     * Define os atributos para criar um atleta
     *
     * @param string $nome
     * @param integer $nif
     * @param string $morada
     * @param integer $telefone
     * @param string $email
     * @param string $dataNascimento
     * @param float $altura
     * @param integer $peso
     * @return void
     */
    public function create(
        string $nome,
        int $nif,
        string $morada,
        int $telefone,
        string $email,
        string $dataNascimento,
        float $altura,
        int $peso,
        array $modalidadeAtributos
    ) {
        $this->setNome($nome);
        $this->setNif($nif);
        $this->setMorada($morada);
        $this->setTelefone($telefone);
        $this->setEmail($email);
        $this->setDataNascimento($dataNascimento);
        $this->setAltura($altura);
        $this->setPeso($peso);

        $this->save();
        $this->setModalidadeAtributos($modalidadeAtributos);
        $this->saveModalidadeAtributos();

        return $this->model->with('modalidadeAtributos')->find($this->getAtleta()->id);
    }

    /**
     * Encontra um atleta ou devolve null
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id): array
    {
        // dd($this->model->find($id));

        if (!$atleta = $this->model->find($id)) return ["error" => "Nao encontrado"];

        $atleta['modalidade_atributos'] = $this->model->atletaModalidadeAtributos($id);

        return $atleta->toArray();
    }

    /**
     * Atualiza os recursos de um atleta
     *
     * @return void
     */
    public function update(int $id, array $data, array $modalidadeAtributos)
    {
        if (!$atleta = $this->model->find($id)) return ["error" => "Nao encontrado"];

        foreach ($data as $field => $value) {
            $atleta->$field = $value;
        }

        // if (!$atleta->isDirty()) {
        //     return ["error" => "Nada modificado"];
        // }

        $atleta->save();

        $this->setAtleta($atleta);

        $this->removeModalidadeAtributos();
        $this->setModalidadeAtributos($modalidadeAtributos);
        $this->saveModalidadeAtributos();

        return $this->getAtleta();
    }

    public function delete(int $id)
    {
        if (!$atleta = $this->model->find($id)) return ["error" => "Atleta nao encontrado"];

        $this->setAtleta($atleta);
        // remover os atributos
        $this->removeModalidadeAtributos();
        // remover os comentarios

        return true;
    }


    /**
     * Guarda na base de dados um atleta
     *
     * @return void
     */
    protected function save()
    {
        $this->model->nome = $this->getNome();
        $this->model->nif = $this->getNif();
        $this->model->morada = $this->getMorada();
        $this->model->telefone = $this->getTelefone();
        $this->model->email = $this->getEmail();
        $this->model->data_nascimento = $this->getDataNascimento();
        $this->model->altura = $this->getAltura();
        $this->model->peso = $this->getPeso();

        $this->model->save();

        $this->setAtleta($this->model->find($this->model->id));
    }

    protected function saveModalidadeAtributos()
    {
        $modalidadeAtributos = $this->getModalidadeAtributos();
        $modalidadesAtributosId = [];

        foreach ($modalidadeAtributos as $modalidade => $atributos) {
            $modalidadesAtributosId[] = ModalidadeAtributos::where('modalidade_id', $modalidade)->whereIn('atributo_id', $atributos)->get(['id'])->toArray();
        }

        $modalidadesAtributosId = collect($modalidadesAtributosId)->flatten()->map(function ($item) {
            return ["modalidade_atributo_id" => $item];
        });

        $this->getAtleta()->modalidadeAtributos()->createMany($modalidadesAtributosId);
    }

    protected function removeModalidadeAtributos()
    {
        $atleta = $this->getAtleta();

        return ModelsAtletasModalidadeAtributo::where('atleta_id', $atleta->id)->delete();
    }
}
