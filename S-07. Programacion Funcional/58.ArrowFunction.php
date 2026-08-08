<?php
header("Content-Type: text/plain");

echo "58. ARROW FUNCTION (FUNCIÓN FLECHA)\n\n";

echo "58.1 ¿QUÉ ES UNA \"ARROW FUNCTION\" (FUNCIÓN FLECHA)?\n\n";

echo "Una ARROW FUNTCION (FUNCIÓN FLECHA) son una SINTAXIS MÁS SENCILLA Y SIMPLIFICADA en PHP
(disponible desde PHP 7.4) para DEFINIR FUNCIONES ANÓNIMAS (CLOSURES) de una sola expresión.\n\n";

echo "Su principal característica y ventaja es la captura automática de variables externas por valor. 
Esto las hace más limpias que las funciones anónimas tradicionales (closures), 
ya que no requieren la cláusula 'use' para acceder a variables del ámbito padre.\n\n\n\n";


echo "58.2 SINTAXIS DE UNA \"ARROW FUNCTION\" (FUNCIÓN FLECHA)\n\n";

echo "Se definen usando la palabra clave 'fn' seguida de los argumentos, el operador de flecha (=>), y la única expresión que la función retornará.\n\n";

echo "  fn (argumentos):datatype_a_retornar => expresion_a_retornar;\n\n\n\n";



echo "58.3 ¿QUÉ RELACIÓN TIENEN CON LA PROGRAMACIÓN FUNCIONAL?\n\n";

echo "La ARROW FUNTCIONS (FUNCIONES FLECHAS) están estrechamente relacionadas con la Programación Funcional (PF) por dos razones principales:
    1. Concisión y Legibilidad: 
        Su sintaxis corta...
        (fn (argumentos):datatype_a_retornar => expresion_a_retornar;)
        las hace ideales para ser usadas como Funciones de Primera Clase pasadas a Funciones de Orden Superior
        (como map, filter, reduce), mejorando drásticamente la legibilidad del código funcional.

    2. Facilitan Closures Puras:
        Al capturar automáticamente las variables por valor, 
        refuerzan el principio de inmutabilidad y simplifican la creación de closures (funciones que recuerdan su entorno) que se usan en las HOF.\n\n\n\n";

        

echo "58.4 EJEMPLO DE \"ARROW FUNCTION\" (FUNCIÓN FLECHA)\n\n";

echo "Vamos a retomar el ejemplo de la sección anterior (57.FuncionDeOrdenSuperior.php),
donde se definieron varias funciones matemáticas (algunas anónimas y otras nombradas) 
y se volverán arrow functions (funciones flecha).
Bueno, excepto la función division() dado que las ARROW FUNCTIONS (fn) están diseñadas estrictamente para una sola expresión que se retorna implícitamente. 
Y la función division() tiene múltiples expresiones/sentencias:
        a) Una sentencia condicional (if).
        b) Una sentencia de lanzamiento de excepción (throw).
        c) Una sentencia de retorno (return).\n\n";


echo <<<EJEMPLO_ARROW_HOF
// Definición de varias funciones matemáticas (algunas anónimas y otras nombradas)
// ARROW FUNCTION (FUNCIÓN FLECHA) para la operación de suma (Asignada a \$suma)
\$suma = fn (float \$a, float \$b):float => \$a + \$b;   // Antes: function(float \$a, float \$b): float { return \$a + \$b; };

// ARROW FUNCTION (FUNCIÓN FLECHA) para la operación de resta (Asignada a \$resta)
\$resta = fn (float \$a, float \$b):float => \$a - \$b;  // Antes: function(float \$a, float \$b): float { return \$a - \$b; }; 

// ARROW FUNCTION (FUNCIÓN FLECHA) para la operación de multiplicación (Asignada a \$multiplicacion)
\$multiplicacion = fn (float \$a, float \$b):float => \$a * \$b; // Antes: function(float \$a, float \$b): float { return \$a * \$b; };

// ¡¡¡NO ES POSIBLE HACER UNA ARROW FUNCTION (FUNCIÓN FLECHA) para la operación de división!!!
/*
    Las Arrow Functions (fn) están diseñadas estrictamente para una sola expresión que se retorna implícitamente.
    La función division tiene múltiples expresiones/sentencias:
        a) Una sentencia condicional (if).
        b) Una sentencia de lanzamiento de excepción (throw).
        c) Una sentencia de retorno (return).
*/
function division (float \$a, float \$b): float {
    if (\$b === 0.0) {
        throw new InvalidArgumentException("Error: División por cero no permitida.");
    }
    return \$a / \$b;
}

// FUNCIÓN DE ORDEN SUPERIOR que toma una función como argumento
function ejecutarOperacionMatematica(callable \$operacion, float \$num1, float \$num2): float {    // El pseudotipo 'callable' garantiza que el argumento es una función (o algo invocable) y permite que la HOF la ejecute.
    return \$operacion(\$num1, \$num2);
}

// --- EJECUCIÓN ---
// Usando la función de orden superior con diferentes operaciones matemáticas
// Se pasan las variables (\$suma, \$resta, \$multiplicacion) que contienen las Arrow Functions.
echo "El resultado de la suma es: " . ejecutarOperacionMatematica(\$suma, 30, 20) . "\\n";
echo "El resultado de la resta es: " . ejecutarOperacionMatematica(\$resta, 30, 20) . "\\n";
echo "El resultado de la multiplicación es: " . ejecutarOperacionMatematica(\$multiplicacion, 30, 20) . "\\n";
echo "El resultado de la división es: " . ejecutarOperacionMatematica("division", 30, 20) . "\\n";\n\n\n\n
EJEMPLO_ARROW_HOF;



// Definición de varias funciones matemáticas (algunas anónimas y otras nombradas)
// ARROW FUNCTION (FUNCIÓN FLECHA) para la operación de suma
$suma = fn (float $a, float $b):float => $a + $b;   // Antes: function(float $a, float $b): float { return $a + $b; };

// ARROW FUNCTION (FUNCIÓN FLECHA) para la operación de resta
$resta = fn (float $a, float $b):float => $a - $b;  // Antes: function(float $a, float $b): float { return $a - $b; }; 

// ARROW FUNCTION (FUNCIÓN FLECHA) para la operación de multiplicación
$multiplicacion = fn (float $a, float $b):float => $a * $b; // Antes: function(float $a, float $b): float { return $a * $b; };

// ¡¡¡NO ES POSIBLE HACER UNA ARROW FUNCTION (FUNCIÓN FLECHA) para la operación de división!!!
/*
    Las Arrow Functions (fn) están diseñadas estrictamente para una sola expresión que se retorna implícitamente.
    La función division tiene múltiples expresiones/sentencias:
        a) Una sentencia condicional (if).
        b) Una sentencia de lanzamiento de excepción (throw).
        c) Una sentencia de retorno (return).
*/
function division (float $a, float $b): float {
    if ($b === 0.0) {
        throw new InvalidArgumentException("Error: División por cero no permitida.");
    }
    return $a / $b;
}

// FUNCIÓN DE ORDEN SUPERIOR que toma una función como argumento
function ejecutarOperacionMatematica(callable $operacion, float $num1, float $num2): float {    // El pseudotipo 'callable' garantiza que el argumento es una función (o algo invocable) y permite que la HOF la ejecute.
    return $operacion($num1, $num2);
}

// --- EJECUCIÓN ---
echo "--- EJECUCIÓN ---\n\n";

// Usando la función de orden superior con diferentes operaciones matemáticas
echo "Se pasan las variables (\$suma, \$resta, \$multiplicacion) que contienen las Arrow Functions.\n";
echo "El resultado de la suma es: " . ejecutarOperacionMatematica($suma, 30, 20) . "\n";
echo "El resultado de la resta es: " . ejecutarOperacionMatematica($resta, 30, 20) . "\n";
echo "El resultado de la multiplicación es: " . ejecutarOperacionMatematica($multiplicacion, 30, 20) . "\n\n";

// También es posible pasar una ARROW FUNCTION (FUNCIÓN FLECHA) directamente como argumento
echo "Se pasa la ARROW FUNCTION (FUNCIÓN FLECHA) directamente como argumento.\n";
echo "El resultado de la suma es: ". ejecutarOperacionMatematica(fn (float $a, float $b):float => $a + $b, 30, 20) . "\n" ;
echo "El resultado de la resta es: ". ejecutarOperacionMatematica(fn (float $a, float $b):float => $a - $b, 30, 20) . "\n" ;
echo "El resultado de la multiplicación es: ". ejecutarOperacionMatematica(fn (float $a, float $b):float => $a * $b, 30, 20) . "\n\n" ;

// Finalmente, usando la función de orden superior con la función nombrada 'division' que no se puede convertir en ARROW FUNCTION
echo "El resultado de la división es: " . ejecutarOperacionMatematica("division", 30, 20) . "\n";




