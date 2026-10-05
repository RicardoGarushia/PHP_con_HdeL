<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "37. POO y Web: Fundamentos de JSON (JavaScript Object Notation)\n";
echo "======================================================================\n\n";

echo "JSON es un formato ligero e independiente de lenguaje utilizado para\n";
echo "intercambiar datos entre cliente (ej. navegador) y servidor (PHP).\n\n";

// --- 37.1 SINTAXIS BÁSICA Y ESTRUCTURA ---
echo "--- 37.1 Sintaxis de un Objeto JSON Valido ---\n";

$jsonObjetoEjemplo = '{
    "nombre": "Ricardo",
    "edad": 34,
    "id": 307036087,
    "estudianteActivo": true,
    "direccion": {
        "calle": "Av. Siempre Viva 123",
        "ciudad": "Springfield",
        "codigoPostal": "12345"
    },
    "hobbies": ["frontón", "lectura", "videojuegos"]
}';

echo $jsonObjetoEjemplo . "\n\n";

// --- 37.2 ARRAYS DE OBJETOS JSON ---
echo "--- 37.2 Estructura de un Array de Objetos JSON ---\n";

$jsonArrayEjemplo = '[
    {
        "nombre": "Ricardo",
        "edad": 34,
        "estudianteActivo": true,
        "hobbies": ["frontón", "lectura"]
    },
    {
        "nombre": "José",
        "edad": 64,
        "estudianteActivo": false,
        "hobbies": ["lectura"]
    }
]';

echo $jsonArrayEjemplo . "\n\n";

// --- 37.3 ACTIVIDAD PRÁCTICA: VALIDACIÓN DE SINTAXIS JSON (PHP 8.3+) ---
echo "--- 37.3 Actividad: Comprobación de Sintaxis JSON ---\n";

// Un JSON inválido por regla de sintaxis (comillas simples y coma final "trailing comma")
$jsonInvalido = "{
    'nombre': 'Ricardo',
    'edad': 34,
}";

// Función de validación compatible con cualquier versión de PHP
$validarJson = function (string $json): bool {
    if (function_exists('json_validate')) {
        return json_validate($json);
    }
    json_decode($json);
    return json_last_error() === JSON_ERROR_NONE;
};

echo "¿Es válido \$jsonObjetoEjemplo?: " . ($validarJson($jsonObjetoEjemplo) ? "SÍ (Sintaxis correcta)" : "NO") . "\n";
echo "¿Es válido \$jsonInvalido?: " . ($validarJson($jsonInvalido) ? "SÍ" : "NO (Error: Comillas simples o coma final no permitidas)") . "\n\n";

// --- 37.4 AVANCE DEL SIGUIENTE MÓDULO ---
echo "--- 37.4 Funciones a profundizar en Módulo 38 ---\n";
echo "a) json_encode(): Convierte estructuras de PHP (arrays/objetos) a string JSON.\n";
echo "b) json_decode(): Convierte un string JSON a estructuras nativas de PHP.\n";

