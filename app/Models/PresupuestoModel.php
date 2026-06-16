<?php

namespace App\Models;

use CodeIgniter\Model;

class PresupuestoModel extends Model
{
    protected $table = 'presupuestos';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $allowedFields = [

        'uuid',

        'usuario_id',

        'nombre',

        'descripcion',

        'monto',

        'fecha_inicio',

        'fecha_fin',

        'estado'
    ];
}