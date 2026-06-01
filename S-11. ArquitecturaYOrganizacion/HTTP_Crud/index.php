<?php
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.

// Esto es para activar o desactivar el modo de depuración. 
// En modo de depuración (true), se mostrarán mensajes de error detallados, 
// mientras que en modo de producción (false), se mostrarán mensajes de error genéricos para evitar exponer información sensible. 
define('DEBUG_MODE', true); 

// header("Content-Type: text/plain");
header("Content-Type: application/json");

$metodo = $_SERVER['REQUEST_METHOD'];

// Esto es para cargar automáticamente todas las funciones y clases que hemos definido en otros archivos, como las funciones de lógica para cada método HTTP y la función de responderError().
require_once __DIR__ . "/validators/autoload.php"; 

// use Exception;   // Recuerda, puedes usar "use" para importar cualquier clase "use Exception"...
use Throwable;      // ...o utilizar su nombre completo "\Exception", "\Throwable", etc., cada vez que quieras usarla

// 1. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
try {
    match ($metodo) {
        'GET' => ejecutarLogicaGet(),
        'POST' => ejecutarLogicaPost(),
        'PUT' => ejecutarLogicaPut(),
        'DELETE' => ejecutarLogicaDelete(),
        default => lanzarError405()
    };
}
// Usamos "Exception" para atrapar errores que hayamos lanzado explícitamente con "throw new Exception()"
catch (\Exception $e) {
    responderError(500, $e->getMessage());
}
// Usamos "Throwable" para atrapar ABSOLUTAMENTE CUALQUIER error (fatal, advertencia, etc.)
catch (Throwable $t) {
    responderError(500, $t->getMessage());
}