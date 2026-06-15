<?php

namespace App\Repositories;

use App\Models\PermisoModel;

class PermisoRepository
{
    protected PermisoModel $model;

    public function __construct()
    {
        $this->model =
            new PermisoModel();
    }

    public function listar(): array
    {
        return $this->model->findAll();
    }

    public function buscar(
        int $id
    )
    {
        return $this->model->find($id);
    }
}