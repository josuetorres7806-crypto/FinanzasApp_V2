<?php

namespace App\Controllers\Api\Admin;

use App\Controllers\BaseController;
use App\Services\AdminDashboardService;

class DashboardController
extends BaseController
{
    protected AdminDashboardService $service;

    public function __construct()
    {
        $this->service =
            new AdminDashboardService();
    }

    public function index()
    {
        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->resumen()
            ]);
    }
}