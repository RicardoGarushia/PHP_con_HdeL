<?php
header("Content-Type: text/plain");

echo "60. CLOSURE: COMO CONCEPTO DE PF Y COMO CLASS (IMPLEMENTACIÓN) DE PHP\n\n";

echo "Como menciona el título 'closure' tiene dos acepciones: 
a) Como concepto teórico de PG. 
b) Como implementación en PHP.\n\n\n\n";



echo "60.1 ¿QUÉ ES 'CLOSURE' COMO CONCEPTO DE PF?\n\n";

echo "'Closure' como concepto teórico de PF es
una combinación entre una función que 'recuerda' (y accede) el entorno en el que fue creada,
incluyendo las variables externas a su propio ámbito que estaban presentes en ese momento, 
incluso cuando se ejecuta fuera de ese entorno.\n\n";

echo "El punto clave es la persistencia de la memoria. 
Si defines una función dentro de otra, 
el 'closure' permite que la función anónima interna siga accediendo a las variables locales de la función externa, 
incluso después de que la función externa haya terminado de ejecutarse y su scope se haya destruido.\n\n";

echo "Su sintaxis es una función anónima completa que
tiene la capacidad de capturar variables externas mediante el uso de la palabra reservada 'use'.
Por ejemplo: 

\$variableDelEntorno = \"Valor externo al contexto de la función anónima\";

function() use (\$variableDelEntorno) {
... Procedimientos ...
};

(véase 59.use o el ejemplo de 56.FuncionDePrimeraClase para ejemplos concretos).\n\n\n\n";



echo "60.1.1 ¿QUÉ RELACIÓN TIENE 'CLOSURE' COMO CONCEPTO TEÓRICO EN LA PF?\n\n";

echo "Los 'closures' son fundamentales en la PF porque permiten:
1. Funciones de Orden Superior: Permiten que las funciones devuelvan otras funciones que
    pueden operar con datos del entorno donde fueron creadas.
2. Encapsulamiento: Permiten encapsular lógica junto con su contexto,
    facilitando la creación de funciones especializadas.
3. Inmutabilidad: Al capturar variables por valor, los 'closures' ayudan a mantener la inmutabilidad,
    ya que las variables externas no pueden ser modificadas desde dentro del 'closure',
    ni fuera del 'closure' una vez que el valor a sido capturado en el 'closure'.\n\n\n\n";



echo "60.1.2 EJEMPLO DE 'CLOSURE' COMO CONCEPTO DE PF\n\n";

echo "(También puede ver los ejemplos en 59.use o el ejemplo de 56.FuncionDePrimeraClase
donde se utiliza la palabra reservada 'use' para capturar variables externas dentro de una función anónima)\n\n";

echo <<<EJEMPLO_CLOSURE_PARAMETRO
function precioFinal(float \$IVA): callable{ // Función que devuelve una función anónima (closure) y recibe el IVA como parámetro
    return function(float \$precioBase) use (\$IVA): float {  // Función anónima que captura \$IVA del entorno externo
        return \$precioBase + (\$precioBase * \$IVA / 100);    // Cálculo del precio final con IVA
    };
}

// Nota: Aquí se asume que \$IVA Ó ya está declarado en el ámbito global, Ó se pasa un valor directo, como se hará a continuación.

\$calculadoraIVA16 = precioFinal(16.0);     // Llamada a la función que devuelve el closure, pasando la tasa general de IVA del 16% válido para la mayor parte de México
\$calculadoraIVA8 = precioFinal(8.0);       // Llamada a la función que devuelve el closure, pasando la tasa del 8% para zona fronteriza norte

echo "Precio Final (IVA 16%) con un precio antes impuestos de 3000: " . \$calculadoraIVA16(3000) . "\\n";   // Ejecución del closure con un precio base de 3000. Salida: 3480
echo "Precio Final (IVA 16%) con un precio antes impuestos de 2000: " . \$calculadoraIVA16(2000) . "\\n\\n";    // Ejecución del closure con un precio base de 2000. Salida: 2320 \n\n
echo "Precio Final (IVA 8%) con un precio antes impuestos de 3000: " . \$calculadoraIVA8(3000) . "\\n";   // Ejecución del closure con un precio base de 3000. Salida: 3240
echo "Precio Final (IVA 8%) con un precio antes impuestos de 2000: " . \$calculadoraIVA8(2000) . "\\n\\n\\n\\n";    // Ejecución del closure con un precio base de 2000. Salida: 2160 \n\n

EJEMPLO_CLOSURE_PARAMETRO;

function precioFinal(float $IVA): callable{ // Función que devuelve una función anónima (closure) y recibe el IVA como parámetro
    return function(float $precioBase) use ($IVA): float {  // Función anónima que captura $IVA del entorno externo
        return $precioBase + ($precioBase * $IVA / 100);    // Cálculo del precio final con IVA
    };
}

// Nota: Aquí se asume que \$IVA Ó ya está declarado en el ámbito global, Ó se pasa un valor directo, como se hará a continuación.

$calculadoraIVA16 = precioFinal(16);    // Llamada a la función que devuelve el closure, pasando la tasa general de IVA del 16% válido para la mayor parte de México
$calculadoraIVA8 = precioFinal(8);      // Llamada a la función que devuelve el closure, pasando la tasa del 8% para zona fronteriza norte

echo "Precio Final (IVA 16%) con un precio antes impuestos de 3000: " . $calculadoraIVA16(3000) . "\n";    // Ejecución del closure con un precio base de 3000. Salida: 3480
echo "Precio Final (IVA 16%) con un precio antes impuestos de 2000: " . $calculadoraIVA16(2000) . "\n\n";    // Ejecución del closure con un precio base de 2000. Salida: 2320
echo "Precio Final (IVA 8%) con un precio antes impuestos de 3000: " . $calculadoraIVA8(3000) . "\n";    // Ejecución del closure con un precio base de 3000. Salida: 3240
echo "Precio Final (IVA 8%) con un precio antes impuestos de 2000: " . $calculadoraIVA8(2000) . "\n\n\n\n";    // Ejecución del closure con un precio base de 2000. Salida: 2160



echo "60.2 ¿QUÉ ES 'CLOSURE' COMO IMPLEMENTACIÓN EN PHP?\n\n";

echo "'Closure' como implementación en PHP es
el nombre de la clase interna que PHP usa para representar y MANIPULAR funciones anónimas.
Es decir, las funciones anónimas generan objetos de esta clase que pueden ser manipulados, por ejemplo: 
    a) Asignarla a una variable.
    b) Pasarla como argumento a otra función (por ejemplo, a un array_map()).
    c) Devolverla de otra función.
Esta clase cuenta con métodos que permiten un mayor control de las funciones anónimas una vez creadas.\n\n";

echo "Si una función anónima únicamente es invocada inmediatamente después de su definición,
    a) NO se asigna a una variable,
    b) NO se pasa como argumento en otras funciones, 
    c) NO se devuelve desde otra función,
entonces NO SE CREA UNA INSTANCIA 'Closure'.\n\n";

echo "Entonces, tiene una sintaxis, más bien, permite que las instancias de funciones anónimas sean MANIPULABLES.\n\n";

echo "Por ejemplo: 
\$miFuncion = function() use (\$variableExterna){   // La función anónima se asigna a una variable, creando una instancia Closure
... Procedimientos ...
};\n\n\n\n";



echo "60.2.1 ¿QUÉ RELACIÓN TIENE 'CLOSURE' COMO IMPLEMENTACIÓN EN PHP EN LA PF?\n\n";

echo "Básicamente, el hecho de que las funciones anónimas en PHP sean instancias de la clase 'Closure'
facilita la manipulación avanzada de estas funciones, lo que es esencial para la Programación Funcional.
Por ejemplo, permite:
1. Inspección y Manipulación: Los métodos de la clase Closure permiten inspeccionar y manipular las funciones anónimas,
    lo que es útil para depuración y metaprogramación en PF.
2. Compatibilidad con Callables: Al ser objetos, las funciones anónimas pueden ser pasadas y devueltas fácilmente,
    cumpliendo con los requisitos de las funciones de orden superior en PF.\n\n\n\n";


echo "60.3 EJEMPLOS\n\n";

echo <<<EJEMPLO_A
// A) Ejemplo de uso de la clase Closure en PHP por ASIGNACIÓN A VARIABLE
// Definición de una función anónima y asignación a una variable (crea una instancia Closure)
\$saludar = function(string \$nombre): string {
    return "¡Hola, " . \$nombre . "! ";
};

// EJECUCIÓN de la función anónima asignada a la variable
echo \$saludar("Ricardo Leonardo García López") . "\\n\\n\\n\\n";\n\n
EJEMPLO_A;


// A) Ejemplo de uso de la clase Closure en PHP por ASIGNACIÓN A VARIABLE
// Definición de una función anónima y asignación a una variable (crea una instancia Closure)
$saludar = function(string $nombre): string {
    return "¡Hola, " . $nombre . "! ";
};

// EJECUCIÓN de la función anónima asignada a la variable
echo $saludar("Ricardo Leonardo García López");
echo "\n\n\n\n";

echo <<<EJEMPLO_B
// B) Ejemplo de uso de la clase Closure en PHP por PASO COMO ARGUMENTO
// Definición de una función anónima y asignación a una variable (crea una instancia Closure)
function ejecutarFuncion(callable \$funcion, string \$nombre): void {
    echo \$funcion(\$nombre) . "\\n";
};

// EJECUCIÓN pasando la función anónima como argumento
ejecutarFuncion(\$saludar, "Ana María Pérez");
echo "\\n\\n\\n\\n";\n\n
EJEMPLO_B;

// B) Ejemplo de uso de la clase Closure en PHP por PASO COMO ARGUMENTO
// Definición de una función anónima y asignación a una variable (crea una instancia Closure)
function ejecutarFuncion(callable $funcion, string $nombre): void {
    echo $funcion($nombre);
};

// EJECUCIÓN pasando la función anónima como argumento
ejecutarFuncion($saludar, "Ana María Pérez");
echo "\n\n\n\n";

echo <<<EJEMPLO_C
// C) Ejemplo de uso de la clase Closure en PHP por DEVOLUCIÓN DESDE OTRA FUNCIÓN
function obtenerFuncionSaludo(): Closure {
    return function(string \$nombre): string {
        return "¡Hola, " . \$nombre . "! ";
    };
};

\$funcionSaludo = obtenerFuncionSaludo();

echo \$funcionSaludo("Ricardo García López") . "\\n\\n\\n\\n";\n\n
EJEMPLO_C;

// C) Ejemplo de uso de la clase Closure en PHP por DEVOLUCIÓN DESDE OTRA FUNCIÓN
function obtenerFuncionSaludo(): Closure {
    return function(string $nombre): string {
        return "¡Hola, " . $nombre . "! ";
    };
};

$funcionSaludo = obtenerFuncionSaludo();

echo $funcionSaludo("Ricardo García López") . "\n\n\n\n";



echo "60.4 RESUMEN\n\n";

echo "La confusión surge porque...
    a) Si una función anónima usa 'use', está aplicando el concepto teórico de 'closure' (la persistencia de la memoria).
    b) En PHP, casi siempre una \"función anónima\" es una instancia de la clase 'closure'. 
        Es clase 'closure' cuando una 'función anónima' es: 
        a) Asignada a una variable.
        b) Pasada como argumento a otra función (por ejemplo, a un array_map()).
        c) Devuelta por otra función.\n\n";

echo "Entonces, no es que sean dos conceptos completamente separados y diferentes, sino que: 
    a) Una función anónima en PHP es una instancia de la clase Closure (implementación en PHP).
    b) Si esa función anónima usa 'use', está aplicando el concepto teórico de 'closure' (persistencia del ámbito en la memoria).\n\n\n\n";


    
echo "60.5 AMPERSAND (&): CAPTURA POR REFERENCIA\n\n";

echo "En PHP tiene dos usos el AMPERSAND (&): 
a) En la declaración de funciones para indicar que un parámetro se pasa por referencia.
b) En la cláusula USE de un closure para indicar que una variable externa se captura por referencia.\n\n\n\n";



echo "60.5.1 PASO DE ARGUMENTOS/PARÁMETROS POR REFERENCIA EN DECLARACIÓN DE FUNCIONES (FIRMA DE FUNCIÓN)\n\n";

echo "En este caso, si al definir la firma de una función se utiliza el ampersand (&) antes del nombre de un parámetro,
se indica que ese parámetro se pasa por referencia. Es decir, el parámetro no recibe una copia del valor del argumento,
sino una referencia directa a la variable original utilizada en la llamada a la función.\n\n";

echo "Esto significa que, CUALQUIER CAMBIO REALIZADO EN EL PARÁMETRO DENTRO DE LA FUNCIÓN
AFECTARÁ A LA VARIABLE ORIGINAL FUERA DE LA FUNCIÓN.\n\n\n\n";


echo "60.5.1.1 EJEMPLO DE PASO DE ARGUMENTOS/PARÁMETROS POR REFERENCIA EN DECLARACIÓN DE FUNCIONES (FIRMA DE FUNCIÓN)\n\n";

echo <<<EJEMPLO_AMPERSAND
\$parametro = 0; // Inicialización de la variable para el ejemplo

function modificarParametroPorAMPERSAND(&\$unParametro): void {
    \$unParametro ++;   // Se suma una unidad al parámetro pasado por referencia
};

echo "Valor inicial de \$parametro antes de la llamada a la función cuya firma tiene ampersand: \$parametro\\n";    // Salida: 0
modificarParametroPorAMPERSAND(\$parametro); // Llamada #1 a la función pasando la variable por referencia
modificarParametroPorAMPERSAND(\$parametro); // Llamada #2 a la función pasando la variable por referencia
modificarParametroPorAMPERSAND(\$parametro); // Llamada #3 a la función pasando la variable por referencia
modificarParametroPorAMPERSAND(\$parametro); // Llamada #4 a la función pasando la variable por referencia

echo "Valor final de \$parametro después de varias llamadas (4) a la función cuya firma tiene ampersand: \$parametro\\n\\n";    // Salida: 4 (El valor inicial 0, más 4 incrementos)\n\n
EJEMPLO_AMPERSAND;

$parametro = 0;

function modificarParametroPorAMPERSAND(&$unParametro): void {
    $unParametro ++;    // Se suma una unidad al parámetro pasado por referencia
};

echo "Valor inicial de \$parametro antes de la llamada a la función cuya firma tiene ampersand: $parametro\n"; // Salida: 0
modificarParametroPorAMPERSAND($parametro); // Llamada #1 a la función pasando la variable por referencia
modificarParametroPorAMPERSAND($parametro); // Llamada #2 a la función pasando la variable por referencia
modificarParametroPorAMPERSAND($parametro); // Llamada #3 a la función pasando la variable por referencia
modificarParametroPorAMPERSAND($parametro); // Llamada #4 a la función pasando la variable por referencia

echo "Valor final de \$parametro después de varias llamadas a la función cuya firma tiene ampersand: $parametro\n\n"; // Salida: 4 (El valor inicial 0, más 4 incrementos)

echo "En caso de no utilizar AMPERSAND (&) unicamente se pasa una copia sin afectación alguna.\n\n";

echo <<<EJEMPLO_SIN_AMPERSAND
\$otroParametro = 0; 
function mismaFuncionFaltaAmpersand(\$unParametro): void {
    \$unParametro ++;   // Se suma una unidad a la COPIA del parámetro
};

echo "Valor inicial de \$otroParametro antes de la llamada a la función sin ampersand: \$otroParametro\\n"; 
// Salida: 0
mismaFuncionFaltaAmpersand(\$otroParametro); // Llamada a la función pasando la variable por VALOR (sin ampersand)
mismaFuncionFaltaAmpersand(\$otroParametro); // Llamada a la función pasando la variable por VALOR (sin ampersand)
mismaFuncionFaltaAmpersand(\$otroParametro); // Llamada a la función pasando la variable por VALOR (sin ampersand)
mismaFuncionFaltaAmpersand(\$otroParametro); // Llamada a la función

echo "Valor final de \$otroParametro después de las mismas llamadas a una función similar, pero sin ampersand: \$otroParametro\\n\\n\\n\\n"; 
// Salida: 0 (La variable original nunca fue modificada)
EJEMPLO_SIN_AMPERSAND;

$otroParametro = 0; 
function mismaFuncionFaltaAmpersand($unParametro): void {
    $unParametro ++;    // Se suma una unidad al parámetro pasado por referencia
};

echo "Valor inicial de \$parametro antes de la llamada a la función sin ampersand: $otroParametro\n"; // Salida: 0
mismaFuncionFaltaAmpersand($otroParametro); // Llamada a la función pasando la variable por VALOR (sin ampersand)
mismaFuncionFaltaAmpersand($otroParametro); // Llamada a la función pasando la variable por VALOR (sin ampersand)
mismaFuncionFaltaAmpersand($otroParametro); // Llamada a la función pasando la variable por VALOR (sin ampersand)
mismaFuncionFaltaAmpersand($otroParametro); // Llamada a la función

echo "Valor final de \$otroParametro después de las mismas llamadas a una función similar, pero sin ampersand: $otroParametro\n\n\n\n"; // Salida: 0



echo "60.5.2 CAPTURA DE VARIABLES EXTERNAS POR REFERENCIA EN CLOSURE (USE y AMPERSAND -&-)\n\n"; 

echo "Cuando se utiliza el ampersand (&) dentro de la cláusula USE de un closure,
se indica que la variable externa no debe ser copiada por valor,
sino capturada por referencia.\n\n"; 

echo "Es decir, sin el uso del ampersan & (Por Valor/Copia, el modo PF):
El closure toma una copia del valor en el momento de la definición.
Los cambios posteriores a la variable original no afectan al closure.
(Esto mantiene la inmutabilidad).\n\n";

echo "Por otro lado, sí se usa el ampersan & (Por Referencia, el modo imperativo):
El closure guarda un puntero o referencia a la ubicación de memoria de la variable original.
Si la variable original cambia en el ámbito padre después de que el closure fue definido,
el closure verá ese nuevo valor en cada invocación.\n\n\n\n";



echo "60.5.2.1 EJEMPLO\n\n";

echo <<<EJEMPLO_CLOSURE_REFERENCIA
\$contador = 0; // Inicialización de la variable para el ejemplo

// Captura por REFERENCIA por uso de & (AMPERSAND)
\$incrementar = function() use (&\$contador): void {
    \$contador++; // Se suma una unidad a la variable \$contador en el ámbito padre
};

echo "Valor inicial de \\\$contador antes de las ejecuciones de la función anónima: \$contador\\n"; // Salida: 0

\$incrementar(); 
\$incrementar();
\$incrementar();

echo "Valor final: \$contador\\n";  // Salida: 3\n\n
EJEMPLO_CLOSURE_REFERENCIA;

$contador = 0; // Inicialización de la variable para el ejemplo

// Captura por REFERENCIA por uso de & (AMPERSAND)
$incrementar = function() use (&$contador): void {
    $contador++;    // Se suma una unidad a la variable $contador en el ámbito padre
};

echo "Valor inicial de \$contador antes de las ejecuciones de la función anónima: $contador\n"; // Salida: 0

$incrementar(); 
$incrementar();
$incrementar();

echo "Valor final: $contador\n";    // Salida: 3

