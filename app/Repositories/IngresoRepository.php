<?php

namespace App\Repositories;

use App\Models\IngresoModel;

class IngresoRepository
{
    protected IngresoModel $model;

    public function __construct()
    {
        $this->model = new IngresoModel();
    }

    public function crear(array $data): int
    {
        return (int)$this->model->insert($data);
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

    public function eliminar(int $id): bool
    {
        return (bool)$this->model->delete($id);
    }

    public function buscar(int $id)
    {
        return $this->model->find($id);
    }

    public function listarPorUsuario(
        int $usuarioId
    ): array
    {
        return $this->model
            ->where(
                'usuario_id',
                $usuarioId
            )
            ->orderBy(
                'fecha',
                'DESC'
            )
            ->findAll();
    }
}