<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    public function atributos()
    {
        return $this->hasMany(ModalidadeAtributos::class);
    }

    public function atributosWithName()
    {
        return $this->belongsToMany(Atributo::class, 'modalidade_atributos');
    }
}
