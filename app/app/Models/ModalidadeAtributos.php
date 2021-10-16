<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadeAtributos extends Model
{
    protected $fillable = ['atributo_id', 'modalidade_id'];

    public function modalidade()
    {
        return $this->hasOne(Modalidade::class, 'id', 'modalidade_id');
    }

    public function atributo()
    {
        return $this->hasOne(Atributo::class, 'id', 'atributo_id');
    }
}
