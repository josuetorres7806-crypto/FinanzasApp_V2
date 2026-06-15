<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;

class UsuarioAdminService
{
    protected UsuarioRepository $repository;

    protected AuditService $audit;

    protected LogService $logs;

    public function __construct()
    {
        $this->repository =
            new UsuarioRepository();

        $this->audit =
            new AuditService();

        $this->logs =
            new LogService();
    }

    public function listar(): array
    {
        return $this->repository
            ->listar();
    }

    public function eliminar(
        int $adminId,
        int $usuarioId
    ): bool
    {
        $usuario =
            $this->repository
                ->buscar(
                    $usuarioId
                );

        if (!$usuario)
        {
            throw new \Exception(
                'Usuario no encontrado'
            );
        }

        $this->repository
            ->eliminar(
                $usuarioId
            );

        $this->audit->registrar(
            $adminId,
            'ELIMINAR',
            'usuarios',
            $usuarioId,
            $usuario->toArray(),
            []
        );

        $this->logs->registrar(
            $adminId,
            'USUARIO_ELIMINADO',
            'Usuario #' . $usuarioId
        );

        return true;
    }
    public function activar(
    int $adminId,
    int $usuarioId
): bool
{
    $this->repository
        ->activar($usuarioId);

    $this->logs->registrar(
        $adminId,
        'USUARIO_ACTIVADO',
        "Usuario {$usuarioId}"
    );

    return true;
}
public function desactivar(
    int $adminId,
    int $usuarioId
): bool
{
    $this->repository
        ->desactivar(
            $usuarioId
        );

    $this->logs->registrar(
        $adminId,
        'USUARIO_DESACTIVADO',
        "Usuario {$usuarioId}"
    );

    return true;
}
public function bloquear(
    int $adminId,
    int $usuarioId
): bool
{
    $this->repository
        ->bloquear(
            $usuarioId
        );

    $this->logs->registrar(
        $adminId,
        'USUARIO_BLOQUEADO',
        "Usuario {$usuarioId}"
    );

    return true;
}
public function desbloquear(
    int $adminId,
    int $usuarioId
): bool
{
    $this->repository
        ->desbloquear(
            $usuarioId
        );

    $this->logs->registrar(
        $adminId,
        'USUARIO_DESBLOQUEADO',
        "Usuario {$usuarioId}"
    );

    return true;
}
public function resetPassword(
    int $adminId,
    int $usuarioId,
    string $password
): bool
{
    $this->repository
        ->actualizar(
            $usuarioId,
            [
                'password' =>
                    password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    )
            ]
        );

    $this->audit->registrar(
        $adminId,
        'RESET_PASSWORD',
        'usuarios',
        $usuarioId,
        [],
        []
    );

    return true;
}
}