<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';

    protected $primaryKey = 'id';

    protected $returnType =
        \App\Entities\Usuario::class;

    protected $allowedFields = [
        'nombre',
        'email',
        'password',
        'rol',
        'activo',
        'ultimo_login'
    ];

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
}