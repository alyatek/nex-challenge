<?php

namespace App\Http\Controllers;

use App\Models\Modalidade;
use App\Repository\ModalidadeRepository;
use App\Traits\ModalidadeValidation;

class ModalidadeController extends Controller
{
    use ModalidadeValidation;

    public function __construct(ModalidadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        $this->validateRequest();
        return response()->json($this->repository->create(request()->nome, request()->atributos));
    }

    public function read(int $id)
    {
        return response()->json($this->repository->find($id));
    }

    public function update(int $id)
    {
        $this->validateRequest();
        return response()->json($this->repository->update($id, request()->nome, request()->atributos));
    }

    public function delete(int $id)
    {
        return response()->json($this->repository->delete($id));
    }
}
