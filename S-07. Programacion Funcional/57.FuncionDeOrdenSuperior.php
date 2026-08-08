<?php
header("Content-Type: text/plain");

echo "57. FUNCIONES DE ORDEN SUPERIOR\n\n";

echo "57.1 ¿QUÉ ES UNA \"FUNCIÓN DE ORDEN SUPERIOR\"?\n\n";

echo "Una FUNCIÓN DE ORDEN SUPERIOR (Higher-Order Function) es aquella función que realiza una o ambas de las siguientes acciones: 
a) Toma una o más funciones como argumentos (es decir, recibe funciones como parámetros).
b) Devuelve una función como resultado (es decir, retorna una función desde su cuerpo).\n\n";

echo "En términos más simples, SON FUNCIONES QUE OPERAN SOBRE OTRAS FUNCIONES. 
Solo son posibles en lenguajes que soportan Funciones de Primera Clase (como PHP), 
ya que necesitan tratar las funciones como valores que pueden pasarse y devolverse.\n\n\n\n";



echo "57.2 ¿QUÉ ES RELACIÓN TIENEN CON LA PROGRAMACIÓN FUNCIONAL?\n\n";

echo "Las FUNCIONES DE ORDEN SUPERIOR son el motor de la Programación Funcional (PF) y la herramienta principal para la abstracción y la composición.\n\n";

echo "a) ABSTRACCIÓN DE CONTROL: 
Permiten separar la lógica del negocio (la función que hace el trabajo) de la lógica de control (cómo y cuándo se ejecuta el trabajo). 
Por ejemplo, un HOC como map abstrae la iteración y aplicación de una función a cada elemento de una lista, 
permitiéndote concentrarte solo en qué hacer con un elemento individual.
b) COMPOSICIÓN y REUTILIZACIÓN: 
Facilitan la creación de código altamente reutilizable y flexible. 
Ya que permiten encapsular patrones de comportamiento comunes,
dando lugar a funciones más genéricas y reutilizables;
al tiempo que facilitan la creación de nuevas funciones combinando funciones existentes,
lo que es un principio central en la PF..
Al componer varias HOC, puedes construir programas complejos a partir de bloques funcionales simples y puros (sin mutación ni estado).
c) PATRONES FUNDAMENTALES: 
Los patrones más comunes de la PF, como map, filter y reduce (también conocidos como fold), son implementaciones de Funciones de Orden Superior\n\n\n\n";


echo "57.3 EJEMPLO DE FUNCIÓN DE ORDEN SUPERIOR\n\n";

echo "En si, ya se presentaron ejemplos de Funciones de Orden Superior en la sección anterior (56.FuncionDePrimeraClase.php), 
dado que las Funciones de Orden Superior son un subconjunto de las Funciones de Primera Clase.\n\n";

echo "En este caso se enfatizará el uso de una Función de Orden Superior que toma funciones ANÓNIMAS y NOMBRADAS como argumento.\n\n";


echo <<<EJEMPLO_HOF_MATEMATICA
// Definición de varias funciones matemáticas (algunas anónimas y otras nombradas)
// Función anónima para la operación de suma
\$suma = function(float \$a, float \$b): float {
    return \$a + \$b;
};
// Función nombrada para la operación de resta
function resta (float \$a, float \$b): float {
    return \$a - \$b;
}
// Función anónima para la operación de multiplicación
\$multiplicacion = function(float \$a, float \$b): float {
    return \$a * \$b;
};
// Función nombrada para la operación de división
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
echo "El resultado de la suma es: " . ejecutarOperacionMatematica(\$suma, 30, 20) . "\\n";
echo "El resultado de la resta es: " . ejecutarOperacionMatematica("resta", 30, 20) . "\\n";
echo "El resultado de la multiplicación es: " . ejecutarOperacionMatematica(\$multiplicacion, 30, 20) . "\\n";
echo "El resultado de la división es: " . ejecutarOperacionMatematica("division", 30, 20) . "\\n";

EJEMPLO_HOF_MATEMATICA;


// Definición de varias funciones matemáticas (algunas anónimas y otras nombradas)
// Función anónima para la operación de suma
$suma = function(float $a, float $b): float {
    return $a + $b;
};
// Función nombrada para la operación de resta
function resta (float $a, float $b): float {
    return $a - $b;
}
// Función anónima para la operación de multiplicación
$multiplicacion = function(float $a, float $b): float {
    return $a * $b;
};
// Función nombrada para la operación de división
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
// Usando la función de orden superior con diferentes operaciones matemáticas
echo "El resultado de la suma es: " . ejecutarOperacionMatematica($suma, 30, 20) . "\n";
echo "El resultado de la resta es: " . ejecutarOperacionMatematica("resta", 30, 20) . "\n";
echo "El resultado de la multiplicación es: " . ejecutarOperacionMatematica($multiplicacion, 30, 20) . "\n";
echo "El resultado de la división es: " . ejecutarOperacionMatematica("division", 30, 20) . "\n";
