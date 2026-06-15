<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Repositories\IngresoRepository;
use App\Services\IngresoService;

class IngresoController extends BaseController
{
    protected IngresoService $service;

    protected IngresoRepository $repository;

    public function __construct()
    {
        $this->service =
            new IngresoService();

        $this->repository =
            new IngresoRepository();
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
                        ->listarPorUsuario($uid)
            ]);
    }

    public function show($id)
    {
        return $this->response
            ->setJSON([
                'success' => true,
                'data' =>
                    $this->repository
                        ->buscar($id)
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

    public function update($id)
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
                        ->actualizar(
                            $uid,
                            (int)$id,
                            $data
                        )
            ]);
    }

    public function delete($id)
    {
        $uid =
            session()->get('id');

        $this->service
            ->eliminar(
                $uid,
                (int)$id
            );

        return $this->response
            ->setJSON([
                'success' => true
            ]);
    }
}