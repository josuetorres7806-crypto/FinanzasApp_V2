<?php

namespace App\Controllers\Api\Admin;

use App\Controllers\BaseController;
use App\Services\LogAdminService;

class LogController
extends BaseController
{
    protected LogAdminService $service;

    public function __construct()
    {
        $this->service =
            new LogAdminService();
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
                                $this->request->getGet('page')
                                ?? 1
                            ),
                            (int)(
                                $this->request->getGet('limit')
                                ?? 20
                            )
                        )
            ]);
    }

    public function dashboard()
    {
        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->dashboard()
            ]);
    }
}