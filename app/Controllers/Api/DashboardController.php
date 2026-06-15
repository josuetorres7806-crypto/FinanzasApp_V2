<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\DashboardService;

class DashboardController
extends BaseController
{
    protected DashboardService $service;

    public function __construct()
    {
        $this->service =
            new DashboardService();
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