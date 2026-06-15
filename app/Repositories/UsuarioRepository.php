<?php

namespace App\Repositories;

use App\Models\UsuarioModel;

class UsuarioRepository
{
    protected UsuarioModel $model;

    public function __construct()
    {
        $this->model =
            new UsuarioModel();
    }

    public function listar(): array
    {
        return $this->model
            ->findAll();
    }

    public function buscar(
        int $id
    )
    {
        return $this->model
            ->find($id);
    }

    public function actualizar(
        int $id,
        array $data
    ): bool
    {
        return $this->model
            ->update(
                $id,
                $data
            );
    }

    public function eliminar(
        int $id
    ): bool
    {
        return (bool)
            $this->model
                ->delete($id);
    }
    public function activar(
    int $id
): bool
{
    return $this->model->update(
        $id,
        [
            'activo' => 1
        ]
    );
}

public function desactivar(
    int $id
): bool
{
    return $this->model->update(
        $id,
        [
            'activo' => 0
        ]
    );
}

public function bloquear(
    int $id
): bool
{
    return $this->model->update(
        $id,
        [
            'bloqueado' => 1
        ]
    );
}

public function desbloquear(
    int $id
): bool
{
    return $this->model->update(
        $id,
        [
            'bloqueado' => 0
        ]
    );
}
public function asignarRol(
    int $usuarioId,
    int $rolId
): bool
{
    return db_connect()
        ->table(
            'usuario_roles'
        )
        ->insert([
            'usuario_id' =>
                $usuarioId,

            'rol_id' =>
                $rolId
        ]);
}
}