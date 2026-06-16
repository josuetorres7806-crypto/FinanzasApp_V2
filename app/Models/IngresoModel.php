<?php

namespace App\Models;

use CodeIgniter\Model;

class IngresoModel extends Model
{
    protected $table = 'ingresos';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'usuario_id',
        'categoria_id',
        'descripcion',
        'monto',
        'fecha',
        'notas'
    ];

    protected $useTimestamps = false;
}