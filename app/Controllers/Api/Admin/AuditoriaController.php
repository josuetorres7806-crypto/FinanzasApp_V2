<?php

namespace App\Controllers\Api\Admin;

use App\Controllers\BaseController;
use App\Services\AuditoriaService;

class AuditoriaController
extends BaseController
{
    protected AuditoriaService $service;

    public function __construct()
    {
        $this->service =
            new AuditoriaService();
    }

    public function index()
    {
        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->listar(
                            $this->request->getGet(),
                            (int)(
                                $this->request
                                    ->getGet('page')
                                    ?? 1
                            ),
                            (int)(
                                $this->request
                                    ->getGet('limit')
                                    ?? 20
                            )
                        )
            ]);
    }

    public function show(
        $id
    )
    {
        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->detalle(
                            (int)$id
                        )
            ]);
    }
}