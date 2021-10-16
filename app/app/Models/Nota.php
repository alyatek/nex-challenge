<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public function atleta()
    {
        return $this->hasOne(Atleta::class);
    }
}
