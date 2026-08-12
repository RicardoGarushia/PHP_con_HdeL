<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "11. BUCLE `WHILE` EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "11.2. Ejemplos de Uso\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "A) Contador Ascendente Estándar\n";
echo "======================================================================\n\n";

$i = 1;

// Imprime números del 1 al 5
while ($i <= 5) {
    echo "Iteración número: $i\n";
    $i++; // Incremento obligatorio para evitar bucle infinito
}


echo "\n\n======================================================================\n";
echo "B) Conteo Descendente\n";
echo "======================================================================\n\n";

$contador = 5;

// Cuenta regresiva del 5 al 1
while ($contador >= 1) {
    echo "Cuenta regresiva: $contador\n";
    $contador--;
}


echo "\n\n======================================================================\n";
echo "C) Evaluación de Condición Variable\n";
echo "======================================================================\n\n";

$continuar = true;
$intentos = 1;

while ($continuar) {
    echo "Intento número: $intentos\n";

    // Primero se realiza la evaluación de la variable
    if ($intentos === 13) {
        $continuar = false; // Modifica la condición para detener el bucle
    }

    // Después se hace incremento de la variable
    $intentos++;
}


echo "\n\n======================================================================\n";
echo "11.3. Control del Bucle: _break_ y _continue_\n";
echo "======================================================================\n\n";

$i = 0;

while ($i < 20) {
    $i++;

    if ($i === 3) {
        continue; // Salta la iteración cuando $i es 3
    }

    if ($i === 13) {
        break; // Detiene el bucle por completo al llegar a 13
    }

    echo "Valor de \$i: $i\n";
}


echo "\n\n======================================================================\n";
echo "Actividades\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Crea un bucle while que imprima los múltiplos de 5 hasta llegar a 50 (5, 10, 15, ...).\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Actividad AVANZADA:\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Simula el intento de autenticación de un usuario con un máximo de 3 intentos permitidos utilizando un bucle `while`\n";
echo "======================================================================\n\n";

/* 
$intentosAutenticacion = 1;
$maxIntentosAutenticacion = 3;
$passwordIngresado = "secret123";
$passwordRegistrado = "secreto2026"; // Cambia este valor para probar

while ($intentosAutenticacion <= $maxIntentosAutenticacion) {
    // Código aquí
}
*/
