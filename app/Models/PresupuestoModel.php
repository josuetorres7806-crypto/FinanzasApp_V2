<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Presupuesto;

class PresupuestoModel extends Model
{
    protected $table = 'presupuestos';

    protected $primaryKey = 'id';

    protected $returnType =
        Presupuesto::class;

    protected $allowedFields = [
        'usuario_id',
        'categoria_id',
        'nombre',
        'descripcion',
        'monto_limite',
        'fecha_inicio',
        'fecha_fin',
        'activo'
    ];

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';
}