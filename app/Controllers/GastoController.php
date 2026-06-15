<?php

namespace App\Controllers;

use App\Services\GastoService;

class GastoController extends BaseController
{
    public function store()
    {
        $service =
            new GastoService();

        $data = [

            'usuario_id' =>
                auth()->id(),

            'categoria_id' =>
                $this->request->getPost(
                    'categoria_id'
                ),

            'presupuesto_id' =>
                $this->request->getPost(
                    'presupuesto_id'
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