<?php

namespace App\Repositories;

class EstadisticaRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function ingresosMensuales(
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

                    SUM(monto) total

                FROM ingresos

                WHERE usuario_id = ?

                GROUP BY mes

                ORDER BY mes
            ", [$usuarioId])
            ->getResultArray();
    }

    public function gastosMensuales(
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

                    SUM(monto) total

                FROM gastos

                WHERE usuario_id = ?

                GROUP BY mes

                ORDER BY mes
            ", [$usuarioId])
            ->getResultArray();
    }

    public function totalIngresos(
        int $usuarioId
    ): float
    {
        $row = $this->db
            ->table('ingresos')
            ->selectSum('monto')
            ->where('usuario_id', $usuarioId)
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
            ->get()
            ->getRow();

        return (float)($row->monto ?? 0);
    }
}