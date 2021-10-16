<?php

namespace App\Models;

use Atributos;
use Illuminate\Database\Eloquent\Model;
use Modalidades;

class Atleta extends Model
{
    public function atletaModalidadeAtributos($atletaId)
    {
        $atleta = $this->with('modalidadeAtributos')->find($atletaId)->toArray();

        // vai encontrar as ModalidadeAtributos respetivos ao atleta em questao e apenas devolver os arrays dos atributos e modalidades
        $modalidadesAtributos = ModalidadeAtributos::whereIn(
            'id',
            collect($atleta['modalidade_atributos'])->pluck('modalidade_atributo_id')->flatten()
        )->with(['atributo', 'modalidade'])->get()->toArray();

        // mapeamento das modalidades e atributos para apenas ser possivel tratar destes dois no qual de seguida organizo
        // as chaves do array pela nome da modalidade e de seguida vou buscar os valores apenas dos atributos dessa modalidade
        // 

        return collect($modalidadesAtributos)->map(function ($item) {
            return [
                'modalidade' => $item['modalidade'],
                'atributo' => $item['atributo'],
            ];
        })->groupBy('modalidade.nome')->map(function ($item) {
            return $item->pluck('atributo.nome')->toArray();
        })->toArray();
    }
    public function modalidadeAtributos()
    {
        return $this->hasMany(AtletasModalidadeAtributo::class);
    }
}
