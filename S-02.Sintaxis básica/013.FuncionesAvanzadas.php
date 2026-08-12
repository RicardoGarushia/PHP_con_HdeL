<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "13.5. TIPOS DE FUNCIONES AVANZADAS EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "13.5.1. Funciones Recursivas\n";
echo "======================================================================\n\n";

function factorial(int $n): int {
    if ($n <= 1) {
        return 1; // Caso base
    }
    return $n * factorial($n - 1);  // Llamada recursiva
}

echo "El factorial de 5 es: " . factorial(5) . "\n";


echo "\n\n======================================================================\n";
echo "13.5.2. Funciones Anidadas\n";
echo "======================================================================\n\n";

function multiplicar(float $a, float $b): float {
    return $a * $b;
}

function calcularArea(float $base, float $altura): float {
    return multiplicar($base, $altura); // Función multiplicar() anidada
}

echo "El área (5x10) es: " . calcularArea(5, 10) . "\n";


echo "\n\n======================================================================\n";
echo "13.5.3. Funciones Anónimas y Recursividad\n";
echo "======================================================================\n\n";

// Función Anónima Estándar
$suma = function(int $a, int $b): int {
    return $a + $b;
};
echo "Resultado suma anónima (5+10): " . $suma(5, 10) . "\n";

// Función Anónima Recursiva
$factorialAnonimo = function(int $n) use (&$factorialAnonimo): int {
    if ($n <= 1) {
        return 1;
    }
    return $n * $factorialAnonimo($n - 1);
};
echo "Factorial anónimo de 5: " . $factorialAnonimo(5) . "\n";


echo "\n\n======================================================================\n";
echo "13.5.4. Funciones Flecha (Arrow Functions - PHP 7.4+)\n";
echo "======================================================================\n\n";

$duplicar = fn(int $n): int => $n * 2;
echo "El doble de 8 es: " . $duplicar(8) . "\n";


echo "\n\n======================================================================\n";
echo "Actividad Avanzada\n";
echo "======================================================================\n\n";

echo "\n======================================================================\n";
echo "Crea una Función Flecha que calcule el precio final con IVA (16%).\n";
echo "======================================================================\n\n";

$precioProducto = 100; 

// Tu solución aquí:
$IVA = fn(float $precio): float => ($precio * 0.16) + $precio;

// echo "El precio más IVA de un producto de $precioProducto es: " . $IVA($precioProducto) . "\n\n";   // Code smell por dificultar legibilidad
$precioConIVA = $IVA($precioProducto);
echo "El precio más IVA de un producto de $precioProducto es: " . $precioConIVA . "\n\n";   // Code smell por dificultad legibilidad


$descuento20PorCiento = fn(float $precio): float => $precio - ($precio * 0.20);

// echo "El precio final de un producto con descuento del 20% más IVA de $precioProducto es: " . $IVA($descuento20PorCiento($precioProducto)) . "\n\n";    // Code smell de dificultar legibilidad
echo "Precio neto: $precioProducto" . "\n";
$precioConDescuentoAntesIVA = $descuento20PorCiento($precioProducto);
echo "Precio con 20% de descuento: $precioConDescuentoAntesIVA" . "\n";
$precioConIVA = $IVA($precioConDescuentoAntesIVA);
echo "Precio final con IVA: $precioConIVA";

