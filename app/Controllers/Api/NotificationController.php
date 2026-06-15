<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\NotificationService;

class NotificationController
extends BaseController
{
    protected NotificationService $service;

    public function __construct()
    {
        $this->service =
            new NotificationService();
    }

    public function index()
    {
        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->listar(
                            session()->get('id')
                        )
            ]);
    }
}