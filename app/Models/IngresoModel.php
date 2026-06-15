<?php

namespace App\Models;

use CodeIgniter\Model;

class IngresoModel extends Model
{
    protected $table = 'ingresos';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $allowedFields = [
        'uuid',
        'usuario_id',
        'categoria_id',
        'meta_ahorro_id',
        'descripcion',
        'monto',
        'fecha'
    ];
}