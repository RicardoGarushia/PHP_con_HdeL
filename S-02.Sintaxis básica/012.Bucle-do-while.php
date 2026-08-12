<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "12. BUCLE `DO-WHILE` EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "12.3. Ejemplos de Uso\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "A) Ejecución con Condición Falsa desde el Inicio\n";
echo "======================================================================\n\n";

$i = 10;

// Aunque $i no es menor que 5, el bloque se ejecuta una vez
do {
    echo "Se ejecuta al menos una vez. Valor de \$i: $i\n";
    $i++;
} while ($i < 5);


echo "\n\n======================================================================\n";
echo "B) Conteo Ascendente Estándar\n";
echo "======================================================================\n\n";

$contador = 1;

do {
    echo "Número: $contador\n";
    $contador++;
} while ($contador <= 5);


echo "\n\n======================================================================\n";
echo "C) Evaluación de Condición Variable\n";
echo "======================================================================\n\n";

$opcion = 0;

do {
    echo "Procesando solicitud (Opción seleccionada: $opcion)...\n";
    $opcion++; // Incremento simulado de opción de salida
} while ($opcion < 3);


echo "\n\n======================================================================\n";
echo "12.4. Control del Bucle: _break_ y _continue_\n";
echo "======================================================================\n\n";

$i = 1;

do {
    if ($i === 3) {
        $i++;
        continue; // Salta la iteración cuando $i es 3
    }

    if ($i === 13) {
        break; // Cancela la ejecución cuando $i llega a 13
    }

    echo "Valor de \$i: $i\n";
    $i++;
} while ($i <= 20);