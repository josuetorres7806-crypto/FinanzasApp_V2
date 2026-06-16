<?php

namespace App\Controllers;

use App\Models\GastoModel;
use App\Models\CategoriaModel;
use App\Models\PresupuestoModel;

class GastoController extends BaseController
{
    protected GastoModel $model;

    public function __construct()
    {
        $this->model = new GastoModel();
    }

    public function index()
    {
        $gastos = $this->model
            ->where('usuario_id', 1)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view(
            'gastos/index',
            compact('gastos')
        );
    }

    public function create()
    {
        $categorias =
            (new CategoriaModel())
                ->where('tipo', 'gasto')
                ->findAll();

        $presupuestos =
            (new PresupuestoModel())
                ->where('usuario_id', 1)
                ->findAll();

        return view(
            'gastos/create',
            compact(
                'categorias',
                'presupuestos'
            )
        );
    }

public function store()
{
    $presupuestoId =
        $this->request->getPost('presupuesto_id');

    if ($presupuestoId === '') {
        $presupuestoId = null;
    }

    $data = [

        'uuid' =>
            \Ramsey\Uuid\Uuid::uuid4()->toString(),

        'usuario_id' => 1,

        'categoria_id' =>
            $this->request->getPost('categoria_id'),

        'presupuesto_id' =>
            $presupuestoId,

        'descripcion' =>
            $this->request->getPost('descripcion'),

        'monto' =>
            $this->request->getPost('monto'),

        'fecha' =>
            $this->request->getPost('fecha')
    ];

    $ok = $this->model->insert($data);

    if (!$ok) {

        dd([
            'errores_modelo' =>
                $this->model->errors(),

            'data' => $data
        ]);
    }

    return redirect()->to('/gastos');
}

}