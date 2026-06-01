<?php
header("Content-Type: text/plain");

echo "56. FUNCIONES DE PRIMERA CLASE \n\n";

echo "56.1 ¿QUÉ ES UNA \"FUNCIÓN DE PRIMERA CLASE\"?\n\n";

echo "Una FUNCIÓN DE PRIMERA CLASE (First-Class Function) es aquella que se trata como cualquier otra variable o valor dentro del lenguaje de programación. 
En esencia, la función no tiene un estatus especial y puede manipularse como lo harías con un entero, una cadena o un objeto.\n\n";

echo "Para ser considerada de primera clase, una función debe cumplir las siguientes condiciones:
    a) Puede ser ASIGNADA a una variable o estructura de datos.
    b) Puede ser PASADA como argumento a otras funciones (generalmente declarado con el pseudotipo callable en PHP).
    c) Puede ser DEVUELTA como valor por otra función.\n\n";

echo "Una función de primera clase individual NO tiene que ejecutar las tres características; 
solo debe ser capaz de ser tratada de esas tres maneras por el lenguaje de programación.
Entonces, se dice que un lenguaje de programación tiene FUNCIONES DE PRIMERA CLASE si permite estas tres operaciones con las funciones.\n\n";

echo "Las reglas de PHP permiten que cualquier función (anónima o con nombre -nombradas-) pueda ser tratada como una función de primera clase, 
ya que cumple con las tres condiciones mencionadas anteriormente.\n\n";

echo "Para clarificar mejor esta temática consideremos el número 5 como un \"entero de primera clase\" ya que el lenguaje le permite: 
a) ASIGNACIÓN: \$x = 5; 
b) PASE COMO ARGUMENTO en otras funciones: repetir(5);
c) DEVOLUCIÓN desde una función: return 5;\n\n";

echo "Entonces, así como el entero 5 es un ejemplo de un tipo de dato de primera clase, 
una función en PHP también es un ejemplo de una función de primera clase,\n\n";

echo "Y así como el número 5 no tiene que hacer todas esas cosas simultáneamente para ser un entero. 
Simplemente TIENE LA CAPACIDAD de ser usado así; una FUNCIÓN DE PRIMERA CLASE en PHP no tiene que 
realizar todos estos usos, pero tiene EL POTENCIAL de ser usado así\n\n\n\n";



echo "56.2 ¿QUÉ RELACIÓN TIENEN LA \"FUNCIONES DE PRIMERA CLASE\" CON LA PROGRAMACIÓN FUNCIONAL?\n\n";

echo "Las FUNCIONES DE PRIMERA CLASE son un requisito fundamental para la Programación Funcional (PF).\n\n";

echo "La capacidad de manipular funciones como datos permite la existencia de las Funciones de Orden Superior (véase 57.FuncionDeOrdenSuperior), 
que son la base de los patrones de PF como map, filter y reduce:
a) Composición: Al poder pasar funciones como argumentos, podemos componer operaciones complejas a partir de funciones simples, que es el objetivo principal de la PF.
b) Abstracción: Permite escribir código más abstracto y flexible, donde la lógica de una función puede ser parametrizada por otras funciones.\n\n\n\n";



echo "56.3 EJEMPLOS (SI, EJEMPLOS) DE FUNCIÓNES DE PRIMERA CLASE\n\n";

echo <<<EJEMPLO_PF_PRIMERA_CLASE
// EJEMPLO 1 DE FUNCIÓN DE PRIMERA CLASE

// a) ASIGNAR la función (anónima) de primera clase a una variable o estructura de datos:
\$saludar = function(string \$nombre): string {
    return "¡Hola, " . \$nombre . "! ";
};

// b) PASAR la variable (que contiene la función de primera clase) como argumento a otra función:
function ejecutarOperacion(callable \$callback, string \$valor): string { // El pseudotipo 'callable' permite que se acepte una variable que almacena una función.
    // Llama a la función que fue pasada como argumento (el callback) y se le pasa la variable tipo string llamada \$valor como argumento
    return \$callback(\$valor); 
}

// EJEMPLO 2 DE FUNCIÓN DE PRIMERA CLASE

// c) DEVOLVER una función como resultado desde otra función (La función padre devuelve la función interna): 
// La función crearDespedida() CREA la función anónima y la DEVUELVE como resultado.
// La invocación de la función anónima ocurre después, cuando llamas a la variable que la recibió: \$despedirseRapido("usuario").
function crearDespedida(string \$mensajeInicial): callable {
    // Retorna una función anónima. El 'use' permite acceder a \$mensajeInicial
    return function(string \$nombre) use (\$mensajeInicial): string {
        return \$mensajeInicial . ", adiós " . \$nombre . ".";
    };
}


// --- EJECUCIÓN ---

// Demostración 1 & 2: Asignación y Pase como Argumento
\$resultadoSaludo = ejecutarOperacion(\$saludar, "Gemini");
echo "\\n\\n1. Resultado del callback de ejecutarOperacion(): " . \$resultadoSaludo . "\\n"; 
// Salida: ¡Hola, Gemini! 


// Demostración 3: Devolver una función
// La función crearDespedida() CREA la función anónima y la DEVUELVE como resultado.
\$despedirseRapido = crearDespedida("Nos vemos");

// La variable \$despedirseRapido AHORA es una función y se puede invocar
// La invocación de la función anónima ocurre cuando llamas a la variable que la recibió: \$despedirseRapido("usuario").
\$resultadoDespedida = \$despedirseRapido("usuario");
echo "2. Resultado de la función devuelta: " . \$resultadoDespedida . "\\n";  // Salida: Nos vemos, adiós usuario.
EJEMPLO_PF_PRIMERA_CLASE;


// EJEMPLO 1 DE FUNCIÓN DE PRIMERA CLASE

// a) ASIGNAR la función (anónima) de primera clase a una variable o estructura de datos:
$saludar = function(string $nombre): string {
    return "¡Hola, desde una función anónima, " . $nombre . "! ";
};

// b) PASAR la variable (que contiene la función de primera clase) como argumento a otra función:
function ejecutarOperacion(callable $callback, string $valor): string { // El pseudotipo 'callable' delimita que tiene que aceptarse una variable que almacena una función.
    // Llama a la función que fue pasada como argumento (el callback) y se le pasa la variable tipo string llamada $valor como argumento
    return $callback($valor); 
}

// EXTRA: Función nombrada de ejemplo para pasar como callback en ejecutarOperacion()
function saludarUsuario(string $nombre): string {
    return "¡Hola, desde una función nombrada, " . $nombre . "! ";
}

// EJEMPLO 2 DE FUNCIÓN DE PRIMERA CLASE

// c) DEVOLVER una función como resultado desde otra función (La función padre devuelve la función interna): 
// La función crearDespedida() CREA la función anónima y la DEVUELVE como resultado.
// La invocación de la función anónima ocurre después, cuando llamas a la variable que la recibió: $despedirseRapido("usuario").
function crearDespedida(string $mensajeInicial): callable {
    // Retorna una función anónima. El 'use' permite acceder a $mensajeInicial
    return function(string $nombre) use ($mensajeInicial): string {
        return $mensajeInicial . ", adiós " . $nombre . ".";
    };
}


// --- EJECUCIÓN ---

// Demostración 1 & 2: Asignación y Pase como Argumento
$resultadoSaludo = ejecutarOperacion("saludarUsuario", "Gemini");   // Cambia el valor del callback a: 
                                                                                        // a) la función anónima almacenada en $saludar
                                                                                        // b) la función nombrada saludarUsuario() utilizando comillas "saludarUsuario"
echo "\n\n1. Resultado del callback de ejecutarOperacion(): " . $resultadoSaludo . "\n"; 
// Salida: ¡Hola, Gemini! 


// Demostración 3: Devolver una función
// La función crearDespedida() CREA la función anónima y la DEVUELVE como resultado.
$despedirseRapido = crearDespedida("Nos vemos");

// La variable $despedirseRapido AHORA es una función y se puede invocar
// La invocación de la función anónima ocurre cuando llamas a la variable que la recibió: $despedirseRapido("usuario").
$resultadoDespedida = $despedirseRapido("usuario");
echo "2. Resultado de la función devuelta: " . $resultadoDespedida . "\n";  // Salida: Nos vemos, adiós usuario.
