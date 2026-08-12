<?php
do {
    // Limpia la pantalla
    if (PHP_OS_FAMILY === 'Windows') {
        echo "\033[2J\033[1;1H";    // ¿Qué es lo que hace esta línea?
    } else {
        system('clear');
    }

    echo "=====MENÚ PRINCIPAL=====\n";
    echo "1. DEPOSITAR a cuentas Banco Patito\n";
    echo "2. PAGAR servicios, tarjetas de crédito y más\n";
    echo "3. RETIRAR efectivo y operaciones con tarjeta\n";
    echo "4. RECARGAS y paquetes a cualquier compañía\n";
    echo "5. SALIR\n\n";

    // 1. Leer la opción del usuario
    $opcionIngresada = readline("Ingresa el número de la operación que quieras realizar: ");

    switch($opcionIngresada){
        case 1:
            echo "\n\nSeleccionó 1. Debe pagar primero porque ya nos debe mucho.\n\n";
            break;
        case 2:
            echo "\n\nSeleccionó 2. ¿Quiere pagar y no trae dinero? ¡Mta!\n\n";
            break;
        case 3:
            echo "\n\nSeleccionó 3. ¿¡Qué dinero va a retirar si no tiene en su cuenta!?\n\n";
            break;
        case 4:
            echo "\n\nSeleccionó 4. ¡Servicio cancelado hasta que nos pague!\n\n";
            break;
        case 5:
            echo "\n\n¡Nos vemos!\n\n";
            break;
        default:
            echo "\n\nOpción no válida. Intenta nuevamente\n\n";
            break;
    }

    // 3. LA CLAVE: Pausa el programa hasta que presione Enter (si no es la opción de salir)
    if ($opcionIngresada != 5) {
        readline("\nPresiona Enter para continuar...");
    }

} while ($opcionIngresada != 5);
