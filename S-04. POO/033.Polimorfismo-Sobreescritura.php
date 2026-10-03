<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "33. POO: Polimorfismo y Sobreescritura de Métodos\n";
echo "======================================================================\n\n";

// --- CLASE PADRE (SUPERCLASE) ---
abstract class AreaFormaGeometrica
{
    // Propiedad protegida accesible por las clases hijas
    protected float $area;

    // Método base que calcula el área estándar de una superficie rectangular
    public function calcularArea(float $base, float $altura): float
    {
        return ($base * $altura);
    }
}

// --- SUBCLASES ---

// Subclase #1: Hereda el comportamiento sin sobreescribir
class Rectangulo extends AreaFormaGeometrica
{
    // Reutiliza directamente el método calcularArea de la clase padre
}

// Subclase #2: Sobreescribe el comportamiento de la clase padre
class Triangulo extends AreaFormaGeometrica
{
    /**
     * Sobreescritura del método calcularArea de la clase superclase.
     * Mantiene la misma firma (nombre, parámetros y tipo de retorno),
     * pero redefine el algoritmo según la naturaleza del triángulo.
     */
    public function calcularArea(float $base, float $altura): float
    {
        return ($base * $altura) / 2;
    }
}

// --- EJECUCIÓN Y DEMOSTRACIÓN POLIMÓRFICA ---

$rectangulo = new Rectangulo();
$triangulo  = new Triangulo();

echo "Área del Rectángulo (Método de Clase Padre): " . $rectangulo->calcularArea(5, 10) . "\n";
echo "Área del Triángulo (Método Sobreescrito):    " . $triangulo->calcularArea(5, 10) . "\n";