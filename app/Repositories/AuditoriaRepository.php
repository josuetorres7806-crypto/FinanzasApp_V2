<?php

namespace App\Repositories;

class AuditoriaRepository
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
                ->table('auditoria a')
                ->select('a.*');

        if (!empty($filtros['usuario_id']))
        {
            $builder->where(
                'a.usuario_id',
                $filtros['usuario_id']
            );
        }

        if (!empty($filtros['tabla']))
        {
            $builder->where(
                'a.tabla',
                $filtros['tabla']
            );
        }

        if (!empty($filtros['accion']))
        {
            $builder->where(
                'a.accion',
                $filtros['accion']
            );
        }

        if (!empty($filtros['desde']))
        {
            $builder->where(
                'a.created_at >=',
                $filtros['desde']
            );
        }

        if (!empty($filtros['hasta']))
        {
            $builder->where(
                'a.created_at <=',
                $filtros['hasta']
            );
        }

        return $builder
            ->orderBy(
                'a.id',
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
        ->table('auditoria')
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
            ->table('auditoria');

    if (!empty($filtros['usuario_id']))
    {
        $builder->where(
            'usuario_id',
            $filtros['usuario_id']
        );
    }

    if (!empty($filtros['tabla']))
    {
        $builder->where(
            'tabla',
            $filtros['tabla']
        );
    }

    return $builder->countAllResults();
}
}