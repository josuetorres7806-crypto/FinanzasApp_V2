<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Ingreso extends Entity
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'usuario_id' => 'integer',
        'categoria_id' => '?integer',
        'monto' => 'float'
    ];
}