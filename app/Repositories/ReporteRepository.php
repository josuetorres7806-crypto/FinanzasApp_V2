<?php

namespace App\Repositories;

class ReporteRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function ingresos(
        int $usuarioId,
        ?string $desde = null,
        ?string $hasta = null
    ): array
    {
        $builder =
            $this->db
                ->table('ingresos')
                ->where(
                    'usuario_id',
                    $usuarioId
                );

        if ($desde) {
            $builder->where(
                'fecha >=',
                $desde
            );
        }

        if ($hasta) {
            $builder->where(
                'fecha <=',
                $hasta
            );
        }

        return $builder
            ->orderBy(
                'fecha',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }

    public function gastos(
        int $usuarioId,
        ?string $desde = null,
        ?string $hasta = null
    ): array
    {
        $builder =
            $this->db
                ->table('gastos')
                ->where(
                    'usuario_id',
                    $usuarioId
                );

        if ($desde) {
            $builder->where(
                'fecha >=',
                $desde
            );
        }

        if ($hasta) {
            $builder->where(
                'fecha <=',
                $hasta
            );
        }

        return $builder
            ->orderBy(
                'fecha',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }

    public function presupuestos(
        int $usuarioId
    ): array
    {
        return $this->db
            ->table('presupuestos')
            ->where(
                'usuario_id',
                $usuarioId
            )
            ->get()
            ->getResultArray();
    }
    public function gastosPorCategoria(
    int $usuarioId
): array
{
    return $this->db
        ->query("
            SELECT

                c.nombre categoria,

                SUM(g.monto) total

            FROM gastos g

            INNER JOIN categorias c
                ON c.id = g.categoria_id

            WHERE g.usuario_id = ?

            GROUP BY c.id

            ORDER BY total DESC
        ", [$usuarioId])
        ->getResultArray();
}
public function balanceMensual(
    int $usuarioId
): array
{
    return $this->db
        ->query("
            SELECT

                DATE_FORMAT(
                    fecha,
                    '%Y-%m'
                ) mes,

                SUM(monto) total,

                'ingreso' tipo

            FROM ingresos

            WHERE usuario_id = ?

            GROUP BY mes

            UNION ALL

            SELECT

                DATE_FORMAT(
                    fecha,
                    '%Y-%m'
                ) mes,

                SUM(monto) total,

                'gasto' tipo

            FROM gastos

            WHERE usuario_id = ?

            GROUP BY mes

            ORDER BY mes
        ",[
            $usuarioId,
            $usuarioId
        ])
        ->getResultArray();
}
}