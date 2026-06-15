<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\EstadisticaService;

class EstadisticaController
extends BaseController
{
    protected EstadisticaService $service;

    public function __construct()
    {
        $this->service =
            new EstadisticaService();
    }

    public function index()
    {
        $uid =
            session()->get('id');

        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->resumen(
                            $uid
                        )
            ]);
    }
}