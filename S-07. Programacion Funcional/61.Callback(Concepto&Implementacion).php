<?php
header("Content-Type: text/plain");

echo "61. CALLBACK: COMO CONCEPTO DE PF Y COMO IMPLEMENTACIÓN DE PHP\n\n";

echo"En PHP, el término 'Callback' tiene una doble acepción que, si bien se relaciona, apunta a: 
a) El concepto teórico 'callback': La función pasada como argumento, o un argumento que es una función.
b) La implementación del 'callback': En PHP el pseudotipo 'callable'.\n\n\n\n";



echo "61.1 EL CONCEPTO TEÓRICO 'CALLBACK': LA FUNCIÓN PASADA COMO ARGUMENTO\n\n";

echo "Este es el significado de Programación Funcional (PF): 
la función pasiva (el código) que está esperando a ser 'devuelta' o ejecutada por la función activa 
(una función de orden superior, como array_map()).\n\n";

echo "Entonces, un 'callback' está conformado por: 
a) Una función de Orden Superior: Llama al callback. (Por ejemplo: array_map()).
b) Callback: Es la función que define la lógica de la acción a realizar. (Por ejemplo: una función que duplica un valor en el arreglo).\n\n\n\n";



echo "61.2 LA IMPLEMENTACIÓN DEL 'CALLBACK': EL PSEUDOTIPO 'CALLABLE'\n\n";

echo "'Callable' es el pseudotipo de PHP que se usa en las firmas de funciones para indicar que un argumento debe ser una función que pueda ser llamada (invocada).\n\n";

echo "Un valor es callable si puede ser ejecutado, lo que incluye:
a) Una función anónima (un objeto de la clase Closure).
b) Una función nombrada (referenciada por su nombre como un string).
c) Un método estático de una clase (referenciado como un array ['Clase', 'metodo']).
d) Un método de instancia (referenciado como un array [\$objeto, 'metodo']).\n\n\n\n";



echo "61.3 ¿QUÉ RELACIÓN TIENE 'CALLBACK' CON LA PF?\n\n";

echo "La existencia y uso de 'Callbacks' es la manifestación directa de las Funciones de Primera Clase y las Funciones de Orden Superior en PHP.\n\n";

echo "En el caso de las Funciones de Primera Clase, 
para que una función sea un 'Callback' el lenguaje de programación debe permitir que sean tratadas como valores, es decir: 
a) que pueden ser pasados como argumentos, 
b) retornados desde otras funciones, y, 
c) asignados a variables.\n\n";

echo "En el caso de las Funciones de Orden Superior (HOF), 
necesitan recibir un 'Callback' para delegarles la lógica de procesamiento de datos, 
permitiendo que la HOF sea genérica (reutilizable). \n\n";

echo "Finalmente, los 'Callbacks' permiten el 'encapsulamiento de lógica'
ya que permite inyectar lógica específica
(por ejemplo, unir con un string, casteo, sumar, filtrar, ordenar, etcétera), 
sin tener que reescribir la función que controla el flujo de datos.\n\n\n\n";



echo "61.4 EJEMPLO\n\n";

echo "Aquí se muestran diferentes formas de pasar un callback a una Función de Orden Superior (la función array_map() en este caso).\n\n"; 

echo "array_map() es una Función de Orden Superior (HOF) en PHP cuyo propósito es
aplicar una función de callback a cada elemento de uno o más arrays,
y devolver un nuevo array que contiene los resultados de esas aplicaciones.\n\n";

echo "implode() se usa para convertir un array en una cadena, uniendo sus elementos con un separador especificado.\n\n";

echo <<<EJEMPLO_CALLBACKS_ARRAY_MAP
\$numeros = [1, 2, 3, 4];    // Array original

// --- A) Callback como FUNCIÓN ANÓNIMA (Closure) ---
// La forma más común y moderna, ideal para encapsular lógica.
\$duplicar_closure = array_map(function(\$n): float {
    return \$n * 2;
}, \$numeros);

// --- B) Callback como FUNCIÓN NOMBRADA (String) ---
// El nombre de la función se pasa como un string.
function triplicar(\$n): float | int {
    return \$n * 3;
}
\$triplicar_nombrada = array_map('triplicar', \$numeros);

// --- C) Callback como ARROW FUNCTION (Closure moderno, PHP 7.4+) ---
// Sintaxis corta para closures simples, que se comportan como callable.
\$sumar_diez = array_map(fn(\$n): float => \$n + 10, \$numeros);

// ------------------------------------------------------------------
// RESULTADOS
// ------------------------------------------------------------------
echo "Array original: " . implode(', ', \$numeros) . "\\n";

echo "A) Array duplicado (Closure): " . implode(', ', \$duplicar_closure) . "\\n";      // Salida: 2, 4, 6, 8

echo "B) Array triplicado (Nombrada): " . implode(', ', \$triplicar_nombrada) . "\\n";  // Salida: 3, 6, 9, 12

echo "C) Array con suma más Diez (Arrow Fn): " . implode(', ', \$sumar_diez) . "\\n\\n\\n\\n";  // Salida: 11, 12, 13, 14
EJEMPLO_CALLBACKS_ARRAY_MAP;

$numeros = [1, 2, 3, 4];    // Array original

// --- A) Callback como FUNCIÓN ANÓNIMA (Closure) ---
// La forma más común y moderna, ideal para encapsular lógica.
$duplicar_closure = array_map(function($n): float {
    return $n * 2;
}, $numeros);

// --- B) Callback como FUNCIÓN NOMBRADA (String) ---
// El nombre de la función se pasa como un string.
function triplicar($n): float | int {
    return $n * 3;
}

$triplicar_nombrada = array_map('triplicar', $numeros);

// --- C) Callback como ARROW FUNCTION (Closure moderno, PHP 7.4+) ---
// Sintaxis corta para closures simples, que se comportan como callable.
$sumar_diez = array_map(fn($n): float => $n + 10, $numeros);

// ------------------------------------------------------------------
// RESULTADOS
// ------------------------------------------------------------------
echo "Array original: " . implode(', ', $numeros) . "\n";

echo "A) Array duplicado (Closure): " . implode(', ', $duplicar_closure) . "\n";    // Salida: 2, 4, 6, 8

echo "B) Array triplicado (Nombrada): " . implode(', ', $triplicar_nombrada) . "\n";    // Salida: 3, 6, 9, 12

echo "C) Array con suma más Diez (Arrow Fn): " . implode(', ', $sumar_diez) . "\n\n\n\n";   // Salida: 11, 12, 13, 14

echo "61.5 CONCLUSIÓN\n\n";

echo "Los 'Callbacks' son una característica esencial en PHP que permite a los desarrolladores escribir código más modular, reutilizable y flexible.
Al aprovechar las Funciones de Primera Clase y las Funciones de Orden Superior,
los 'Callbacks' facilitan la creación de aplicaciones que pueden adaptarse fácilmente a diferentes requisitos y escenarios sin necesidad de duplicar código.\n\n";  