<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "38. POO y Web: Codificación y Decodificación de JSON\n";
echo "======================================================================\n\n";

// --- 38.1 CODIFICACIÓN CON json_encode() ---
echo "--- 38.1 Codificación (PHP -> JSON) ---\n";

$datosUsuario = [
    "id" => 101,
    "nombre" => "Ricardo García",
    "email" => "ricardo@example.com",
    "roles" => ["Admin", "Developer"],
    "activo" => true,
    "puntuacion" => 98.5
];

// Codificación básica
$jsonSimple = json_encode($datosUsuario);
echo "JSON en una sola línea:\n$jsonSimple\n\n";

// Codificación con Flags (JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
$jsonFormateado = json_encode($datosUsuario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo "JSON Formateado (Pretty Print + Unicode sin escapar):\n$jsonFormateado\n\n";

// --- 38.2 DECODIFICACIÓN CON json_decode() ---
echo "--- 38.2 Decodificación (JSON -> PHP) ---\n";

$jsonEntrante = '{
    "producto": "Monitor Gamer 27\"",
    "precio": 8500.50,
    "disponible": true,
    "especificaciones": {
        "resolucion": "4K",
        "tasaRefresco": "144Hz"
    }
}';

// Opción A: Decodificación por defecto (retorna objeto stdClass)
$objetoStd = json_decode($jsonEntrante, false);
echo "1. Acceso a objeto stdClass:\n";
echo "Producto: " . $objetoStd->producto . "\n";
echo "Resolución: " . $objetoStd->especificaciones->resolucion . "\n\n";

// Opción B: Decodificación asociativa (retorna array)
$arrayAsociativo = json_decode($jsonEntrante, true);
echo "2. Acceso a Array Asociativo:\n";
echo "Producto: " . $arrayAsociativo['producto'] . "\n";
echo "Tasa de Refresco: " . $arrayAsociativo['especificaciones']['tasaRefresco'] . "\n\n";

// --- 38.3 MANEJO DE ERRORES CON JSON_THROW_ON_ERROR ---
echo "--- 38.3 Manejo Estricto de Errores con Excepciones ---\n";

$jsonCorrupto = '{"nombre": "Ricardo", "edad": 34,}'; // Coma sobrante inválida

try {
    $resultado = json_decode($jsonCorrupto, true, 512, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
    echo "Excepción capturada con éxito:\n";
    echo "Mensaje: " . $e->getMessage() . "\n";
    echo "Código de error: " . $e->getCode() . "\n\n";
}

// --- 38.4 COMPORTAMIENTO CON CLASES Y VISIBILIDAD ---
echo "--- 38.4 Serialización de Clases Personalizadas ---\n";

class CuentaUsuario
{
    public string $usuario = "rgarcia";
    protected string $email = "privado@domain.com";
    private string $passwordHash = '$2y$10$abcdef...';
}

$cuenta = new CuentaUsuario();
echo "Resultado de json_encode() en una clase personalizada (Solo propiedades públicas):\n";
echo json_encode($cuenta, JSON_PRETTY_PRINT) . "\n";