<?php

namespace App\Repository;

use App\Classes\Atleta;
use App\Interfaces\AtletaCRUDInterface;
use App\Models\Atleta as ModelsAtleta;
use App\Models\AtletasModalidadeAtributo as ModelsAtletasModalidadeAtributo;
use App\Models\ModalidadeAtributos;
use App\Models\Nota;

class AtletaRepository extends Atleta implements AtletaCRUDInterface
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
    ): array {
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

        return $this->model->with('modalidadeAtributos')->find($this->getAtleta()->id)->toArray();
    }

    /**
     * Encontra um atleta ou devolve null
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id): array
    {
        if (!$atleta = $this->model->find($id)) return ["error" => "Nao encontrado"];

        $atleta['modalidade_atributos'] = $this->model->atletaModalidadeAtributos($id);

        return $atleta->toArray();
    }

    /**
     * Atualiza os recursos de um atleta
     *
     * @return void
     */
    public function update(int $id, array $data, array $modalidadeAtributos): array
    {
        if (!$atleta = $this->model->find($id)) return ["error" => "Nao encontrado"];

        foreach ($data as $field => $value) {
            $atleta->$field = $value;
        }

        $atleta->save();

        $this->setAtleta($atleta);

        // remove as modalidades e atribui as novas
        $this->removeModalidadeAtributos();
        $this->setModalidadeAtributos($modalidadeAtributos);
        $this->saveModalidadeAtributos();

        return $this->getAtleta()->toArray();
    }

    public function delete(int $id): array
    {
        if (!$atleta = $this->model->find($id)) return ["error" => "Atleta nao encontrado"];

        $this->setAtleta($atleta);

        // remover os atributos
        $this->removeModalidadeAtributos();
        // remover os comentarios
        $this->removeComentariosDoAtleta();

        return ["status" => $atleta->delete()];
    }


    /**
     * Guarda na base de dados um atleta
     *
     * @return void
     */
    private function save()
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

    /**
     * Guarda os atributos das modalidades respetivos ao atleta
     *
     * @return void
     */
    private function saveModalidadeAtributos()
    {
        // vai buscar as modalidade e atributos que vieram do request
        $modalidadeAtributos = $this->getModalidadeAtributos();

        $modalidadesAtributosId = [];

        // para cada modalidade encontra os atributos respetivos na base de dados
        foreach ($modalidadeAtributos as $modalidade => $atributos) {
            $modalidadesAtributosId[] = ModalidadeAtributos::where('modalidade_id', $modalidade)->whereIn('atributo_id', $atributos)->get(['id'])->toArray();
        }

        // mapeia para a key ser o nome da coluna
        $modalidadesAtributosId = collect($modalidadesAtributosId)->flatten()->map(function ($item) {
            return ["modalidade_atributo_id" => $item];
        });

        // cria os respetivos vindo do array
        $this->getAtleta()->modalidadeAtributos()->createMany($modalidadesAtributosId);
    }

    /**
     * Remove as modalidadesAtributos do atleta
     *
     * @return void
     */
    private function removeModalidadeAtributos(): bool
    {
        $atleta = $this->getAtleta();

        return ModelsAtletasModalidadeAtributo::where('atleta_id', $atleta->id)->delete();
    }

    /**
     * Remove todos os respetivos comentarios/notas de um atleta feitos por 
     *
     * @return void
     */
    private function removeComentariosDoAtleta()
    {
        if ($getAll = Nota::where('atleta_id', $this->getAtleta()->id)) {
            return $getAll->delete();
        }
    }
}
