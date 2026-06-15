<?php

namespace App\Services;

use App\Models\GastoModel;
use App\Models\CategoriaModel;
use App\Models\PresupuestoModel;

use Ramsey\Uuid\Uuid;

use Exception;

use CodeIgniter\Events\Events;

class GastoService
{
    protected GastoModel $gastos;

    protected CategoriaModel $categorias;

    protected PresupuestoModel $presupuestos;

    public function __construct()
    {
        $this->gastos = new GastoModel();

        $this->categorias = new CategoriaModel();

        $this->presupuestos = new PresupuestoModel();
    }

    public function crear(array $data): array
    {
        $categoria = $this->categorias->find(
            $data['categoria_id']
        );

        if (!$categoria) {
            throw new Exception(
                'Categoría no encontrada'
            );
        }

        if ($categoria['tipo'] !== 'gasto') {
            throw new Exception(
                'La categoría debe ser de gasto'
            );
        }

        $presupuesto = null;

        if (!empty($data['presupuesto_id'])) {

            $presupuesto =
                $this->presupuestos->find(
                    $data['presupuesto_id']
                );

            if (!$presupuesto) {
                throw new Exception(
                    'Presupuesto no encontrado'
                );
            }
        }

        $nuevo = [

            'uuid' =>
                Uuid::uuid4()->toString(),

            'usuario_id' =>
                $data['usuario_id'],

            'categoria_id' =>
                $data['categoria_id'],

            'presupuesto_id' =>
                $data['presupuesto_id'] ?? null,

            'descripcion' =>
                $data['descripcion'] ?? null,

            'monto' =>
                $data['monto'],

            'fecha' =>
                $data['fecha']
        ];

        $id =
            $this->gastos->insert(
                $nuevo
            );

        $gasto =
            $this->gastos->find($id);

        if ($presupuesto) {

            $gastado =
                (float)$presupuesto['gastado']
                +
                (float)$gasto['monto'];

            $estado = 'activo';

            if (
                $gastado >=
                (float)$presupuesto['monto']
            ) {
                $estado = 'agotado';
            }

            if (
                $gastado >
                (float)$presupuesto['monto']
            ) {
                $estado = 'excedido';
            }

            $this->presupuestos->update(
                $presupuesto['id'],
                [
                    'gastado' => $gastado,
                    'estado' => $estado
                ]
            );
        }

        service('auditService')
            ->registrar(
                $gasto['usuario_id'],
                'CREAR',
                'gastos',
                $gasto['id'],
                null,
                $gasto
            );

        service('logService')
            ->info(
                'GASTO_CREADO',
                'Gasto creado ID '
                . $gasto['id'],
                $gasto['usuario_id']
            );

        Events::trigger(
            'gasto_creado',
            $gasto
        );

        return $gasto;
    }
}