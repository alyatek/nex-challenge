<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait AtletaValidation
{

    protected function validateRequest()
    {
        $validate = Validator::make(request()->all(), $this->rules());

        if ($validate->fails()) {
            return response()->json($validate->errors())->send();
        }
    }

    private function rules()
    {
        return [
            "nome" => "required|string|min:3|max:250",
            "nif" => "required|int",
            "morada" => "required|string|max:250",
            "telefone" => "required|int|regex:/9[1,2,3,6]{1}[0-9]{7}/",
            "email" => "required|email",
            "data_nascimento" => "required|date",
            "altura" => "required|numeric|between:0,999.99",
            "peso" => "required|int",
            "modalidade_atributos" => "required|array"
        ];
    }
}
