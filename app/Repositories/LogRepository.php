<?php

namespace App\Repositories;

class LogRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function listar(
        array $filtros = [],
        int $page = 1,
        int $limit = 20
    ): array
    {
        $builder =
            $this->db
                ->table('logs');

        if (!empty($filtros['usuario_id']))
        {
            $builder->where(
                'usuario_id',
                $filtros['usuario_id']
            );
        }

        if (!empty($filtros['tipo']))
        {
            $builder->where(
                'tipo',
                $filtros['tipo']
            );
        }

        if (!empty($filtros['desde']))
        {
            $builder->where(
                'created_at >=',
                $filtros['desde']
            );
        }

        if (!empty($filtros['hasta']))
        {
            $builder->where(
                'created_at <=',
                $filtros['hasta']
            );
        }

        return $builder
            ->orderBy(
                'id',
                'DESC'
            )
            ->limit(
                $limit,
                ($page - 1) * $limit
            )
            ->get()
            ->getResultArray();
    }
    public function buscar(
    int $id
): ?array
{
    return $this->db
        ->table('logs')
        ->where('id', $id)
        ->get()
        ->getRowArray();
}
public function total(
    array $filtros = []
): int
{
    $builder =
        $this->db
            ->table('logs');

    if (!empty($filtros['usuario_id']))
    {
        $builder->where(
            'usuario_id',
            $filtros['usuario_id']
        );
    }

    if (!empty($filtros['tipo']))
    {
        $builder->where(
            'tipo',
            $filtros['tipo']
        );
    }

    return $builder
        ->countAllResults();
}
public function topEventos(): array
{
    return $this->db
        ->query("
            SELECT

                tipo,

                COUNT(*) total

            FROM logs

            GROUP BY tipo

            ORDER BY total DESC

            LIMIT 20
        ")
        ->getResultArray();
}
public function actividadDiaria(): array
{
    return $this->db
        ->query("
            SELECT

                DATE(created_at) fecha,

                COUNT(*) total

            FROM logs

            GROUP BY fecha

            ORDER BY fecha DESC

            LIMIT 30
        ")
        ->getResultArray();
}
}

