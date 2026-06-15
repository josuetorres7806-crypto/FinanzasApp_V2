<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Repositories\GastoRepository;
use App\Services\GastoService;

class GastoController extends BaseController
{
    protected GastoService $service;

    protected GastoRepository $repository;

    public function __construct()
    {
        $this->service =
            new GastoService();

        $this->repository =
            new GastoRepository();
    }

    public function index()
    {
        $uid =
            session()->get('id');

        return $this->response
            ->setJSON([
                'success'=>true,
                'data'=>
                    $this->repository
                        ->listarPorUsuario($uid)
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
                'success'=>true,
                'data'=>
                    $this->service
                        ->crear(
                            $uid,
                            $data
                        )
            ]);
    }
}