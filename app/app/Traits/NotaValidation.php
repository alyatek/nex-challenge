<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait NotaValidation
{

    protected function validateRequest()
    {
        $validate = Validator::make(request()->all(), $this->rules());

        if ($validate->fails()) {
            return response()->json($validate->errors())->send();
        }
    }

    protected function validateRequestUpdate()
    {
        $validate = Validator::make(request()->all(), $this->rulesUpdate());

        if ($validate->fails()) {
            return response()->json($validate->errors())->send();
        }
    }

    private function rulesUpdate()
    {
        return [
            "titulo" => "required|string|min:3|max:250",
            "texto" => "required|string|min:10",
        ];
    }

    private function rules()
    {
        return [
            "titulo" => "required|string|min:3|max:250",
            "texto" => "required|string|min:10",
            "atleta_id" => "required|int",
        ];
    }
}
