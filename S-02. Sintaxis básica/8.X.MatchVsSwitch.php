<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "8.X. EXPRESIÓN `MATCH` EN PHP (PHP 8.0+)\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "8.X.3. Ejemplo Práctico: Evaluación Estricta de Tipo de Dato\n";
echo "======================================================================\n\n";

// La expresión match mediante la comparación estricta (===) también evalúa de forma estricta el Tipo de Dato de la variable. 
$opcion = 1; // Modifica este valor a tipo int o string para ver el funcionamiento

$mensaje = match ($opcion) {
    "1"     => "Para la expresión match esto es un string \"1\" \n", // No coincidirá
    1       => "Para la expresión match esto es un entero 1 \n",   // Coincidencia exacta
    default => "Opción no válida \n",
};

echo $mensaje . "\n\n"; // Imprime el mensaje dependiendo del tipo de dato

// Un error común en la estructura de control switch es que la cadena "1" equivale al entero 1 debido a la comparación débil (==).
switch ($opcion) {
    case "1":
        $mensaje = "Para la estructura switch esto es un string \"1\" \n";
        break;
    case 1:
        $mensaje = "Para la estructura switch esto es un entero 1 \n";
        break;
    default:
        $mensaje = "Opción no válida\n";
        break;
}

echo $mensaje . "\n\n"; // Imprime el mensaje del primer valor aunque sea entero por la comparación débil (==)


echo "\n======================================================================\n";
echo "8.X.4. Ejemplo Práctico: Agrupamiento de Casos (Case Stacking)\n";
echo "======================================================================\n\n";

$mes = 7;   // 1 == enero, 2 == febrero, 3 == marzo, y así sucesivamente.

// Asignación directa del resultado de match a una variable
$estacion = match ($mes) {
    12, 1, 2  => "Invierno",
    3, 4, 5   => "Primavera",
    6, 7, 8   => "Verano",
    9, 10, 11 => "Otoño",
    default   => "Mes no válido",
};

echo "Evaluando el mes número $mes:\n";
echo "Estación detectada: $estacion\n\n";

echo "\n======================================================================\n";
echo "Actividades\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Tu propia expresión MATCH (Ejemplo libre)\n";
echo "======================================================================\n\n";

