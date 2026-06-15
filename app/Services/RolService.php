<?php

namespace App\Services;

use App\Repositories\RolRepository;

class RolService
{
    protected RolRepository $repository;

    protected AuditService $audit;

    protected LogService $logs;

    public function __construct()
    {
        $this->repository =
            new RolRepository();

        $this->audit =
            new AuditService();

        $this->logs =
            new LogService();
    }

    public function crear(
        int $usuarioId,
        array $data
    )
    {
        $id =
            $this->repository
                ->crear($data);

        $rol =
            $this->repository
                ->buscar($id);

        $this->audit->registrar(
            $usuarioId,
            'CREAR',
            'roles',
            $id,
            [],
            $rol->toArray()
        );

        $this->logs->registrar(
            $usuarioId,
            'ROL_CREADO',
            $rol->nombre
        );

        return $rol;
    }

    public function asignarPermiso(
        int $usuarioId,
        int $rolId,
        int $permisoId
    ): bool
    {
        $ok =
            $this->repository
                ->asignarPermiso(
                    $rolId,
                    $permisoId
                );

        $this->logs->registrar(
            $usuarioId,
            'PERMISO_ASIGNADO',
            "Rol {$rolId} -> Permiso {$permisoId}"
        );

        return $ok;
    }
}