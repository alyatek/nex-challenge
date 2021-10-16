<?php

namespace App\Classes;

use App\Models\Atleta as AtletaModel;

abstract class Atleta
{
    private
        $nome,
        $nif,
        $morada,
        $telefone,
        $email,
        $dataNascimento,
        $altura,
        $peso;
    private $atleta, $modalidadeAtributos;

    public static $fields = [
        'nome',
        'nif',
        'morada',
        'telefone',
        'email',
        'data_nascimento',
        'altura',
        'peso',
    ];

    public function __construct(AtletaModel $model)
    {
        $this->model = $model;
    }

    public function getAtleta(): AtletaModel
    {
        return $this->atleta;
    }

    /** getters */
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getNif(): string
    {
        return $this->nif;
    }

    public function getMorada(): string
    {
        return $this->morada;
    }

    public function getTelefone(): int
    {
        return $this->telefone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }

    public function getAltura(): float
    {
        return $this->altura;
    }

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function getModalidadeAtributos(): array
    {
        return $this->modalidadeAtributos;
    }

    /** setters */

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    public function setMorada($morada)
    {
        $this->morada = $morada;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function setAtleta(AtletaModel $atleta)
    {
        $this->atleta = $atleta;
    }

    public function setModalidadeAtributos(array $modalidadeAtributos)
    {
        $this->modalidadeAtributos = $modalidadeAtributos;
    }
}
