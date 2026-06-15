<?php

namespace App\Services;

use App\Repositories\ReporteRepository;

class ReporteService
{
    protected ReporteRepository $repository;

    public function __construct()
    {
        $this->repository =
            new ReporteRepository();
    }

    public function general(
        int $usuarioId,
        ?string $desde = null,
        ?string $hasta = null
    ): array
    {
        $ingresos =
            $this->repository
                ->ingresos(
                    $usuarioId,
                    $desde,
                    $hasta
                );

        $gastos =
            $this->repository
                ->gastos(
                    $usuarioId,
                    $desde,
                    $hasta
                );

        $totalIngresos =
            array_sum(
                array_column(
                    $ingresos,
                    'monto'
                )
            );

        $totalGastos =
            array_sum(
                array_column(
                    $gastos,
                    'monto'
                )
            );

        return [

            'total_ingresos' =>
                $totalIngresos,

            'total_gastos' =>
                $totalGastos,

            'balance' =>
                $totalIngresos
                - $totalGastos,

            'ingresos' =>
                $ingresos,

            'gastos' =>
                $gastos
        ];
    }
    public function categorias(
    int $usuarioId
): array
{
    return [
        'categorias' =>
            $this->repository
                ->gastosPorCategoria(
                    $usuarioId
                )
    ];
}
}