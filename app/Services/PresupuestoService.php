<?php

namespace App\Services;

use App\Models\PresupuestoModel;
use Ramsey\Uuid\Uuid;
use Exception;

class PresupuestoService
{
    protected PresupuestoModel $presupuestos;

    public function __construct()
    {
        $this->presupuestos =
            new PresupuestoModel();
    }

    public function crear(array $data): array
    {
        if (
            strtotime($data['fecha_fin'])
            <
            strtotime($data['fecha_inicio'])
        ) {
            throw new Exception(
                'La fecha final no puede ser menor'
            );
        }

        $nuevo = [

            'uuid' =>
                Uuid::uuid4()->toString(),

            'usuario_id' =>
                $data['usuario_id'],

            'categoria_id' =>
                $data['categoria_id'] ?? null,

            'nombre' =>
                $data['nombre'],

            'monto' =>
                $data['monto'],

            'gastado' =>
                0,

            'fecha_inicio' =>
                $data['fecha_inicio'],

            'fecha_fin' =>
                $data['fecha_fin'],

            'estado' =>
                'activo'
        ];

        $id =
            $this->presupuestos->insert(
                $nuevo
            );

        $presupuesto =
            $this->presupuestos->find($id);

        service('auditService')
            ->registrar(
                $presupuesto['usuario_id'],
                'CREAR',
                'presupuestos',
                $presupuesto['id'],
                null,
                $presupuesto
            );

        service('logService')
            ->info(
                'PRESUPUESTO_CREADO',
                'Presupuesto creado ID '
                . $presupuesto['id'],
                $presupuesto['usuario_id']
            );

        return $presupuesto;
    }

    public function actualizarGastado(
        int $presupuestoId,
        float $monto
    ): void {

        $presupuesto =
            $this->presupuestos->find(
                $presupuestoId
            );

        if (!$presupuesto) {
            return;
        }

        $gastado =
            (float)$presupuesto['gastado']
            +
            $monto;

        $estado =
            $this->determinarEstado(
                $gastado,
                (float)$presupuesto['monto']
            );

        $this->presupuestos->update(
            $presupuestoId,
            [
                'gastado' => $gastado,
                'estado' => $estado
            ]
        );
    }

    private function determinarEstado(
        float $gastado,
        float $limite
    ): string {

        if ($gastado > $limite) {
            return 'excedido';
        }

        if ($gastado >= $limite) {
            return 'agotado';
        }

        return 'activo';
    }

    public function porcentajeConsumido(
        int $presupuestoId
    ): float {

        $presupuesto =
            $this->presupuestos->find(
                $presupuestoId
            );

        if (!$presupuesto) {
            return 0;
        }

        if (
            (float)$presupuesto['monto']
            <= 0
        ) {
            return 0;
        }

        return round(
            (
                $presupuesto['gastado']
                /
                $presupuesto['monto']
            ) * 100,
            2
        );
    }
}