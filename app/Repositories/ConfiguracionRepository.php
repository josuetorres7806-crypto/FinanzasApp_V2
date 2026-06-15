<?php

namespace App\Repositories;

class ConfiguracionRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function listar(): array
    {
        return $this->db
            ->table('configuraciones')
            ->orderBy('clave')
            ->get()
            ->getResultArray();
    }

    public function obtener(
        string $clave
    ): ?array
    {
        return $this->db
            ->table('configuraciones')
            ->where('clave', $clave)
            ->get()
            ->getRowArray();
    }

    public function actualizar(
        string $clave,
        string $valor
    ): bool
    {
        return $this->db
            ->table('configuraciones')
            ->where('clave', $clave)
            ->update([
                'valor' => $valor
            ]);
    }
}