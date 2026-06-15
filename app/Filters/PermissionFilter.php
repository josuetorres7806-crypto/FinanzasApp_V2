<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Services\PermissionService;

class PermissionFilter
implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    )
    {
        $usuarioId =
            session()->get('id');

        $permiso =
            $arguments[0] ?? null;

        if (!$permiso)
        {
            return;
        }

        $service =
            new PermissionService();

        if (
            !$service->tienePermiso(
                $usuarioId,
                $permiso
            )
        )
        {
            return service('response')
                ->setStatusCode(403)
                ->setJSON([
                    'success' => false,
                    'message' => 'Acceso denegado'
                ]);
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
    }
}