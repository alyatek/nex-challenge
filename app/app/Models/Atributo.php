<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atributo extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function findById(int $id)
    {
        return $this->where('id', $id)->first();
    }
    public function findByNome(string $nome)
    {
        return $this->where('nome', $nome)->first();
    }
}
