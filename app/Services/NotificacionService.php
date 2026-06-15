<?php

namespace App\Services;

class NotificationService
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function crear(
        int $usuarioId,
        string $titulo,
        string $mensaje
    ): bool
    {
        return $this->db
            ->table('notificaciones')
            ->insert([
                'usuario_id' => $usuarioId,
                'titulo'     => $titulo,
                'mensaje'    => $mensaje,
                'created_at' => date('Y-m-d H:i:s')
            ]);
    }

    public function listar(
        int $usuarioId
    ): array
    {
        return $this->db
            ->table('notificaciones')
            ->where(
                'usuario_id',
                $usuarioId
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }

    public function totalPendientes(
        int $usuarioId
    ): int
    {
        return $this->db
            ->table('notificaciones')
            ->where(
                'usuario_id',
                $usuarioId
            )
            ->countAllResults();
    }

    public function eliminar(
        int $id
    ): bool
    {
        return $this->db
            ->table('notificaciones')
            ->delete([
                'id' => $id
            ]);
    }
}