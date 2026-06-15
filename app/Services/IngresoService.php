<?php

namespace App\Services;

use App\Models\IngresoModel;
use App\Models\CategoriaModel;
use App\Models\MetaAhorroModel;
use CodeIgniter\Events\Events;
use Ramsey\Uuid\Uuid;
use Exception;

class IngresoService
{
    public function crear(array $data): array
    {
        $ingresos = new IngresoModel();

        $categorias = new CategoriaModel();

        $metaModel = new MetaAhorroModel();

        $audit = service('auditService');

        $logs = service('logService');

        $categoria = $categorias->find(
            $data['categoria_id']
        );

        if (!$categoria) {
            throw new Exception(
                'Categoría no encontrada'
            );
        }

        if ($categoria['tipo'] !== 'ingreso') {
            throw new Exception(
                'La categoría no es de ingreso'
            );
        }

        $nuevo = [

            'uuid' => Uuid::uuid4()->toString(),

            'usuario_id' => $data['usuario_id'],

            'categoria_id' => $data['categoria_id'],

            'meta_ahorro_id' =>
                $data['meta_ahorro_id'] ?? null,

            'descripcion' =>
                $data['descripcion'] ?? null,

            'monto' =>
                $data['monto'],

            'fecha' =>
                $data['fecha']
        ];

        $id = $ingresos->insert($nuevo);

        $registro = $ingresos->find($id);

        if (!empty($registro['meta_ahorro_id'])) {

            $meta = $metaModel->find(
                $registro['meta_ahorro_id']
            );

            if ($meta) {

                $nuevoMonto =
                    $meta['monto_actual']
                    + $registro['monto'];

                $estado = $meta['estado'];

                if (
                    $nuevoMonto >=
                    $meta['monto_objetivo']
                ) {
                    $estado = 'completada';
                }

                $metaModel->update(
                    $meta['id'],
                    [
                        'monto_actual' => $nuevoMonto,
                        'estado' => $estado
                    ]
                );
            }
        }

        $audit->registrar(
            $registro['usuario_id'],
            'CREAR',
            'ingresos',
            $registro['id'],
            null,
            $registro
        );

        $logs->info(
            'INGRESO_CREADO',
            'Ingreso creado ID: '
            . $registro['id'],
            $registro['usuario_id']
        );

        Events::trigger(
            'ingreso_creado',
            $registro
        );

        return $registro;
    }
}