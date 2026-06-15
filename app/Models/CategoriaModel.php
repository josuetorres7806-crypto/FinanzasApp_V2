<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'categorias';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $allowedFields = [

        'usuario_id',

        'nombre',

        'tipo',

        'icono',

        'color',

        'sistema',

        'activa',

        'orden_visual'
    ];

    protected $validationRules = [

        'nombre' => 'required|min_length[2]|max_length[150]',

        'tipo' => 'required|in_list[ingreso,gasto]'
    ];
}