<?php

namespace App\Services;

use App\Repositories\AdminDashboardRepository;

class AdminDashboardService
{
    protected AdminDashboardRepository $repository;

    public function __construct()
    {
        $this->repository =
            new AdminDashboardRepository();
    }

    public function resumen(): array
    {
        return [

            'usuarios' => [
                'total' =>
                    $this->repository
                        ->totalUsuarios(),

                'activos' =>
                    $this->repository
                        ->usuariosActivos(),

                'bloqueados' =>
                    $this->repository
                        ->usuariosBloqueados()
            ],

            'finanzas' => [
                'ingresos' =>
                    $this->repository
                        ->totalIngresos(),

                'gastos' =>
                    $this->repository
                        ->totalGastos()
            ],

            'presupuestos' =>
                $this->repository
                    ->totalPresupuestos(),

            'logs' =>
                $this->repository
                    ->totalLogs(),

            'auditoria' =>
                $this->repository
                    ->totalAuditoria(),

            'ultimos_usuarios' =>
                $this->repository
                    ->ultimosUsuarios(),

            'actividad_reciente' =>
                $this->repository
                    ->actividadReciente()
        ];
    }
}