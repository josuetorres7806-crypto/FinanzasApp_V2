<?php

namespace App\Controllers;

use App\Models\IngresoModel;
use App\Models\CategoriaModel;

class IngresoController extends BaseController
{
    protected IngresoModel $model;

    public function __construct()
    {
        $this->model =
            new IngresoModel();
    }

    public function index()
    {
        $ingresos =
            $this->model
                ->where('usuario_id', 1)
                ->orderBy('id', 'DESC')
                ->findAll();

        return view(
            'ingresos/index',
            compact('ingresos')
        );
    }

    public function create()
    {
        $categorias =
            (new CategoriaModel())
                ->where('tipo', 'ingreso')
                ->findAll();

        return view(
            'ingresos/create',
            compact('categorias')
        );
    }

    public function store()
    {
        $this->model->insert([

            'uuid' =>
                \Ramsey\Uuid\Uuid::uuid4()
                    ->toString(),

            'usuario_id' => 1,

            'categoria_id' =>
                $this->request
                    ->getPost('categoria_id'),

            'descripcion' =>
                $this->request
                    ->getPost('descripcion'),

            'monto' =>
                $this->request
                    ->getPost('monto'),

            'fecha' =>
                $this->request
                    ->getPost('fecha')
        ]);

        return redirect()
            ->to('/ingresos');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()
            ->to('/ingresos');
    }
}