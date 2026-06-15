<?php

namespace App\Repositories;

class NotificationRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function crear(
        array $data
    ): int
    {
        $this->db
            ->table('notificaciones')
            ->insert($data);

        return (int)
            $this->db
                ->insertID();
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
            ->where(
                'archivada',
                0
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }

    public function marcarLeida(
        int $id
    ): bool
    {
        return $this->db
            ->table('notificaciones')
            ->where('id', $id)
            ->update([
                'leida' => 1
            ]);
    }

    public function archivar(
        int $id
    ): bool
    {
        return $this->db
            ->table('notificaciones')
            ->where('id', $id)
            ->update([
                'archivada' => 1
            ]);
    }

    public function pendientes(
        int $usuarioId
    ): int
    {
        return $this->db
            ->table('notificaciones')
            ->where(
                'usuario_id',
                $usuarioId
            )
            ->where(
                'leida',
                0
            )
            ->countAllResults();
    }

}