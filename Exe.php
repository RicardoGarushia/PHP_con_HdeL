<?php

// Habilitar el manejo de ticks
declare(ticks=1);

// Esta función es llamada en cada tick event
function tick_handler()
{
    echo "\nFunción tick_handler() invocada\n";
}

register_tick_function("tick_handler"); // Causa un tick event

$a = 1; // Causa un tick event

if ($a > 0) {
    $a += 2; // Causa un tick event
    echo "El resultado de la suma es: $a\n"; // Causa un tick event
}

?>