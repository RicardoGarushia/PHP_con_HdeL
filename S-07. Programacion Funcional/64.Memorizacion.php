<?php
header("Content-Type: text/plain");

echo "64. MEMORIZACIÓN (MEMOIZATION)\n\n";

echo "La técnica de 'Memorización' (Memoization) es una TÉCNICA DE ACELERACIÓN
utilizada para acelerar programas informáticos al ALMACENAR EN CACHÉ (cachear)
los RESULTADOS DE LLAMADAS A FUNCIONES COSTOSAS (en tiempo y procesamiento de CPU)
Y DEVOLVER EL RESULTADO ALMACENADO cuando se vuelven a llamar con los MISMOS ARGUMENTOS.\n\n";

echo "Para que una función pueda ser memorizada eficazmente,
debe cumplir con el principio de Pureza de la Programación Funcional, es decir:
    a) Determinismo:
        La función debe devolver siempre la misma salida para la misma entrada.
    b) Ausencia de Efectos Secundarios:
        La función no debe modificar ningún estado fuera de su ámbito.\n\n";

echo "Si estos requisitos se cumplen,
podemos garantizar que el resultado almacenado en la memoria caché es correcto y no necesita ser recalculado.\n\n\n\n";



echo "64.1 RELACIÓN DE LA 'MEMORIZACIÓN' (MEMOIZATION) CON LA PROGRAMACIÓN FUNCIONAL (PF)\n\n";

echo "La memorización es una técnica central en la PF debido a su dependencia directa de la Pureza, las Funciones de Primera Clase y las Funciones de Orden Superior.
    a) Pureza:
        La memorización solo funciona correctamente con Funciones Puras.
        Si una función tuviera efectos secundarios (como leer de un archivo o modificar una base de datos),
        el valor cacheado podría ser obsoleto o incorrecto.
    b) Cierre (Closure) y Estado:
        La implementación de la memorización a menudo se logra mediante un Cierre (Closure).
        El Closure permite que una función interna (el proceso de cálculo) acceda
        y modifique el estado de una variable externa (\$cache) que persiste entre llamadas, lo cual es el mecanismo de cacheo.\n\n\n\n";


        
echo "64.2 EJEMPLO\n\n";

echo <<<EJEMPLO_MEMOIZATION
// Definición de la Función de Orden Superior para Memorización
function memoryAdd(): callable{
    \$cache = []; // CACHÉ: Inicializada, existe mientras dure la función externa

    return function(float \$a, float \$b) use(&\$cache): float{ // CIERRE: Accede a \$cache por referencia
        \$index = \$a . "-" . \$b; // Genera una clave única (el identificador de la operación)

        if(isset(\$cache[\$index])){
            // 1. GOLPE DE CACHÉ (Cache Hit): La operación ya se hizo.
            echo "\n(Ya existía la operación. Se extrae resultado de array.)\n";
            return \$cache[\$index]; // Devuelve el resultado almacenado sin calcular
        }

        // 2. ERROR DE CACHÉ (Cache Miss): La operación es nueva.
        \$cache[\$index] = \$a + \$b; // Realiza el cálculo
        echo "\n(No existía operación. Así que se realiza cálculo y se almacena en array.)\n";
        return \$cache[\$index]; // Devuelve el resultado y lo deja guardado
    };
}

\$myProcess = memoryAdd(); 

echo "Si se ingresan los valores de 10 y 10, el resultado es el siguiente: " . \$myProcess(10, 10) . "\n";
// Salida esperada: (No existía operación. Así que se realiza cálculo y se almacena en array.)
// Si se ingresan los valores de 10 y 10, el resultado es el siguiente: 20

echo "Si se ingresan los valores de 20 y 10, el resultado es el siguiente: " . \$myProcess(20, 10) . "\n";
// Salida esperada: (No existía operación. Así que se realiza cálculo y se almacena en array.)
// Si se ingresan los valores de 10 y 10, el resultado es el siguiente: 30

echo "Si se ingresan los valores de 10 y 10, el resultado es el siguiente: " . \$myProcess(10, 10) . "\n";
// Salida esperada: (Ya existía la operación. Se extrae resultado de array.)
// Si se ingresan los valores de 10 y 10, el resultado es el siguiente: 20\n\n
EJEMPLO_MEMOIZATION;


function memoryAdd(): callable{
    $cache = []; // CACHÉ: Inicializada, existe mientras dure la función externa

    return function(float $a, float $b) use(&$cache): float{ // CIERRE: Accede a $cache por referencia
        $index = $a . "-" . $b; // Genera una clave única (el identificador de la operación)

        if(isset($cache[$index])){
            // 1. GOLPE DE CACHÉ (Cache Hit): La operación ya se hizo.
            echo "\n(Ya existía la operación. Se extrae resultado de array.)\n";
            return $cache[$index]; // Devuelve el resultado almacenado sin calcular
        }

        // 2. ERROR DE CACHÉ (Cache Miss): La operación es nueva.
        $cache[$index] = $a + $b; // Realiza el cálculo
        echo "\n(No existía operación. Así que se realiza cálculo y se almacena en array.)\n";
        return $cache[$index]; // Devuelve el resultado y lo deja guardado
    };
}

$myProcess = memoryAdd(); 

echo "Si se ingresan los valores de 10 y 10, el resultado es el siguiente: " . $myProcess(10, 10) . "\n";
// Salida: (No existía operación. Así que se realiza cálculo y se almacena en array.)
// Si se ingresan los valores de 10 y 10, el resultado es el siguiente: 20

echo "Si se ingresan los valores de 20 y 10, el resultado es el siguiente: " . $myProcess(20, 10) . "\n";
// Salida: (No existía operación. Así que se realiza cálculo y se almacena en array.)
// Si se ingresan los valores de 10 y 10, el resultado es el siguiente: 30

echo "Si se ingresan los valores de 10 y 10, el resultado es el siguiente: " . $myProcess(10, 10) . "\n";
// Salida: (Ya existía la operación. Se extrae resultado de array.)
// Si se ingresan los valores de 10 y 10, el resultado es el siguiente: 20


echo "\n\n\n64.3 CONCLUSIÓN: Importancia y Economía en Sistemas Grandes\n\n";

echo "En los sistemas modernos, el tiempo de CPU y la latencia son recursos más críticos y costosos que el almacenamiento en disco.
Si el cálculo toma más de unos pocos milisegundos y se usa con frecuencia, la memorización persistente es la opción más económica y escalable.\n\n\n\n";