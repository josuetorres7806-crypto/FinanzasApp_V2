<?php

namespace App\Services;

use App\Repositories\AuditoriaRepository;

class AuditoriaService
{
    protected AuditoriaRepository $repository;

    public function __construct()
    {
        $this->repository =
            new AuditoriaRepository();
    }

    public function listar(
        array $filtros = [],
        int $page = 1,
        int $limit = 20
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

    public function detalle(
        int $id
    ): ?array
    {
        return $this->repository
            ->buscar($id);
    }
}