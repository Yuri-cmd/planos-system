<?php

use App\Models\Estado;

if (!function_exists('color')) {
    function color($estadoId)
    {
        $background = "";

        // Obtener el color del estado desde la base de datos
        $color = Estado::getColorById($estadoId);
        // Establecer el estilo de fondo basado en el color obtenido
        $background = "background-color: $color;";

        return $background;
    }
}
