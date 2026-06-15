<?php

namespace App\Validation;

class PresupuestoValidation
{
    public static function rules(): array
    {
        return [

            'nombre' =>
                'required|min_length[3]|max_length[200]',

            'monto' =>
                'required|decimal|greater_than[0]',

            'fecha_inicio' =>
                'required',

            'fecha_fin' =>
                'required'
        ];
    }
}