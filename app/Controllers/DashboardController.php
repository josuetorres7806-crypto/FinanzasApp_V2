<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = db_connect();

        $usuarioId = 1;

        // Totales generales

        $ingresos = $db
            ->table('ingresos')
            ->selectSum('monto')
            ->where('usuario_id', $usuarioId)
            ->get()
            ->getRow()
            ->monto ?? 0;

        $gastos = $db
            ->table('gastos')
            ->selectSum('monto')
            ->where('usuario_id', $usuarioId)
            ->get()
            ->getRow()
            ->monto ?? 0;

        // Cantidad de presupuestos

        $presupuestos = $db
            ->table('presupuestos')
            ->where('usuario_id', $usuarioId)
            ->countAllResults();

        // Últimos ingresos

        $ultimosIngresos = $db
            ->table('ingresos')
            ->where('usuario_id', $usuarioId)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        // Últimos gastos

        $ultimosGastos = $db
            ->table('gastos')
            ->where('usuario_id', $usuarioId)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        // Ingresos mensuales para gráfica

        $ingresosMensuales = $db
            ->query("
                SELECT
                    DATE_FORMAT(fecha,'%Y-%m') mes,
                    SUM(monto) total
                FROM ingresos
                WHERE usuario_id = ?
                GROUP BY DATE_FORMAT(fecha,'%Y-%m')
                ORDER BY mes
            ", [$usuarioId])
            ->getResultArray();

        // Gastos mensuales para gráfica

        $gastosMensuales = $db
            ->query("
                SELECT
                    DATE_FORMAT(fecha,'%Y-%m') mes,
                    SUM(monto) total
                FROM gastos
                WHERE usuario_id = ?
                GROUP BY DATE_FORMAT(fecha,'%Y-%m')
                ORDER BY mes
            ", [$usuarioId])
            ->getResultArray();

        return view(
            'dashboard/index',
            [
                'ingresos' => $ingresos,

                'gastos' => $gastos,

                'balance' => $ingresos - $gastos,

                'presupuestos' => $presupuestos,

                'ultimosIngresos' => $ultimosIngresos,

                'ultimosGastos' => $ultimosGastos,

                'ingresosMensuales' => $ingresosMensuales,

                'gastosMensuales' => $gastosMensuales
            ]
        );
    }
}