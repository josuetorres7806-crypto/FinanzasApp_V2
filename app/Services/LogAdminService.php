<?php

namespace App\Services;

use App\Repositories\LogRepository;

class LogAdminService
{
    protected LogRepository $repository;

    public function __construct()
    {
        $this->repository =
            new LogRepository();
    }

    public function listar(
        array $filtros,
        int $page,
        int $limit
    ): array
    {
        return [

            'items' =>
                $this->repository
                    ->listar(
                        $filtros,
                        $page,
                        $limit
                    ),

            'total' =>
                $this->repository
                    ->total(
                        $filtros
                    ),

            'page' =>
                $page,

            'limit' =>
                $limit
        ];
    }

    public function dashboard(): array
    {
        return [

            'top_eventos' =>
                $this->repository
                    ->topEventos(),

            'actividad_diaria' =>
                $this->repository
                    ->actividadDiaria()
        ];
    }
}