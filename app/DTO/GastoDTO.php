<?php

namespace App\DTO;

class GastoDTO
{
    public int $usuarioId;

    public int $categoriaId;

    public ?int $presupuestoId = null;

    public string $descripcion;

    public float $monto;

    public string $fecha;
}