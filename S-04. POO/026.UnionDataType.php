<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "26. Tipos de Dato Unión (`Union Types`)\n";
echo "======================================================================\n\n";

// --- EJECUCIÓN DEL CÓDIGO REAL ---

class CalculadoraImpuestoIVA {
    // Propiedad que acepta entero o flotante
    private int|float $monto;

    // El parámetro puede ser int o float, y el retorno puede ser int, float o string
    public function procesarMonto(int|float $monto): int|float|string {
        $this->monto = $monto;

        if ($this->monto <= 0) {
            return "El monto debe ser mayor a cero.";
        }

        return $this->monto * 1.16; // Retorna el monto con IVA
    }
}

$calc = new CalculadoraImpuestoIVA();

// Sólo algunos llamados son válidos con strict_types=1
echo $calc->procesarMonto(100) . "\n\n";    // Acepta int
echo $calc->procesarMonto(100.00) . "\n\n"; // Acepta float
echo $calc->procesarMonto(-100) . "\n\n";   // Acepta float, pero es menor a 0
// echo $calc->procesarMonto("50.50");      // NO ACEPTA string. (Des-)Comenta esta línea para observar el funcionamiento del código. 