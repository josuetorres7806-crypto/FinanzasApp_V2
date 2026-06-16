<?php

namespace App\Controllers;

use App\Models\PresupuestoModel;
use Ramsey\Uuid\Uuid;

class PresupuestoController extends BaseController
{
    protected PresupuestoModel $model;

    public function __construct()
    {
        $this->model = new PresupuestoModel();
    }

    public function index()
    {
        $presupuestos = $this->model
            ->where('usuario_id', 1)
            ->findAll();

        return view(
            'presupuestos/index',
            compact('presupuestos')
        );
    }

    public function create()
    {
        return view(
            'presupuestos/create'
        );
    }

    public function store()
    {
        $this->model->insert([

            'uuid' =>
                Uuid::uuid4()->toString(),

            'usuario_id' => 1,

            'nombre' =>
                $this->request->getPost('nombre'),

            'descripcion' =>
                $this->request->getPost('descripcion'),

            'monto' =>
                $this->request->getPost('monto'),

            'fecha_inicio' =>
                $this->request->getPost('fecha_inicio'),

            'fecha_fin' =>
                $this->request->getPost('fecha_fin'),

            'estado' => 'activo'
        ]);

        return redirect()
            ->to('/presupuestos');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()
            ->to('/presupuestos');
    }
}