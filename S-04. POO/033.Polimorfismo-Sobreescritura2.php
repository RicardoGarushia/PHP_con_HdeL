<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "33. POO: Polimorfismo y Sobreescritura de Métodos\n";
echo "======================================================================\n\n";

// --- CLASE PADRE (SUPERCLASE) ---
abstract class DescuentoClasePopular
{
    // Propiedad protegida accesible por las clases hijas
    public static $DESCUENTO_CLASE_POPULAR = 0.05;

    public function calcularDescuentoClasePopular(float $total): float
    {
        return $total * $this->DESCUENTO_CLASE_POPULAR; // 5% de descuento
    }

}

// --- SUBCLASES ---

// Subclase #1: Hereda el comportamiento sin sobreescribir
class personaPobre extends DescuentoClasePopular
{
    // Reutiliza directamente el método calcularDescuentoClasePopular de la clase padre
}

// Subclase #2: Sobreescribe el comportamiento de la clase padre
class personaAdultaMayor extends DescuentoClasePopular
{
    /**
     * Sobreescritura del método calcularDescuentoClasePopular de la clase superclase.
     * Mantiene la misma firma (nombre, parámetros y tipo de retorno),
     * pero redefine el algoritmo según la naturaleza de la persona adulta mayor.
     */
    public function calcularDescuentoClasePopular(float $total): float
    {
        return $total * $this->DESCUENTO_CLASE_POPULAR * 2; // 10% de descuento
    }
}

// Subclase #2: Sobreescribe el comportamiento de la clase padre
class personaDiscapacitada extends DescuentoClasePopular
{
    /**
     * Sobreescritura del método calcularDescuentoINAPAM de la clase superclase.
     * Mantiene la misma firma (nombre, parámetros y tipo de retorno),
     * pero redefine el algoritmo según la naturaleza del descuento.
     */
    public function calcularDescuentoClasePopular(float $total): float
    {
        return $total * $this->DESCUENTO_CLASE_POPULAR * 1.5; // 7.5% de descuento
    }
}

// Subclase #3: Sobreescribe el comportamiento de la clase padre
class personaAdultaMayorDiscapacitada extends personaAdultaMayor
{
    /**
     * Sobreescritura del método calcularDescuentoINAPAM de la clase superclase.
     * Mantiene la misma firma (nombre, parámetros y tipo de retorno),
     * pero redefine el algoritmo según la naturaleza del descuento.
     */
    public function calcularDescuentoClasePopular(float $total): float
    {
        return $total * $this->DESCUENTO_CLASE_POPULAR * 1.5 * 2; // 15% de descuento
    }
}

// --- EJECUCIÓN Y DEMOSTRACIÓN POLIMÓRFICA ---

$personaPobre = new personaPobre();
$personaAdultaMayor = new personaAdultaMayor();
$personaDiscapacitada = new personaDiscapacitada();
$personaAdultaMayorDiscapacitada = new personaAdultaMayorDiscapacitada();

echo "Descuento de la persona pobre: " . $personaPobre->calcularDescuentoClasePopular(100) . "\n";
echo "Descuento de la persona adulta mayor: " . $personaAdultaMayor->calcularDescuentoClasePopular(100) . "\n";
echo "Descuento de la persona discapacitada: " . $personaDiscapacitada->calcularDescuentoClasePopular(100) . "\n";
echo "Descuento de la persona adulta mayor discapacitada: " . $personaAdultaMayorDiscapacitada->calcularDescuentoClasePopular(100) . "\n";