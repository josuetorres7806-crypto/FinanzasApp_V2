<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\ReporteService;

class ReporteController
extends BaseController
{
    protected ReporteService $service;

    public function __construct()
    {
        $this->service =
            new ReporteService();
    }

    public function general()
    {
        $uid =
            session()->get('id');

        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->general(
                            $uid,
                            $this->request->getGet('desde'),
                            $this->request->getGet('hasta')
                        )
            ]);
    }
    public function categorias()
{
    $uid =
        session()->get('id');

    return $this->response
        ->setJSON([
            'success' => true,
            'data' =>
                $this->service
                    ->categorias(
                        $uid
                    )
        ]);
}
public function balance()
{
    $uid =
        session()->get('id');

    return $this->response
        ->setJSON([
            'success' => true,
            'data' =>
                $this->repository
                    ->balanceMensual(
                        $uid
                    )
        ]);
}
}