<?php

namespace App\Services;

use App\Repositories\IngresoRepository;
use App\Services\AuditService;
use App\Services\LogService;
use CodeIgniter\Events\Events;
use Exception;

class IngresoService
{
    protected IngresoRepository $repository;
    protected AuditService $audit;
    protected LogService $logs;

    public function __construct()
    {
        $this->repository = new IngresoRepository();
        $this->audit = new AuditService();
        $this->logs = new LogService();
    }

    /**
     * Crear ingreso
     */
    public function crear(
        int $usuarioId,
        array $data
    )
    {
        $data['usuario_id'] = $usuarioId;

        $id = $this->repository->crear($data);

        if (!$id) {
            throw new Exception(
                'No fue posible crear el ingreso.'
            );
        }

        $nuevoIngreso =
            $this->repository->buscar($id);

        if (!$nuevoIngreso) {
            throw new Exception(
                'No fue posible recuperar el ingreso creado.'
            );
        }

        $this->audit->registrar(
            $usuarioId,
            'CREAR',
            'ingresos',
            $id,
            [],
            $nuevoIngreso->toArray()
        );

        $this->logs->registrar(
            $usuarioId,
            'INGRESO_CREADO',
            'Se creó el ingreso #' . $id
        );

        cache()->delete(
            "dashboard_{$usuarioId}"
        );

        Events::trigger(
            'ingreso_creado',
            $nuevoIngreso
        );

        return $nuevoIngreso;
    }

    /**
     * Actualizar ingreso
     */
    public function actualizar(
        int $usuarioId,
        int $id,
        array $data
    )
    {
        $ingresoActual =
            $this->repository->buscar($id);

        if (!$ingresoActual) {
            throw new Exception(
                'Ingreso no encontrado.'
            );
        }

        $antes =
            $ingresoActual->toArray();

        $actualizado =
            $this->repository->actualizar(
                $id,
                $data
            );

        if (!$actualizado) {
            throw new Exception(
                'No fue posible actualizar el ingreso.'
            );
        }

        $despuesIngreso =
            $this->repository->buscar($id);

        $this->audit->registrar(
            $usuarioId,
            'ACTUALIZAR',
            'ingresos',
            $id,
            $antes,
            $despuesIngreso->toArray()
        );

        $this->logs->registrar(
            $usuarioId,
            'INGRESO_ACTUALIZADO',
            'Se actualizó el ingreso #' . $id
        );

        cache()->delete(
            "dashboard_{$usuarioId}"
        );

        Events::trigger(
            'ingreso_actualizado',
            $despuesIngreso
        );

        return $despuesIngreso;
    }

    /**
     * Eliminar ingreso (Soft Delete)
     */
    public function eliminar(
        int $usuarioId,
        int $id
    ): bool
    {
        $ingreso =
            $this->repository->buscar($id);

        if (!$ingreso) {
            throw new Exception(
                'Ingreso no encontrado.'
            );
        }

        $antes =
            $ingreso->toArray();

        $eliminado =
            $this->repository->eliminar($id);

        if (!$eliminado) {
            throw new Exception(
                'No fue posible eliminar el ingreso.'
            );
        }

        $this->audit->registrar(
            $usuarioId,
            'ELIMINAR',
            'ingresos',
            $id,
            $antes,
            []
        );

        $this->logs->registrar(
            $usuarioId,
            'INGRESO_ELIMINADO',
            'Se eliminó el ingreso #' . $id
        );

        cache()->delete(
            "dashboard_{$usuarioId}"
        );

        Events::trigger(
            'ingreso_eliminado',
            $ingreso
        );

        return true;
    }

    /**
     * Obtener ingreso por ID
     */
    public function obtener(
        int $id
    )
    {
        return $this->repository->buscar($id);
    }

    /**
     * Listar ingresos de usuario
     */
    public function listarPorUsuario(
        int $usuarioId
    ): array
    {
        return $this->repository
            ->listarPorUsuario($usuarioId);
    }
}