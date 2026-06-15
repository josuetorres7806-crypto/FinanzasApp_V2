<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Permiso;

class PermisoModel extends Model
{
    protected $table = 'permisos';

    protected $primaryKey = 'id';

    protected $returnType = Permiso::class;

    protected $allowedFields = [
        'nombre',
        'descripcion'
    ];
}