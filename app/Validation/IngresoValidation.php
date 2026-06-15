<?php

namespace App\Validation;

class IngresoValidation
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
                'rules' => 'required|valid_date'
            ]
        ];
    }
}