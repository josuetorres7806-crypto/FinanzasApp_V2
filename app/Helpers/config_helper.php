<?php

if (!function_exists('config_value'))
{
    function config_value(
        string $clave,
        $default = null
    )
    {
        $db = db_connect();

        $row = $db
            ->table('configuraciones')
            ->where('clave', $clave)
            ->get()
            ->getRow();

        return $row->valor ?? $default;
    }
}