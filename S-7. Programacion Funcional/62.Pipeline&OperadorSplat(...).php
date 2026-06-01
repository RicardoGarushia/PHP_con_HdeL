<?php
header("Content-Type: text/plain");

echo "62. IMPLEMENTACIÓN DEL PATRÓN PIPELINE\n\n";

echo"El patrón 'PIPELINE' (Tubería) es fundamental para el ENCADENAMIENTO DE FUNCIONES, 
pero antes de continuar con la explicación sobre este patró
es necesario abrir un paréntesis para abordar el operador Splat (...).\n\n\n\n";



echo "62.0 OPERADOR SPLAT (...): ARGUMENTOS VARIABLES ALMACENADOS EN UN ARRAY\n\n";

echo "El operador Splat (...) -también llamado operador rest en otros lenguajes- 
se utilizar en la firma de una función para CAPTURAR UNA LISTA INDEFINIDA DE ARGUMENTOS
PASADOS A UNA FUNCIÓN Y AGRUPARLOS EN UN ÚNICO ARRAY.\n\n";

echo "El operador Splat (...) permite definir funciones que pueden aceptar cualquier número de argumentos,
lo que es especialmente útil cuando no se conoce de antemano cuántos argumentos se pasararán por una función.\n\n";

echo "El operador Splat (...) reemplaza la función fucn_get_args()\n\n"; 

echo "El operador Splat (...) se coloca antes del nombre del parámetro en la firma de la función.\n\n\n\n"; 



echo "62.0.1 EJEMPLO DEL OPERADOR SPLAT (...): ARGUMENTOS VARIABLES ALMACENADOS EN UNA ARRAY\n\n";

echo <<<EjemploOperadorSplat
function showNames(... \$names){ // El '...' captura "Ana", "Pedro", etc., en un array llamado \$names
    foreach(\$names as \$name){
        echo \$name."<br>"; 
    }
}
showNames("Ana", "Pedro", "Mónica", "Juan"); 
// Aquí \$names es el array: ["Ana", "Pedro", "Mónica", "Juan"]\n\n
EjemploOperadorSplat;

function showNames(... $names){ // El '...' captura "Ana", "Pedro", etc., en un array llamado $names
    foreach($names as $name){
        echo $name . "\n"; 
    }
}
showNames("Ana", "Pedro", "Mónica", "Juan"); 
// Aquí $names es el array: ["Ana", "Pedro", "Mónica", "Juan"]



echo "\n\n\n\n61.0.2 DESESTRUCTURACIÓN: USO DEL OPERADOR SPLAT EN LLAMADAS DE FUNCIONES\n\n";

echo "El término DESESTRUCTURACIÓN (Unpacking) o Desenvoltura (Spread)
en PHP se usa más comúnmente para la operación inversa: 
es decir, cuando usas ... (operador Splat) al llamar a una función
para desestructurar el array ingreado.\n\n";

echo "Entonces, tenemos que distinguir dos usos del operador Splat (...):
    a) Para ALMACENAMIENTO DE ARGUMENTOS VARIABLES EN UN ARRAY se emplea el operador Splat(...) en la firma al declarar una función: \n\n";

echo "      // Definición de la función 'ejemploAlmacen' para almacenamiento de argumentos indefinidos en un array 
        function ejemploAlmacen(... \$args) {   // \$args es un array que contiene todos los argumentos pasados por el operador Splat (...)
            // Aquí \$args es un array que contiene todos los argumentos pasados
        }
        ejemploAlmacen(\$argumento1, \$argumento2, \$argumentoN);   // Llamada de la función ejemplo\n\n";

echo "  b) Para DESESTRUCTURACIÓN DURANTE UNA INVOCACIÓN se emplea el operador Splat(...) en la llamada de la función:\n\n";

echo "      // Definición de la función 'ejemploDesestructurar' que recibe un array que será desestructurado    
        function ejemploDesestructurar(\$array) {
            // Aquí \$array es un array que contiene los argumentos desestructurados
        }
        ejemploDesestructurar(... \$array); // DESESTRUCTURACIÓN DEL ARRAY INGRESADO   \n\n";   

echo "Cuando usas el operador Splat (...) en una llamada a función con un array,
PHP 'desestructura' el array, pasando cada uno de sus elementos como argumentos separados a la función.\n\n\n\n";



echo "62.0.2.1 EJEMPLO DE DESESTRUCTURACIÓN CON EL OPERADOR SPLAT (...)\n\n";

echo <<<CODE
\$arrayNames = ["Joaquín", "Ricardo", "Quetzalli", "Sandra"];
// La función showNames() definida anteriormente se reutiliza aquí.
showNames(... \$arrayNames); // Es equivalente a: showNames("Joaquín", "Ricardo", "Quetzalli", "Sandra")
// El operador Splat (...) desempaqueta \$arrayNames en argumentos separados\n\n
CODE;

$arrayNames = ["Joaquín", "Ricardo", "Quetzalli", "Sandra"];
// La función showNames() definida anteriormente se reutiliza aquí.
showNames(... $arrayNames); // Es equivalente a: showNames("Joaquín", "Ricardo", "Quetzalli", "Sandra")
// El operador Splat (...) desempaqueta $arrayNames en argumentos separados




echo "\n\n\n\n62.1 ¿QUÉ ES EL PATRÓN 'PIPELINE'?\n\n";

echo "El PATRÓN PIPELINE es fundamental para el ENCADENAMIENTO DE FUNCIONES.
Un PATRÓN PIPELINE (o 'pipe') es un mecanismo que toma el resultado de una función
y lo usa automáticamente como la entrada (argumento) de la siguiente función en una secuencia.\n\n";

echo "El término 'pipeline/pipe' (tubería) proviene de la analogía con las tuberías físicas,
donde el flujo de un líquido pasa de un punto a otro a través de una serie de conexiones.
En este caso, los datos fluyen a través de una cadena de funciones, como agua a través de una tubería. \n\n";

echo "Imagina una serie de funciones donde la salida de una función se convierte en la entrada de la siguiente.
Este flujo continuo de datos a través de múltiples funciones es lo que define un PIPELINE.\n\n";

echo "Este patrón es especialmente útil en programación funcional,
donde las funciones se componen y encadenan para transformar datos de manera clara y concisa.\n\n\n\n";



echo "62.1.1 ¿QUÉ RELACIÓN TIENE EL PATRÓN 'PIPELINE' CON LA PF?";

echo "El patrón 'PIPELINE' es crucial en la PF porque:
a) Promueve la Pureza: 
    Mantiene las funciones individuales pequeñas, puras y enfocadas en una sola tarea 
    (transformar a mayúsculas, quitar espacios, quitar números).
b) Mejora la Legibilidad: 
    Permite leer el flujo de datos de arriba a abajo, 
    entendiendo claramente el orden de las transformaciones.
c) Inmutabilidad: 
    El valor se reasigna dentro del 'PIPELINE', 
    pero este proceso es controlado y contenido, 
    a diferencia de un efecto secundario global.\n\n\n\n";



echo "62.1.2 EJEMPLO\n\n";

echo <<<EJEMPLO_PIPE
// Definición de función pipe que implementa el patrón PIPELINE
function pipe (... \$funcs): callable{  // 1. Recibe un listado de funciones (toUpper, replaceSpace, etc.) para convertirse en array
    return function (\$resultadoFuncion) use (\$funcs): mixed{  // 2. Devuelve el Closure que recibirá el dato inicial, se usa USE para acceder a \$funcs
        foreach(\$funcs as \$fn){ // 3. Itera sobre cada función en el array \$funcs
            // Muestra qué función se está aplicando (simplificamos la detección para las arrow functions)
            echo "Aplicando función: " . (is_array(\$fn) ? implode("::", \$fn) : (is_string(\$fn) ? \$fn : "Closure")) . "\n"; // Muestra qué función se está aplicando
            \$resultadoFuncion = \$fn(\$resultadoFuncion);  // 4. El resultado de la función anterior es el nuevo valor
            // Muestra el resultado intermedio después de aplicar la función
            echo "Resultado intermedio: " . var_export(\$resultadoFuncion, true) . "\\n";
        }
        return \$resultadoFuncion;  // 5. Retorna el resultado final
    };
}

// Definición de funciones simples para usar en el PIPELINE
\$toUpper = fn (\$cadena):string => strtoupper(\$cadena);   // Convierte a mayúsculas
\$replaceSpace = fn(\$cadena):string => str_replace(" ", "", \$cadena); // Reemplaza espacios con cadena vacía
\$replaceNumbers = fn(\$cadena): string => preg_replace ('/\d+/u', "", \$cadena);   // Elimina dígitos

\$myPipe = pipe(\$toUpper, \$replaceSpace, \$replaceNumbers); // Creación del PIPELINE
\$resultado = \$myPipe("H0o1l2a3 4M5u6n7d8o9! 123"); // Aplicación del PIPELINE

echo "Resultado Final: " . \$resultado . "\\n\\n\\n\\n"; // Muestra el resultado final \n\n
EJEMPLO_PIPE;


// Definición de función pipe que implementa el patrón PIPELINE
function pipe (... $funcs): callable{   // 1. Recibe un listado de funciones (toUpper, replaceSpace, etc.) para convertirse en array
    return function ($resultadoFuncion) use ($funcs): mixed{    // 2. Devuelve el Closure que recibirá el dato inicial, se usa USE para acceder a $funcs
        foreach($funcs as $fn){ // 3. Itera sobre cada función en el array $funcs
            // Se muestra qué función se está aplicando (simplificamos la detección para las arrow functions)
            echo "Aplicando función: " . (is_array($fn) ? implode("::", $fn) : (is_string($fn) ? $fn : "Closure")) . "\n"; // Muestra qué función se está aplicando
            $resultadoFuncion = $fn($resultadoFuncion);   // 4. El resultado de la función anterior es el nuevo valor
            echo "Resultado intermedio: " . var_export($resultadoFuncion, true) . "\n"; // Muestra el resultado intermedio después de aplicar la función   
        }
        return $resultadoFuncion;  // 5. Retorna el resultado final
    };
}

// Definición de funciones simples para usar en el PIPELINE
$toUpper = fn ($cadena):string => strtoupper(string: $cadena);  // La función strtoupper convierte una cadena a mayúsculas
$replaceSpace = fn($cadena):array | string => str_replace(search: " ", replace: "", subject: $cadena);  // La función str_replace reemplaza espacios con cadena vacía
$replaceNumbers = fn($cadena): array | string | null => preg_replace (pattern: '/\d+/u', replacement:"", subject: $cadena); // La función preg_replace elimina dígitos usando una expresión regular

$myPipe = pipe($toUpper, $replaceSpace, $replaceNumbers); // Creación del PIPELINE con las funciones definidas
$resultado = $myPipe("H0o1l2a3 4M5u6n7d8o9! 123"); // Aplicación del PIPELINE a la cadena "H0o1l2a3 4M5u6n7d8o9! 123"

echo "Resultado Final: " . $resultado . "\n\n\n\n"; // Muestra el resultado final después de pasar por el PIPELINE

