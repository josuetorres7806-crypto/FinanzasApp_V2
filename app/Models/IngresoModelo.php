<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Ingreso;

class IngresoModel extends Model
{
    protected $table = 'ingresos';

    protected $primaryKey = 'id';

    protected $returnType = Ingreso::class;


    protected $allowedFields = [
        'usuario_id',
        'categoria_id',
        'descripcion',
        'monto',
        'fecha',
        'notas'
    ];

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';
}