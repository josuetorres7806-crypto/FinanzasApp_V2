<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get( '/', 'DashboardController::index' );
 $routes->get( 'dashboard', 'DashboardController::index' );

 $routes->get(
    'ingresos',
    'IngresoController::index'
);

$routes->get(
    'ingresos/create',
    'IngresoController::create'
);

$routes->post(
    'ingresos/store',
    'IngresoController::store'
);

$routes->get(
    'ingresos/edit/(:num)',
    'IngresoController::edit/$1'
);

$routes->post(
    'ingresos/update/(:num)',
    'IngresoController::update/$1'
);

$routes->get(
    'ingresos/delete/(:num)',
    'IngresoController::delete/$1'
);
//////////////////////
//////GASTOS//////////
//////////////////////
$routes->get(
    'gastos',
    'GastoController::index'
);

$routes->get(
    'gastos/create',
    'GastoController::create'
);

$routes->post(
    'gastos/store',
    'GastoController::store'
);

$routes->get(
    'gastos/edit/(:num)',
    'GastoController::edit/$1'
);

$routes->post(
    'gastos/update/(:num)',
    'GastoController::update/$1'
);

$routes->get(
    'gastos/delete/(:num)',
    'GastoController::delete/$1'
);
///////////////////////////
//////presupuesto//////////
///////////////////////////

$routes->get(
    'presupuestos',
    'PresupuestoController::index'
);

$routes->get(
    'presupuestos/create',
    'PresupuestoController::create'
);

$routes->post(
    'presupuestos/store',
    'PresupuestoController::store'
);

$routes->get(
    'presupuestos/delete/(:num)',
    'PresupuestoController::delete/$1'
);