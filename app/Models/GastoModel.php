<?php

namespace App\Models;

use CodeIgniter\Model;

class GastoModel extends Model
{
    protected $table = 'gastos';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $allowedFields = [

        'uuid',

        'usuario_id',

        'categoria_id',

        'presupuesto_id',

        'descripcion',

        'monto',

        'fecha'
    ];
}