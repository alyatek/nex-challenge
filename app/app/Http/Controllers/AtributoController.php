<?php

namespace App\Http\Controllers;

use App\Repository\AtributoRepository;
use App\Traits\AtributoValidation;

class AtributoController extends Controller
{
    use AtributoValidation;

    public function __construct(AtributoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        $this->validateRequest();

        return response()->json($this->repository->create(request()->nome));
    }

    public function read(int $id)
    {
        return response()->json($this->repository->find($id));
    }

    public function update(int $id)
    {
        $this->validateRequest();

        return response()->json($this->repository->update($id, request()->nome));
    }

    public function delete(int $id)
    {
        return response()->json(["status" => $this->repository->delete($id)]);
    }
}
