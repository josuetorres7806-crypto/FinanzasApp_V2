<?php

namespace App\Services;

class LogService
{
    public function registrar(
        int $usuarioId,
        string $tipo,
        string $descripcion
    ): bool
    {
        return db_connect()
            ->table('logs_financieros')
            ->insert([
                'usuario_id' => $usuarioId,
                'tipo'       => $tipo,
                'descripcion'=> $descripcion,
                'created_at' => date('Y-m-d H:i:s')
            ]);
    }
}