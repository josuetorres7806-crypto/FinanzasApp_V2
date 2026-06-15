<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\PresupuestoService;
use App\Repositories\PresupuestoRepository;

class PresupuestoController
extends BaseController
{
    protected PresupuestoService $service;

    protected PresupuestoRepository $repository;

    public function __construct()
    {
        $this->service =
            new PresupuestoService();

        $this->repository =
            new PresupuestoRepository();
    }

    public function index()
    {
        $uid =
            session()->get('id');

        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->repository
                        ->listarPorUsuario(
                            $uid
                        )
            ]);
    }

    public function create()
    {
        $uid =
            session()->get('id');

        $data =
            $this->request
                ->getJSON(true);

        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->service
                        ->crear(
                            $uid,
                            $data
                        )
            ]);
    }
}