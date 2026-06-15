<?php

namespace App\Controllers\Api\Admin;

use App\Controllers\BaseController;
use App\Services\UsuarioAdminService;

class UsuarioController
extends BaseController
{
    protected UsuarioAdminService $service;

    public function __construct()
    {
        $this->service =
            new UsuarioAdminService();
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

    public function delete(
        $id
    )
    {
        $adminId =
            session()
                ->get('id');

        $this->service
            ->eliminar(
                $adminId,
                (int)$id
            );

        return $this->response
            ->setJSON([
                'success' => true
            ]);
    }
    public function activar(
    $id
)
{
    $adminId =
        session()->get('id');

    $this->service
        ->activar(
            $adminId,
            (int)$id
        );

    return $this->response
        ->setJSON([
            'success' => true
        ]);
}
public function desactivar(
    $id
)
{
    $adminId =
        session()->get('id');

    $this->service
        ->desactivar(
            $adminId,
            (int)$id
        );

    return $this->response
        ->setJSON([
            'success' => true
        ]);
}
public function bloquear(
    $id
)
{
    $adminId =
        session()->get('id');

    $this->service
        ->bloquear(
            $adminId,
            (int)$id
        );

    return $this->response
        ->setJSON([
            'success' => true
        ]);
}
public function desbloquear(
    $id
)
{
    $adminId =
        session()->get('id');

    $this->service
        ->desbloquear(
            $adminId,
            (int)$id
        );

    return $this->response
        ->setJSON([
            'success' => true
        ]);
}
}