<?php

namespace App\Http\Controllers;

use App\Repository\NotaRepository;
use App\Traits\NotaValidation;

class NotaController extends Controller
{
    use NotaValidation;
    public function __construct(NotaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        $this->validateRequest();

        return response()->json($this->repository->create(request()->titulo, request()->texto, request()->atleta_id));
    }

    public function read(int $id)
    {
        return response()->json($this->repository->find($id));
    }

    public function update(int $id)
    {
        $this->validateRequestUpdate();
        return response()->json($this->repository->update($id, request()->titulo, request()->texto));
    }

    public function delete(int $id)
    {
        return response()->json(["status" => $this->repository->delete($id)]);
    }
}
