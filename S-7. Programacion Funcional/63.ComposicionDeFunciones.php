<?php
header("Content-Type: text/plain");

echo "63. COMPOSICIÓN DE FUNCIONES (FUNCTION COMPOSITION)\n\n";

echo "El patrón de 'COMPOSICIÓN DE FUNCIONES' (Function Composition) es, generalmente,
la aplicación de una función al resultado de otra, lo que da como resultado
una 'tercera función' que realiza ambas operaciones.\n\n";

echo "En términos matemáticos (álgebra)
se trata de encadenar dos funciones f() y g() para crear una nueva función c() tal que 
c(x) = f(g(x)).\n\n";

echo "Esta nueva función se lee de adentro hacia afuera (o de derecha a izquierda).
Es decir, la función más interna (en el ejemplo g(x)) se ejecuta primero, 
y su resultado se pasa inmediatamente a la función exterior f(g(x)).\n\n";

echo "En un inicio de comento 'generalmente' dado que
se pueden encadenar cuantas funciones se deseen. Es decir, 
c(x) = f(g(h(i...(n(x))...)))\n\n\n\n";



echo "63.1 ¿QUÉ RELACIÓN TIENE EL PATRÓN 'PIPELINE' CON LA PF?\n\n";

echo "El patrón de 'COMPOSICIÓN DE FUNCIONES' (Function Composition) es
uno de los conceptos más importantes de la Programación Funcional (PF):
    a) Modularidad y Reutilización:
        Permite construir funciones complejas a partir de funciones más pequeñas, puras y simples, cada una haciendo una sola cosa.
    b) Creación de Funciones a Demanda:
        La función composicion es una Función de Orden Superior porque toma dos o más funciones como argumentos y devuelve una nueva función (el Closure).
    c) Legibilidad Matemática:
        Mantiene la sintaxis del álgebra funcional, es decir, c(x) = f(g(x)) .\n\n\n\n";



echo "63.2 SEMEJANZAS Y DIFERENCIAS ENTRE EL PATRÓN 'COMPOSICIÓN' Y EL PATRÓN 'PIPELINE'\n\n";

echo "Ambos patrones, Composición y Pipe, tienen como objetivo el
ENCADENAMIENTO DE FUNCIONES para transformar datos.
Sin embargo, tienen las siguientes diferencias.\n\n";

echo "a) Composicion crea una nueva función, como en c(x) = f(g(x));
mientras que Pipe aplica una secuencia de transformaciones lineales.\n\n";

echo "b) Composicion aplica un número predeterminado de funciones en la firma de la nueva función;
mientras que Pipe puede aplicar cualquier número N de funciones.\n\n";

echo "c) Composicion se implementa mediante llamadas anidadas;
mientras que Pipe utiliza un bucle foreach iterando sobre un array de funciones.\n\n";

echo "d) Composicion tiene un flujo de datos de adentro hacia afuera (o de derecha a izquierda);
mientras que Pipe maneja un flujo de datos de izquierda a derecha (o Top-Down).\n\n\n\n";



echo "63.3 EJEMPLO\n\n";

echo <<<EJEMPLO_COMPOSICION_ORDEN
// Definición de la Función de Orden Superior para Composición
function composicion(callable \$funcion1, callable \$funcion2): callable{
    return function (\$valor) use (\$funcion1, \$funcion2): mixed{
        // El orden de ejecución es de DERECHA a IZQUIERDA: \$funcion2 se ejecuta primero.
        return \$funcion1(\$funcion2(\$valor));
    };
}

// ------------------------------------------------------------------
// Definición de funciones simples
\$sumar_siete = fn (float \$a):float => \$a + 7;            // Arrow function (véase 58.ArrowFunction.php)
\$multiplicar_por_tres = fn (float \$a):float => \$a * 3;   // Arrow function (véase 58.ArrowFunction.php)

// ------------------------------------------------------------------
// COMPOSICIÓN 1: f(g(x)) = sumar_siete(multiplicar_por_tres(x))
// Proceso (con 10): 10 -> (x * 3) = 30 -> (30 + 7) = 37
\$funcionCompuesta1 = composicion(funcion1: \$sumar_siete, funcion2: \$multiplicar_por_tres);

// COMPOSICIÓN 2: g(f(x)) = multiplicar_por_tres(sumar_siete(x))
// Proceso (con 10): 10 -> (x + 7) = 17 -> (17 * 3) = 51
\$funcionCompuesta2 = composicion(funcion1: \$multiplicar_por_tres, funcion2: \$sumar_siete);

// ------------------------------------------------------------------
// RESULTADOS
echo "Composición 1 (Sumar después de Multiplicar): \\\$sumar_siete(\\\$multiplicar_por_tres(10))" . "\\n";
echo "Resultado: " . \$funcionCompuesta1(10) . "\\n\\n"; // Salida: 37

echo "Composición 2 (Multiplicar después de Sumar): \\\$multiplicar_por_tres(\\\$sumar_siete(10))" . "\\n";
echo "Resultado: " . \$funcionCompuesta2(10) . "\\n"; // Salida: 51\n\n
EJEMPLO_COMPOSICION_ORDEN;


// Definición de la Función de Orden Superior para Composición
function composicion(callable $funcion1, callable $funcion2): callable{
    return function ($valor) use ($funcion1, $funcion2): mixed{
        // El orden de ejecución es de DERECHA a IZQUIERDA: $funcion2 se ejecuta primero.
        return $funcion1($funcion2($valor));
    };
}

// ------------------------------------------------------------------
// Definición de funciones simples
$sumar_siete = fn (float $a):float => $a + 7;           // Arrow function (véase 58.ArrowFunction.php)
$multiplicar_por_tres = fn (float $a):float => $a * 3;  // Arrow function (véase 58.ArrowFunction.php)

// ------------------------------------------------------------------
// COMPOSICIÓN 1: f(g(x)) = sumar_siete(multiplicar_por_tres(x))
// Proceso (con 10): 10 -> (x * 3) = 30 -> (30 + 7) = 37
$funcionCompuesta1 = composicion(funcion1: $sumar_siete, funcion2: $multiplicar_por_tres);

// COMPOSICIÓN 2: g(f(x)) = multiplicar_por_tres(sumar_siete(x))
// Proceso (con 10): 10 -> (x + 7) = 17 -> (17 * 3) = 51
$funcionCompuesta2 = composicion(funcion1: $multiplicar_por_tres, funcion2: $sumar_siete);

// ------------------------------------------------------------------
// RESULTADOS
echo "Composición 1 (Sumar después de Multiplicar): \$sumar_siete(\$multiplicar_por_tres(10))" . "\n";
echo "Resultado: " . $funcionCompuesta1(10) . "\n\n"; // Salida: 37. El resultado tras ejecutar $multiplicar_por_tres y $sumar_siete al valor de 10 es: 37

echo "Composición 2 (Multiplicar después de Sumar): \$multiplicar_por_tres(\$sumar_siete(10))" . "\n";
echo "Resultado: " . $funcionCompuesta2(10) . "\n\n"; // Salida: 51. El resultado tras ejecutar $sumar_siete y $multiplicar_por_tres al valor de 10 es: 51

echo "Ten en cuenta que el orden de los factores altera el producto, 
así que ten siempre en mente el orden en que se ejecutan las funciones, 
de adentro hacia afuera (o de derecha a izquierda) para la firma de una función.";
