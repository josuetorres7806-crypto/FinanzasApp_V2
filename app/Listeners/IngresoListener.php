<?php

namespace App\Listeners;

use CodeIgniter\Events\Events;

Events::on(
    'ingreso_creado',
    function($ingreso){

        log_message(
            'info',
            'Nuevo ingreso ID: ' .
            $ingreso->id
        );
    }
);