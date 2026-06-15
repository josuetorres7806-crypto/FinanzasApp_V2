<?php

namespace App\Services;

use App\Repositories\GastoRepository;
use CodeIgniter\Events\Events;

class GastoService
{
    protected GastoRepository $repository;
    protected AuditService $audit;
    protected LogService $logs;
    protected NotificationService $notifications;

    public function __construct()
    {
        $this->repository = new GastoRepository();
        $this->audit = new AuditService();
        $this->logs = new LogService();
        $this->notifications = new NotificationService();
    }

    /**
     * Crear gasto
     */
    public function crear(
        int $usuarioId,
        array $data
    )
    {
        $data['usuario_id'] = $usuarioId;

        $id = $this->repository->crear($data);

        if (!$id) {
            throw new \Exception(
                'No fue posible crear el gasto.'
            );
        }

        $nuevo = $this->repository->buscar($id);

        if (!$nuevo) {
            throw new \Exception(
                'No fue posible recuperar el gasto creado.'
            );
        }

        // Auditoría
        $this->audit->registrar(
            $usuarioId,
            'CREAR',
            'gastos',
            $id,
            [],
            $nuevo->toArray()
        );

        // Logs
        $this->logs->registrar(
            $usuarioId,
            'GASTO_CREADO',
            'Se creó el gasto #' . $id
        );

        // Integración con presupuestos
        if (
            !empty($nuevo->presupuesto_id)
        ) {
            $presupuestoService =
                new PresupuestoService();

            $presupuestoService
                ->verificarLimites(
                    (int)$nuevo->presupuesto_id
                );
        }

        cache()->delete(
            "dashboard_{$usuarioId}"
        );

        Events::trigger(
            'gasto_creado',
            $nuevo
        );

        return $nuevo;
    }

    /**
     * Actualizar gasto
     */
    public function actualizar(
        int $usuarioId,
        int $id,
        array $data
    )
    {
        $antes =
            $this->repository->buscar($id);

        if (!$antes) {
            throw new \Exception(
                'Gasto no encontrado.'
            );
        }

        $actualizado =
            $this->repository->actualizar(
                $id,
                $data
            );

        if (!$actualizado) {
            throw new \Exception(
                'No fue posible actualizar el gasto.'
            );
        }

        $despues =
            $this->repository->buscar($id);

        if (!$despues) {
            throw new \Exception(
                'No fue posible recuperar el gasto actualizado.'
            );
        }

        // Auditoría
        $this->audit->registrar(
            $usuarioId,
            'ACTUALIZAR',
            'gastos',
            $id,
            $antes->toArray(),
            $despues->toArray()
        );

        // Logs
        $this->logs->registrar(
            $usuarioId,
            'GASTO_ACTUALIZADO',
            'Se actualizó el gasto #' . $id
        );

        // Integración con presupuestos
        if (
            !empty($despues->presupuesto_id)
        ) {
            $presupuestoService =
                new PresupuestoService();

            $presupuestoService
                ->verificarLimites(
                    (int)$despues->presupuesto_id
                );
        }

        cache()->delete(
            "dashboard_{$usuarioId}"
        );

        Events::trigger(
            'gasto_actualizado',
            $despues
        );

        return $despues;
    }

    /**
     * Eliminar gasto
     */
    public function eliminar(
        int $usuarioId,
        int $id
    ): bool
    {
        $gasto =
            $this->repository->buscar($id);

        if (!$gasto) {
            throw new \Exception(
                'Gasto no encontrado.'
            );
        }

        $antes =
            $gasto->toArray();

        $eliminado =
            $this->repository->eliminar($id);

        if (!$eliminado) {
            throw new \Exception(
                'No fue posible eliminar el gasto.'
            );
        }

        // Auditoría
        $this->audit->registrar(
            $usuarioId,
            'ELIMINAR',
            'gastos',
            $id,
            $antes,
            []
        );

        // Logs
        $this->logs->registrar(
            $usuarioId,
            'GASTO_ELIMINADO',
            'Se eliminó el gasto #' . $id
        );

        cache()->delete(
            "dashboard_{$usuarioId}"
        );

        Events::trigger(
            'gasto_eliminado',
            $gasto
        );

        return true;
    }

    /**
     * Obtener gasto por ID
     */
    public function obtener(
        int $id
    )
    {
        return $this->repository->buscar($id);
    }

    /**
     * Listar gastos por usuario
     */
    public function listarPorUsuario(
        int $usuarioId
    ): array
    {
        return $this->repository
            ->listarPorUsuario(
                $usuarioId
            );
    }
}