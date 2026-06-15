<?php

namespace App\Repositories;

use App\Models\GastoModel;

class GastoRepository
{
    protected GastoModel $model;

    public function __construct()
    {
        $this->model = new GastoModel();
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
        return $this->model->update($id,$data);
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
            ->where('usuario_id',$usuarioId)
            ->orderBy('fecha','DESC')
            ->findAll();
    }

    public function totalPorPresupuesto(
        int $presupuestoId
    ): float
    {
        $row = $this->model
            ->selectSum('monto')
            ->where(
                'presupuesto_id',
                $presupuestoId
            )
            ->first();

        return (float)($row->monto ?? 0);
    }
    public function totalConsumidoPresupuesto(
    int $presupuestoId
    ): float
    {
        $db = db_connect();

        $row = $db->table('gastos')
            ->selectSum('monto')
            ->where(
                'presupuesto_id',
                $presupuestoId
            )
            ->get()
            ->getRow();

        return (float)
            ($row->monto ?? 0);
}
}