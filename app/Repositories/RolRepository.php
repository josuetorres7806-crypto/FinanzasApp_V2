<?php

namespace App\Repositories;

use App\Models\RolModel;

class RolRepository
{
    protected RolModel $model;

    protected $db;

    public function __construct()
    {
        $this->model = new RolModel();

        $this->db = db_connect();
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

    public function crear(
        array $data
    ): int
    {
        $this->model->insert($data);

        return (int)
            $this->model->getInsertID();
    }

    public function actualizar(
        int $id,
        array $data
    ): bool
    {
        return $this->model->update(
            $id,
            $data
        );
    }

    public function eliminar(
        int $id
    ): bool
    {
        return (bool)
            $this->model->delete($id);
    }

    public function asignarPermiso(
        int $rolId,
        int $permisoId
    ): bool
    {
        return $this->db
            ->table('rol_permisos')
            ->insert([
                'rol_id' => $rolId,
                'permiso_id' => $permisoId
            ]);
    }
}