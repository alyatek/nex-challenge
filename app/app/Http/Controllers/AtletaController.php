<?php

namespace App\Http\Controllers;

use App\Classes\Atleta;
use App\Repository\AtletaRepository;
use App\Traits\AtletaValidation;

class AtletaController extends Controller
{
    use AtletaValidation;

    public function __construct(AtletaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        $this->validateRequest();

        $store = $this->repository->create(
            request()->nome,
            request()->nif,
            request()->morada,
            request()->telefone,
            request()->email,
            request()->data_nascimento,
            request()->altura,
            request()->peso,
            request()->modalidade_atributos
        );

        return response()->json(["atleta" => $store]);
    }

    public function read(int $id)
    {
        return response()->json($this->repository->find($id));
    }

    public function update(int $id)
    {
        $this->validateRequest();
        return response()->json($this->repository->update($id, request()->only(Atleta::$fields), request()->modalidade_atributos));
    }

    public function delete(int $id)
    {
        if (!$id) return response()->json(["error" => "Atleta nao encontrado"]);

        return response()->json($this->repository->delete($id));
    }
}
