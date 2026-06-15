<?php

namespace App\Repositories;

class AdminDashboardRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function totalUsuarios(): int
    {
        return $this->db
            ->table('usuarios')
            ->countAllResults();
    }

    public function usuariosActivos(): int
    {
        return $this->db
            ->table('usuarios')
            ->where('activo', 1)
            ->countAllResults();
    }

    public function usuariosBloqueados(): int
    {
        return $this->db
            ->table('usuarios')
            ->where('activo', 0)
            ->countAllResults();
    }

    public function totalIngresos(): float
    {
        $row = $this->db
            ->table('ingresos')
            ->selectSum('monto')
            ->get()
            ->getRow();

        return (float)($row->monto ?? 0);
    }

    public function totalGastos(): float
    {
        $row = $this->db
            ->table('gastos')
            ->selectSum('monto')
            ->get()
            ->getRow();

        return (float)($row->monto ?? 0);
    }

    public function totalPresupuestos(): int
    {
        return $this->db
            ->table('presupuestos')
            ->countAllResults();
    }

    public function totalLogs(): int
    {
        return $this->db
            ->table('logs')
            ->countAllResults();
    }

    public function totalAuditoria(): int
    {
        return $this->db
            ->table('auditoria')
            ->countAllResults();
    }

    public function ultimosUsuarios(): array
    {
        return $this->db
            ->table('usuarios')
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();
    }

    public function actividadReciente(): array
    {
        return $this->db
            ->table('logs')
            ->orderBy('id', 'DESC')
            ->limit(20)
            ->get()
            ->getResultArray();
    }
}