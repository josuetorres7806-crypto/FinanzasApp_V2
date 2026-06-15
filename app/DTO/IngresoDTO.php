<?php

namespace App\DTO;

class IngresoDTO
{
    public int $usuarioId;

    public int $categoriaId;

    public ?int $metaAhorroId = null;

    public string $descripcion;

    public float $monto;

    public string $fecha;
}