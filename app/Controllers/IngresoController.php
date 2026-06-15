<?php

namespace App\Controllers;

use App\Services\IngresoService;

class IngresoController extends BaseController
{
    public function store()
    {
        $service =
            new IngresoService();

        $data = [

            'usuario_id' =>
                auth()->id(),

            'categoria_id' =>
                $this->request->getPost(
                    'categoria_id'
                ),

            'meta_ahorro_id' =>
                $this->request->getPost(
                    'meta_ahorro_id'
                ),

            'descripcion' =>
                $this->request->getPost(
                    'descripcion'
                ),

            'monto' =>
                $this->request->getPost(
                    'monto'
                ),

            'fecha' =>
                $this->request->getPost(
                    'fecha'
                )
        ];

        return $this->response->setJSON(
            $service->crear($data)
        );
    }
}