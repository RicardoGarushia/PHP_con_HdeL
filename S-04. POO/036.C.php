<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "36. POO: Conversión de Objetos a Arrays y Efecto de Visibilidad\n";
echo "======================================================================\n\n";

// Definición de una clase personalizada con distintos niveles de visibilidad
class Producto
{
    public string $nombre = "Monitor Gamer 27\"";
    protected float $precio = 8500.50;
    private int $stock = 12;

    public function mostrarProducto(): string
    {
        return "{$this->nombre} - \${$this->precio} (Stock: {$this->stock})";
    }
}

// Instanciación del objeto
$monitor = new Producto();

echo "--- 36.1 Tipo de Dato Original ---\n";
echo "Tipo de \$monitor: " . gettype($monitor) . "\n";
echo "Clase: " . get_class($monitor) . "\n\n";

// --- 1. CONVERSIÓN MEDIANTE CASTING (array) ---
echo "--- 36.2 Casting Directo (array) ---\n";
$arrayCasting = (array) $monitor;

echo "Tipo resultante: " . gettype($arrayCasting) . "\n";
echo "Contenido del array resultante (print_r):\n";
print_r($arrayCasting);

echo "\n--- Inspección de Claves (var_dump) ---\n";
var_dump($arrayCasting);

// --- 2. OTRAS ALTERNATIVAS DE CONVERSIÓN ---

// Alternativa A: get_object_vars() (Solo propiedades públicas desde contexto externo)
echo "\n--- 36.3 Uso de get_object_vars() ---\n";
$arrayVars = get_object_vars($monitor);
print_r($arrayVars);

// Alternativa B: json_encode() + json_decode()
echo "\n--- 36.4 Conversión Vía JSON (json_encode / json_decode) ---\n";
$jsonString = json_encode($monitor);
$arrayJson = json_decode($jsonString, true);
print_r($arrayJson);

// --- 36.5 DEMOSTRACIÓN DE PÉRDIDA DE MÉTODOS ---
echo "\n--- 36.5 Omisión de Métodos ---\n";
echo "¿Existe 'mostrarProducto' como clave en el array?: " . (array_key_exists('mostrarProducto', $arrayCasting) ? 'Sí' : 'No') . "\n";