<?php

namespace App\Services;

use App\Repositories\EstadisticaRepository;

class EstadisticaService
{
    protected EstadisticaRepository $repository;

    public function __construct()
    {
        $this->repository =
            new EstadisticaRepository();
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

        $ahorro =
            $ingresos - $gastos;

        $porcentajeAhorro =
            $ingresos > 0
            ? round(
                (
                    $ahorro
                    /
                    $ingresos
                ) * 100,
                2
            )
            : 0;

        return [

            'ingresos_mensuales' =>
                $this->repository
                    ->ingresosMensuales(
                        $usuarioId
                    ),

            'gastos_mensuales' =>
                $this->repository
                    ->gastosMensuales(
                        $usuarioId
                    ),

            'totales' => [

                'ingresos' =>
                    $ingresos,

                'gastos' =>
                    $gastos,

                'ahorro' =>
                    $ahorro,

                'porcentaje_ahorro' =>
                    $porcentajeAhorro
            ]
        ];
    }
}