<?php

namespace App\Validation;

class GastoValidation
{
    public static function rules(): array
    {
        return [

            'categoria_id' => [
                'rules' => 'required|integer'
            ],

            'monto' => [
                'rules' => 'required|decimal|greater_than[0]'
            ],

            'fecha' => [
                'rules' => 'required'
            ]
        ];
    }
}