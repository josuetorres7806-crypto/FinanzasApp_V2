<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->group(
    'api',
    ['filter' => 'jwt'],
    function($routes){

        $routes->resource(
            'ingresos',
            [
                'controller' =>
                    'Api\IngresoController'
            ]
        );
    }
);
$routes->group(
    'api/presupuestos',
    static function ($routes)
    {
        $routes->get(
            '/',
            'Api\PresupuestoController::index'
        );

        $routes->get(
            '(:num)',
            'Api\PresupuestoController::show/$1'
        );

        $routes->get(
            '(:num)/resumen',
            'Api\PresupuestoController::resumen/$1'
        );

        $routes->post(
            '/',
            'Api\PresupuestoController::create'
        );

        $routes->put(
            '(:num)',
            'Api\PresupuestoController::update/$1'
        );

        $routes->delete(
            '(:num)',
            'Api\PresupuestoController::delete/$1'
        );
    }
);
$routes->get(
    'api/dashboard',
    'Api\DashboardController::index'
);
$routes->get(
    'api/estadisticas',
    'Api\EstadisticaController::index'
);
$routes->group(
    'api/admin',
    static function($routes)
    {
        $routes->get(
            'usuarios',
            'Api\Admin\UsuarioController::index'
        );

        $routes->delete(
            'usuarios/(:num)',
            'Api\Admin\UsuarioController::delete/$1'
        );
    }
);