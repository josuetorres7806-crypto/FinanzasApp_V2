<?php

namespace App\Services;

use App\Repositories\PresupuestoRepository;
use App\Repositories\GastoRepository;
use CodeIgniter\Events\Events;


class PresupuestoService
{
    protected PresupuestoRepository $repository;

    protected GastoRepository $gastos;

    protected AuditService $audit;

    protected LogService $logs;

    protected NotificationService $notifications;

    public function __construct()
    {
        $this->repository =
            new PresupuestoRepository();

        $this->gastos =
            new GastoRepository();

        $this->audit =
            new AuditService();

        $this->logs =
            new LogService();

        $this->notifications =
            new NotificationService();
    }

    public function crear(
        int $usuarioId,
        array $data
    )
    {
        $data['usuario_id'] =
            $usuarioId;

        $id =
            $this->repository
                ->crear($data);

        $nuevo =
            $this->repository
                ->buscar($id);

        $this->audit->registrar(
            $usuarioId,
            'CREAR',
            'presupuestos',
            $id,
            [],
            $nuevo->toArray()
        );

        $this->logs->registrar(
            $usuarioId,
            'PRESUPUESTO_CREADO',
            'Presupuesto #' . $id
        );

        cache()->delete(
            "dashboard_{$usuarioId}"
        );

        Events::trigger(
            'presupuesto_creado',
            $nuevo
        );

        return $nuevo;
    }

    public function verificarLimites(
        int $presupuestoId
    )
    {
        $presupuesto =
            $this->repository
                ->buscar(
                    $presupuestoId
                );

        if(!$presupuesto)
        {
            return;
        }

        $consumido =
            $this->gastos
                ->totalConsumidoPresupuesto(
                    $presupuestoId
                );

        $porcentaje =
            (
                $consumido
                /
                $presupuesto->monto_limite
            ) * 100;

        if($porcentaje >= 100)
        {
            $this->notifications
                ->crear(
                    $presupuesto->usuario_id,
                    'Presupuesto agotado',
                    'Has superado tu presupuesto.'
                );
        }
        elseif($porcentaje >= 90)
        {
            $this->notifications
                ->crear(
                    $presupuesto->usuario_id,
                    'Presupuesto al 90%',
                    'Tu presupuesto está casi agotado.'
                );
        }
        elseif($porcentaje >= 80)
        {
            $this->notifications
                ->crear(
                    $presupuesto->usuario_id,
                    'Presupuesto al 80%',
                    'Has consumido el 80% del presupuesto.'
                );
        }
        
    }
    public function resumen(
    int $presupuestoId
    ): array
    {
    $presupuesto =
        $this->repository
            ->buscar($presupuestoId);

    if (!$presupuesto)
    {
        throw new \Exception(
            'Presupuesto no encontrado'
        );
    }

    $consumido =
        $this->gastos
            ->totalConsumidoPresupuesto(
                $presupuestoId
            );

    $limite =
        (float)$presupuesto->monto_limite;

    $disponible =
        max(
            0,
            $limite - $consumido
        );

    $porcentaje =
        $limite > 0
            ? round(
                ($consumido / $limite) * 100,
                2
            )
            : 0;

    return [
        'presupuesto_id' => $presupuestoId,
        'limite' => $limite,
        'consumido' => $consumido,
        'disponible' => $disponible,
        'porcentaje' => $porcentaje
    ];
}

}