<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected DashboardRepository $repository;

    public function __construct()
    {
        $this->repository =
            new DashboardRepository();
    }

    public function resumen(
    int $usuarioId
): array
{
    $ingresos =
        $this->repository
            ->totalIngresos(
                $usuarioId
            );

    $gastos =
        $this->repository
            ->totalGastos(
                $usuarioId
            );

    return [

        'kpis' => [

            'saldo_actual' =>
                $ingresos - $gastos,

            'ingresos_totales' =>
                $ingresos,

            'gastos_totales' =>
                $gastos,

            'ingresos_mes' =>
                $this->repository
                    ->ingresosMes(
                        $usuarioId
                    ),

            'gastos_mes' =>
                $this->repository
                    ->gastosMes(
                        $usuarioId
                    ),

            'cantidad_ingresos' =>
                $this->repository
                    ->cantidadIngresos(
                        $usuarioId
                    ),

            'cantidad_gastos' =>
                $this->repository
                    ->cantidadGastos(
                        $usuarioId
                    ),

            'presupuestos_activos' =>
                $this->repository
                    ->presupuestosActivos(
                        $usuarioId
                    )
        ],

        'ultimos_ingresos' =>
            $this->repository
                ->ultimosIngresos(
                    $usuarioId
                ),

        'ultimos_gastos' =>
            $this->repository
                ->ultimosGastos(
                    $usuarioId
                ),

        'notificaciones' =>
            $this->repository
                ->notificaciones(
                    $usuarioId
                ),

        'top_categorias' =>
            $this->repository
                ->topCategorias(
                    $usuarioId
                ),

        'balance_mensual' =>
            $this->repository
                ->balanceMensual(
                    $usuarioId
                ),

        'presupuestos_criticos' =>
            $this->repository
                ->presupuestosCriticos(
                    $usuarioId
                )
    ];
}
}