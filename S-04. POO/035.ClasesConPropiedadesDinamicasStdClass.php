<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "35. POO: Clases con Propiedades Dinámicas (stdClass)\n";
echo "======================================================================\n\n";

// --- 35.1 CREACIÓN DE OBJETOS stdClass ---

// Forma 1: Instanciación directa
$usuario = new stdClass();
$usuario->nombre = "Ricardo";
$usuario->edad = 34;
$usuario->activo = true;

echo "--- 1. Instanciación directa ---\n";
echo "Usuario: {$usuario->nombre}, {$usuario->edad} años. Activo: " . ($usuario->activo ? 'Sí' : 'No') . "\n";
echo "Tipo de \$usuario: " . gettype($usuario) . "\n\n";

// Forma 2: Casting de Array Asociativo a Objeto (object)
$arraySoftware = [
    'nombreSoftware' => 'Gemini',
    'tipo'           => 'AI',
    'version'        => 2.5
];

$objetoSoftware = (object) $arraySoftware;

echo "--- 2. Casting de Array Asociativo a Object ---\n";
echo "Software: {$objetoSoftware->nombreSoftware} ({$objetoSoftware->tipo}) v{$objetoSoftware->version}\n";
echo "Tipo de \$objetoSoftware: " . gettype($objetoSoftware) . "\n\n";

// Forma 2.1: Casting de Array Numérico (Claves numéricas)
$numeros = [66, 21, 25];
$objetoNumerico = (object) $numeros;

echo "--- 2.1. Casting de Array Numérico ---\n";
echo "Acceso a propiedad numérica {0}: {$objetoNumerico->{0}}\n";
echo "Acceso a propiedad numérica {1}: {$objetoNumerico->{1}}\n\n";

// Forma 3: Decodificación de JSON (json_decode)
$json = '{"nombre": "Ricardo", "edad": 34, "aplicativos": ["VS Code", "Gemini", "OBS"]}';

// Como Array (segundo parámetro = true)
$arrayJSON = json_decode($json, true);

// Como Objeto stdClass (segundo parámetro = false / omitido)
$objetoJSON = json_decode($json, false);

echo "--- 3. JSON Decodificado ---\n";
echo "Acceso por Array: " . $arrayJSON['nombre'] . " usa " . implode(", ", $arrayJSON['aplicativos']) . "\n";
echo "Acceso por Objeto stdClass: " . $objetoJSON->nombre . " usa " . implode(", ", $objetoJSON->aplicativos) . "\n\n";

// --- 35.2 DEMOSTRACIÓN DE RIESGOS EN stdClass ---

echo "--- 4. Riesgo de Errores Tipográficos (Sin Error de PHP) ---\n";
// Si escribimos mal un atributo, PHP NO lanza un error, simplemente crea una nueva propiedad
$usuario->usaurio = "ErrorTypo"; // Typo involuntario

echo "Propiedad correcta 'nombre': {$usuario->nombre}\n";
echo "Propiedad indeseada 'usaurio': {$usuario->usaurio}\n";

// ACTIVIDADES: Intenta acceder a una propiedad inexistente en un objeto stdClass y observa la advertencia emitida por PHP.
echo "Propiedad no declarada 'QWERTY': {$usuario->QWERTY}\n";