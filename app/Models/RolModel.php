<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Rol;

class RolModel extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $returnType = Rol::class;

    protected $allowedFields = [
        'nombre',
        'descripcion'
    ];

    protected $useTimestamps = true;
}