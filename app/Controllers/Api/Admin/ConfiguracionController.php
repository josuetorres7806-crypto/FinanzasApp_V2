<?php

namespace App\Controllers\Api\Admin;

use App\Controllers\BaseController;
use App\Services\ConfiguracionService;

class ConfiguracionController
extends BaseController
{
    protected ConfiguracionService $service;

    public function __construct()
    {
        $this->service =
            new ConfiguracionService();
    }

    public function index()
    {
        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->listar()
            ]);
    }

    public function update()
    {
        $usuarioId =
            session()->get('id');

        $this->service->actualizar(
            $usuarioId,
            $this->request->getPost('clave'),
            $this->request->getPost('valor')
        );

        return $this->response
            ->setJSON([
                'success' => true
            ]);
    }
}