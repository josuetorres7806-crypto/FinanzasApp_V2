<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Gasto extends Entity
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
        'presupuesto_id' => '?integer',
        'monto' => 'float'
    ];
}