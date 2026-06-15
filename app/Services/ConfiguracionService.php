<?php

namespace App\Services;

use App\Repositories\ConfiguracionRepository;

class ConfiguracionService
{
    protected ConfiguracionRepository $repository;

    protected AuditService $audit;

    protected LogService $logs;

    public function __construct()
    {
        $this->repository =
            new ConfiguracionRepository();

        $this->audit =
            new AuditService();

        $this->logs =
            new LogService();
    }

    public function listar(): array
    {
        return $this->repository
            ->listar();
    }

    public function actualizar(
        int $usuarioId,
        string $clave,
        string $valor
    ): bool
    {
        $anterior =
            $this->repository
                ->obtener($clave);

        $ok =
            $this->repository
                ->actualizar(
                    $clave,
                    $valor
                );

        if ($ok)
        {
            $this->audit->registrar(
                $usuarioId,
                'CONFIG_UPDATE',
                'configuraciones',
                0,
                $anterior,
                [
                    'clave' => $clave,
                    'valor' => $valor
                ]
            );

            $this->logs->registrar(
                $usuarioId,
                'CONFIGURACION_ACTUALIZADA',
                $clave
            );
        }

        return $ok;
    }
}