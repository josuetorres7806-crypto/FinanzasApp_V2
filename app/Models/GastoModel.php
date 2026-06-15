<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Gasto;

class GastoModel extends Model
{
    protected $table = 'gastos';

    protected $primaryKey = 'id';

    protected $returnType = Gasto::class;

    protected $allowedFields = [
        'usuario_id',
        'categoria_id',
        'presupuesto_id',
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