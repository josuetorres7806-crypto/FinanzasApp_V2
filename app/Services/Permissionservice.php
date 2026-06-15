<?php

namespace App\Services;

class PermissionService
{
    protected $db;

    public function __construct()
    {
        $this->db =
            db_connect();
    }

    public function tienePermiso(
        int $usuarioId,
        string $permiso
    ): bool
    {
        $row =
            $this->db
                ->query(
                    "
                    SELECT p.id

                    FROM permisos p

                    INNER JOIN rol_permisos rp
                        ON rp.permiso_id = p.id

                    INNER JOIN usuario_roles ur
                        ON ur.rol_id = rp.rol_id

                    WHERE ur.usuario_id = ?
                    AND p.nombre = ?

                    LIMIT 1
                    ",
                    [
                        $usuarioId,
                        $permiso
                    ]
                )
                ->getRow();

        return $row !== null;
    }
}