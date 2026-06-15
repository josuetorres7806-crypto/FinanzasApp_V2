<?php

namespace App\Repositories;

class DashboardRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function totalIngresos(
        int $usuarioId
    ): float
    {
        $row = $this->db
            ->table('ingresos')
            ->selectSum('monto')
            ->where('usuario_id', $usuarioId)
            ->where('deleted_at', null)
            ->get()
            ->getRow();

        return (float)($row->monto ?? 0);
    }

    public function totalGastos(
        int $usuarioId
    ): float
    {
        $row = $this->db
            ->table('gastos')
            ->selectSum('monto')
            ->where('usuario_id', $usuarioId)
            ->where('deleted_at', null)
            ->get()
            ->getRow();

        return (float)($row->monto ?? 0);
    }

    public function ingresosMes(
        int $usuarioId
    ): float
    {
        return (float)(
            $this->db
                ->table('ingresos')
                ->selectSum('monto')
                ->where('usuario_id', $usuarioId)
                ->where('MONTH(fecha)', date('m'))
                ->where('YEAR(fecha)', date('Y'))
                ->get()
                ->getRow()
                ->monto ?? 0
        );
    }

    public function gastosMes(
        int $usuarioId
    ): float
    {
        return (float)(
            $this->db
                ->table('gastos')
                ->selectSum('monto')
                ->where('usuario_id', $usuarioId)
                ->where('MONTH(fecha)', date('m'))
                ->where('YEAR(fecha)', date('Y'))
                ->get()
                ->getRow()
                ->monto ?? 0
        );
    }

    public function cantidadIngresos(
        int $usuarioId
    ): int
    {
        return $this->db
            ->table('ingresos')
            ->where('usuario_id', $usuarioId)
            ->countAllResults();
    }

    public function cantidadGastos(
        int $usuarioId
    ): int
    {
        return $this->db
            ->table('gastos')
            ->where('usuario_id', $usuarioId)
            ->countAllResults();
    }

    public function presupuestosActivos(
        int $usuarioId
    ): int
    {
        return $this->db
            ->table('presupuestos')
            ->where('usuario_id', $usuarioId)
            ->where('activo', 1)
            ->countAllResults();
    }
    public function ultimosIngresos(
    int $usuarioId,
    int $limit = 5
): array
{
    return $this->db
        ->table('ingresos')
        ->where('usuario_id', $usuarioId)
        ->orderBy('fecha', 'DESC')
        ->limit($limit)
        ->get()
        ->getResultArray();
}

public function ultimosGastos(
    int $usuarioId,
    int $limit = 5
): array
{
    return $this->db
        ->table('gastos')
        ->where('usuario_id', $usuarioId)
        ->orderBy('fecha', 'DESC')
        ->limit($limit)
        ->get()
        ->getResultArray();
}
public function notificaciones(
    int $usuarioId,
    int $limit = 10
): array
{
    return $this->db
        ->table('notificaciones')
        ->where('usuario_id', $usuarioId)
        ->orderBy('id', 'DESC')
        ->limit($limit)
        ->get()
        ->getResultArray();
}
public function presupuestosCriticos(
    int $usuarioId
): array
{
    return $this->db
        ->query("
            SELECT
                p.id,
                p.nombre,
                p.monto_limite,
                IFNULL(
                    SUM(g.monto),
                    0
                ) consumido
            FROM presupuestos p
            LEFT JOIN gastos g
                ON g.presupuesto_id = p.id
            WHERE p.usuario_id = ?
            GROUP BY p.id
        ", [$usuarioId])
        ->getResultArray();
}
public function topCategorias(
    int $usuarioId
): array
{
    return $this->db
        ->query("
            SELECT
                c.nombre,
                SUM(g.monto) total
            FROM gastos g
            INNER JOIN categorias c
                ON c.id = g.categoria_id
            WHERE g.usuario_id = ?
            GROUP BY c.id
            ORDER BY total DESC
            LIMIT 5
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

                SUM(monto) ingresos,

                0 gastos

            FROM ingresos

            WHERE usuario_id = ?

            GROUP BY mes

            UNION ALL

            SELECT

                DATE_FORMAT(
                    fecha,
                    '%Y-%m'
                ) mes,

                0 ingresos,

                SUM(monto) gastos

            FROM gastos

            WHERE usuario_id = ?

            GROUP BY mes

            ORDER BY mes
        ", [
            $usuarioId,
            $usuarioId
        ])
        ->getResultArray();
}
}