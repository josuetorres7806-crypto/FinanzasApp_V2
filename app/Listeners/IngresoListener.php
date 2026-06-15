<?php

namespace App\Listeners;

use App\Services\DashboardService;
use App\Services\NotificacionService;

class IngresoListener
{
    public function handle(array $ingreso): void
    {
        $dashboard =
            new DashboardService();

        $dashboard->actualizarCache(
            $ingreso['usuario_id']
        );

        if (
            $ingreso['monto'] >= 1000000
        ) {
            $notificaciones =
                new NotificacionService();

            $notificaciones->crear([
                'usuario_id' =>
                    $ingreso['usuario_id'],

                'titulo' =>
                    'Ingreso importante',

                'mensaje' =>
                    'Se registró un ingreso por '
                    . number_format(
                        $ingreso['monto'],
                        2
                    ),

                'tipo' =>
                    'INGRESO_IMPORTANTE'
            ]);
        }
    }
}