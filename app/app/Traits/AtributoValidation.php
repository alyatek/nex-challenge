<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait AtributoValidation
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
        ];
    }
}
