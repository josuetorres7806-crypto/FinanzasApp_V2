<?php
/*
namespace App\Repositories;

use App\Models\UsuarioModel;

class UsuarioRepository
{
    public function __construct()
    {
        $this->model = new UsuarioModel();
    }

    public function buscarPorEmail(
        string $email
    )
    {
        return $this->model
            ->where('email',$email)
            ->first();
    }

    public function buscar(
        int $id
    )
    {
        return $this->model->find($id);
    }

    public function crear(
        array $data
    )
    {
        return $this->model->insert($data);
    }
}