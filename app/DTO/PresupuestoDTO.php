<?php

namespace App\DTO;

class PresupuestoDTO
{
    public int $usuarioId;

    public ?int $categoriaId = null;

    public string $nombre;

    public float $monto;

    public string $fechaInicio;

    public string $fechaFin;
}