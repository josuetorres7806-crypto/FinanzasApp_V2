<?php

namespace App\Listeners;

class GastoListener
{
    public function handle(array $gasto): void
    {
        log_message(
            'info',
            'Evento gasto_creado ID '
            . $gasto['id']
        );
    }
}