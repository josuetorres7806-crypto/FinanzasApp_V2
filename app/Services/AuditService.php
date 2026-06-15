<?php

namespace App\Services;

class AuditService
{
    public function registrar(
        int $usuarioId,
        string $accion,
        string $tabla,
        int $registroId,
        array $antes = [],
        array $despues = []
    ): bool
    {
        return db_connect()
            ->table('auditoria_financiera')
            ->insert([
                'usuario_id'       => $usuarioId,
                'accion'           => $accion,
                'tabla_afectada'   => $tabla,
                'registro_id'      => $registroId,
                'datos_anteriores' => json_encode($antes),
                'datos_nuevos'     => json_encode($despues),
                'created_at'       => date('Y-m-d H:i:s')
            ]);
    }
}