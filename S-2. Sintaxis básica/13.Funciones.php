<?php
header("Content-Type: text/plain");

echo "\n13. FUNCIONES\n\n";

echo "13.1 DEFINICIÓN DE FUNCIONES\n\n";

echo "Una función es un bloque de código que se puede reutilizar en diferentes partes de un programa
y que realiza una tarea (función) específica.\n\n"; 

echo "Las funciones permiten: 
a) organizar el código, 
b) mejorar la legibilidad, 
c) mantener el código modular, 
d) facilitar la depuración 
e) evitar la repetición de código ya que una misma función se puede reutilizar en distintas partes del código.\n\n";

echo "Las funciones pueden: 
a) O recibir parámetros (datos de entrada)
b) O devolver un valor (resultado de la función)
c) O recibir parámetros (datos de entrada) y devolver un valor (resultado de la función)
d) O NO recibir parámetros, NI devolver valor alguno.\n\n";

echo "Las funciones pueden ser definidas en cualquier parte del código, 
pero es recomendable definirlas al inicio del archivo o antes de su uso
dado que PHP va ejecutando de arriba a abajo y de izquierda a derecha.
Esto ayuda a mantener el código organizado y facilita la lectura.\n\n\n\n";



echo "13.2 SINTAXIS\n\n"; 

echo "La sintaxis general para declarar una función es la siguiente:\n\n";
echo "<?php
// Sintaxis general de declaración de una función con tipo de dato en parametros y tipo de dato en el valor de retorno:
function nombreFuncion(datatype \$parametroA, datatype \$parametroB, datatype \$parametroN): datatypeRetorno {  // Los parámetros son opcionales 
    // Cuerpo de la función con código a ejecutar
    return \$valor;   // El valor de retorno es opcional
}
?>\n\n";

echo "En esta sintaxis:
- nombreFuncion: Es el nombre que le das a la función. 
Debe seguir las reglas de nomenclatura de PHP 
(comenzar con una letra o guion bajo, seguido de letras, números o guiones bajos).
- \$parametroA, \$parametroB, \$parametroN: Son los parámetros que la función puede recibir.
Pueden ser de cualquier tipo de dato (int, string, array, etc.) y son opcionales, 
lo que significa que una función puede no tener parámetros.
- : datatypeRetorno: Es el tipo de dato que la función devolverá como resultado.
Es opcional, lo que significa que una función puede no devolver ningún valor (en cuyo caso se considera que devuelve null).
- Cuerpo de la función: Es el bloque de código que se ejecutará cuando se llame a la función. 
Aquí es donde defines la lógica de lo que quieres que haga la función.
- return valor: Es la instrucción que devuelve un valor al lugar donde se llamó a la función. 
Es opcional, lo que significa que una función puede no devolver ningún valor
(en cuyo caso se considera que devuelve null).\n\n";

echo "El valor de retorno de una función es el resultado que la función devuelve después de ejecutar su código.
Puede ser de cualquier tipo de dato (int, string, array, etc.)
o incluso otra función (en el caso de funciones anónimas o funciones de orden superior).
El valor de retorno es útil para obtener resultados de una función 
y utilizarlos en otras partes del código, lo que permite crear programas más dinámicos y flexibles.\n\n";

echo "El valor de retorno es opcional, pero se recomienda usarlo para:
    a) reutilizar el valor devuelto en otras partes del código, 
    b) facilitar la creación de código modular y bien organizado,
    c) simplificar la realización de pruebas unitarias (ya que se puede evaluar el valor devuelto por la función)
    d) combinar funciones para crear operaciones más complejas
    e) mejora la legibilidad del código al separar la lógica del cálculo de la lógica de manipulación de datos.\n\n";

echo "Enseguida, veremos ejemplos de funciones con diferentes combinaciones de parámetros y valores de retorno para ilustrar estos conceptos.\n\n\n"; 


echo "13.2.1 SINTAXIS DE UNA FUNCIÓN SIN PARÁMETROS Y SIN VALOR DE RETORNO\n\n"; 

echo "<?php
//Ejemplo de función sin parámetros y sin valor de retorno:
function saludar1(): void {   // La función no recibe ningún parámetro y no devuelve ningún valor (void)
    echo \"¡Hola, soy Ricardo García! ¡Bienvenido a la función saludar1() sin parámetros y sin valor de retorno!\\n\";
}

saludar1(); // Llamada a la función\n\n\n";


echo "13.2.2 SINTAXIS DE UNA FUNCIÓN SIN PARÁMETROS Y CON VALOR DE RETORNO\n\n"; 

echo "<?php
//Ejemplo de función sin parámetros y con valor de retorno:
function saludar2(): string {   // La función devuelve un valor de tipo string
    return \"¡Hola, soy Ricardo García! ¡Bienvenido a la función saludar2() sin parámetros y con valor de retorno!\\n\";
}
\$unaVariable = saludar2(); // Llamada a la función saludar2() sin parámetros y con valor de retorno, pero no se hace nada con el valor devuelto
echo \$unaVariable; // Impresión de la variable que almacena el valor de retorno\n\n\n";


echo "13.2.3 SINTAXIS DE UNA FUNCIÓN CON PARÁMETROS Y SIN VALOR DE RETORNO\n\n"; 

echo "<?php
//Ejemplo de función con parámetros y sin valor de retorno:
function saludar3(\$nombre, \$apellido): void {   // La función recibe dos parámetros de tipo string y no devuelve ningún valor (void)
    echo \"¡Hola, soy \$nombre \$apellido! ¡Bienvenido a la función saludar3() con parámetros y sin valor de retorno!\\n\";
}

saludar3(\"Ricardo\", \"García\"); // Llamada a la función\n\n\n";


echo "13.2.4 SINTAXIS DE UNA FUNCIÓN CON PARÁMETROS Y CON VALOR DE RETORNO\n\n"; 

echo "<?php
//Ejemplo de función con parámetros y con valor de retorno:
function saludar4(\$nombre, \$apellido): string {   // La función devuelve un valor de tipo string
    return \"Hola, soy \$nombre \$apellido! ¡Bienvenido a la función saludar4() con parámetros y con valor de retorno!\\n\";
}

saludar4(\"Ricardo\", \"García\"); // Llamada a la función con parámetros\n\n\n\n";



echo "13.3 FUNCIONES CON PARÁMETROS OPCIONALES\n\n";

echo "Las funciones también pueden tener parámetros opcionales, 
lo que significa que no es necesario pasarlos al llamar a la función.
Si no se pasan, se utilizarán valores predeterminados.\n\n\n";


echo "13.3.1 SINTAXIS DE UNA FUNCIÓN CON PARÁMETROS OPCIONALES\n\n"; 

echo "<?php
//Ejemplo de función con parámetros opcionales:
function saludar5(\$nombre = \"invitado\") {
    return \"Hola, \$nombre!\ ¡Bienvenido a la función saludar5() con parámetros opcionales!\\n\";
}
\$saludo = saludar5(); // Llamada a la función sin parámetros 
\$saludo = saludar5(\"Juan\"); // Llamada a la función con un parámetro\n\n";

echo "En este ejemplo, la función saludar5() tiene un parámetro opcional \$nombre con un valor predeterminado de \"invitado\".
Si no se pasa un valor al llamar a la función, se utilizará el valor predeterminado.
Si se pasa un valor, se utilizará ese valor en su lugar.\n\n\n\n";



echo "13.4 FUNCIONES CON TIPO DE RETORNO NULLABLE (Nullable Return Type)\n\n";

echo "Las funciones también pueden tener un TIPO DE RETORNO NULLABLE, 
lo que significa que pueden devolver un valor del tipo no especificado o null.\n\n";

echo "Un TIPO DE RETORNO NULLABLE se indica con un signo de interrogación (?) 
antes del tipo de dato en la declaración de la función.
Esto es útil para indicar que una función puede 
no devolver un valor válido en ciertas circunstancias, 
y en su lugar devolver null para indicar la ausencia de un valor.\n\n";

echo "Cuando una función tiene un TIPO DE RETORNO NULLABLE,
puede devolver un valor del tipo especificado o null. 
Esto es útil para manejar casos en los que la función no puede generar un resultado válido,
como cuando se produce un error que colapsaría el programa 
o cuando no se encuentra un valor esperado.\n\n";

echo "En resumen, las funciones con TIPO DE RETORNO NULLABLE
son una herramienta útil para manejar situaciones en las que una función
puede no ser capaz de devolver un valor válido, 
y permiten a los desarrolladores escribir código más robusto y manejable 
al anticipar y manejar casos de error o ausencia de datos de manera más clara y explícita.\n\n\n";


echo "13.4.1 SINTAXIS DE UNA FUNCIÓN CON TIPO DE RETORNO NULLABLE (Nullable Return Type)\n\n"; 

echo "<?php
//Ejemplo de función con tipo de retorno nullable:
function saludar6(?string \$nombre): ?string {   // La función puede recibir un parámetro de tipo string o null, y puede devolver un valor de tipo string o null
    return \$nombre ? \"Hola, \$nombre! ¡Bienvenido a la función saludar6() con TIPO DE RETORNO NULLABLE!\\n\" : null;   // Devuelve un saludo si el nombre no es null, de lo contrario devuelve null
}
\$resultadoNull = saludar6(null); // Llamada a la función con null
echo \"Resultado con null: \" . (\$resultadoNull === null ? \"VALOR NULO DETECTADO en la función saludar6() con TIPO DE RETORNO NULLABLE!\\n\" : \$resultadoNull) . \"\\n\";
\$resultadoNull = saludar6(\"Ricardo\"); // Llamada a la función con un nombre
echo \"Resultado con un nombre: \" . (\$resultadoNull === null ? \"VALOR NULO DETECTADO en la función saludar6() con TIPO DE RETORNO NULLABLE!\\n\" : \$resultadoNull) . \"\\n\n\n\n\n";



echo "13.5 TIPOS DE FUNCIONES\n\n"; 

echo "13.5.1 FUNCIONES RECURSIVAS\n\n";

echo "Las funciones también pueden ser recursivas, es decir, una función puede llamarse a sí misma.
Esto es útil para resolver problemas que pueden dividirse en subproblemas más pequeños.\n\n\n";

echo "<?php
//Ejemplo de función recursiva:
function factorial(\$n) {
    if (\$n <= 1) {
        return 1; // Caso base
    } else {
        return \$n * factorial(\$n - 1); // Llamada recursiva
    }
}
\$resultado = factorial(5); // Llamada a la función recursiva
// Impresión del resultado
echo \"El factorial de 5 es: \$resultado\\n\\n\";
?>\n\n";

echo "En este ejemplo, la función factorial() calcula el factorial de un número utilizando recursión.
La función se llama a sí misma hasta que se alcanza el caso base (cuando \$n es menor o igual a 1).\n\n\n\n";



echo "13.5.2 FUNCIONES ANIDADAS\n\n";

echo "También las funciones pueden ser anidadas, 
es decir, una función puede llamar a otra función dentro de su bloque de código.\n\n";

echo "<?php
//Ejemplo de función anidada:
//Función 1
function multiplicar(float \$a, float \$b): float {    // Requiere dos parámetros de tipo float y devuelve un valor de tipo float 
    return \$a * \$b;   // Retorna el resultado de la multiplicación de dos números
}
//Función 2 que contiene a la Función 1
function calcularArea(float \$base, float \$altura): float {   // Requiere dos parámetros de tipo float y devuelve un valor de tipo float
    return multiplicar(\$base, \$altura); // Invocación de la función multiplicar
}
\$area = calcularArea(5, 10);   // Llamada a la función calcularArea
echo \"El área es: \$area\\n\\n\";    // Impresión en consola del área
// ?>\n\n";

echo "En este ejemplo, la función calcularArea llama a la función multiplicar para calcular el área de un rectángulo.
El resultado se almacena en la variable \$area y luego se imprime.\n\n\n\n";



echo "13.5.3 FUNCIONES ANÓNIMAS\n\n";

echo "Las funciones también pueden ser anónimas, es decir, no tienen un nombre específico.
Estas funciones son útiles para crear funciones de una sola vez o para pasar como argumentos a otras funciones.\n\n";

echo "<?php
// Ejemplo de función anónima:
\$suma = function(\$a, \$b) {
    return \$a + \$b;
};
\$resultado = \$suma(5, 10); // Llamada a la función anónima
echo \"El resultado de la suma es: \$resultado\"; // Impresión del resultado
?>\n\n";

echo "En este ejemplo, se define una función anónima que realiza la suma de dos números.
La función se asigna a la variable \$suma y luego se llama utilizando esa variable.\n\n";
echo "Las funciones anónimas son útiles para crear funciones de una sola vez o para pasar como argumentos a otras funciones.\n\n\n";


echo "13.5.3.1 RECURSIVIDAD EN FUNCIONES ANÓNIMAS\n\n";

echo "Las funciones también pueden ser recursivas, es decir, una función puede llamarse a sí misma.
Esto es útil para resolver problemas que pueden dividirse en subproblemas más pequeños.\n\n";

echo "<?php
// Ejemplo de función anónima recursiva:
\$factorial = function(\$n) use (&\$factorial) { // <--- Aquí importamos la propia variable por referencia
    if (\$n <= 1) {
        return 1; // Caso base
    } else {
        // Ahora \$factorial ya es reconocida aquí adentro
        return \$n * \$factorial(\$n - 1); 
    }
};
\$resultado = \$factorial(5); // Llamada a la función anónima recursiva
echo \"El factorial de 5 es: \$resultado\\n\\n\"; // Impresión del resultado
?>\n\n";

echo "En este ejemplo, se define una función anónima recursiva para calcular el factorial de un número.
La función se asigna a la variable \$factorial y luego se llama utilizando esa variable. 
Para permitir la recursividad, se utiliza la palabra clave use para importar la variable \$factorial por referencia dentro de la función anónima.\n\n\n\n";


echo "13.5.3.1 FUNCIONES FLECHA\n\n";

echo "Las FUNCIONES FLECHA son una forma más concisa de escribir FUNCIONES ANÓNIMAS en PHP.
Se introdujeron en PHP 7.4 y utilizan la sintaxis de flecha (=>) para definir funciones de una sola expresión.\n\n";


echo "13.6 RESUMEN DE FUNCIONES\n\n";

echo "En resumen, las funciones son bloques de código reutilizables que pueden recibir parámetros y devolver valores.
Pueden ser definidas en cualquier parte del código, pero es recomendable definirlas al inicio del
archivo o antes de su uso para mantener el código organizado y facilitar la lectura.
Las funciones pueden ser anidadas, anónimas o recursivas, lo que las hace herramientas poderosas para resolver una amplia variedad de problemas en la programación.\n\n\n\n";

echo "EJECUCIÓN DE FUNCIONES\n\n";
//Ejemplo de función sin parámetros y sin valor de retorno:
function saludar1(): void {   // La función no recibe ningún parámetro y no devuelve ningún valor (void)
    echo "¡Hola, soy Ricardo García! ¡Bienvenido a la función saludar1() sin parámetros y sin valor de retorno!\n";
}
saludar1(); // Llamada a la función saludar1() sin parámetros y sin valor de retorno


//Ejemplo de función sin parámetros y con valor de retorno:
function saludar2(): string {   // La función devuelve un valor de tipo string
    return "¡Hola, soy Ricardo García! ¡Bienvenido a la función saludar2() sin parámetros y con valor de retorno!\n";
}
$unaVariable = saludar2(); // Llamada a la función saludar2() sin parámetros y con valor de retorno, pero no se hace nada con el valor devuelto
echo $unaVariable; // Impresión de la variable que almacena el valor de retorno

//Ejemplo de función con parámetros y sin valor de retorno:
function saludar3($nombre, $apellido): void {   // La función recibe dos parámetros de tipo string y no devuelve ningún valor (void)
    echo "¡Hola, soy $nombre $apellido! ¡Bienvenido a la función saludar3() con parámetros y sin valor de retorno!\n";
}
saludar3("Ricardo", "García"); // Llamada a la función saludar3() con parámetros y sin valor de retorno

//Ejemplo de función con parámetros y con valor de retorno:
function saludar4($nombre, $apellido): string {   // La función devuelve un valor de tipo string
    return "¡Hola, soy $nombre $apellido! ¡Bienvenido a la función saludar4() con parámetros y con valor de retorno!\n";
}
$unaVariable = saludar4("Ricardo", "García"); // Llamada a la función saludar4() con parámetros y con valor de retorno
echo $unaVariable; // Imprime el saludo devuelto por la función saludar4()

//Ejemplo de función con parámetros opcionales:
function saludar5($nombre = "invitado") {
    return "Hola, $nombre! ¡Bienvenido a la función saludar5() con parámetros opcionales!\n";
}
$saludo = saludar5(); // Llamada a la función saludar5() sin parámetros, se utiliza el valor predeterminado
echo "El saludo sin pasar un nombre es: " . ($saludo); // Imprime el saludo con el valor predeterminado
$saludo = saludar5("Juan"); // Llamada a la función saludar5() con un parámetro, se utiliza el valor pasado
echo "Ahora el saludo con un valor (Juan) es: " . ($saludo); // Imprime el saludo con el valor pasado

//Ejemplo de función con tipo de retorno nullable:
function saludar6(?string $nombre): ?string {   // La función puede recibir un parámetro de tipo string o null, y puede devolver un valor de tipo string o null
    return $nombre ? "Hola, $nombre! ¡Bienvenido a la función saludar6() con TIPO DE RETORNO NULLABLE!\n" : null;   // Operador condicional ternario (véase 9.Operadores.php si ya no recuerdas qué es)
}
$resultadoNull = saludar6(null); // Llamada a la función con null
echo "Resultado con null: " . ($resultadoNull === null ? "VALOR NULO DETECTADO en la función saludar6() con TIPO DE RETORNO NULLABLE!\n" : $resultadoNull);
$resultadoNull = saludar6("Ricardo"); // Llamada a la función con un nombre
echo "Resultado con un nombre: " . ($resultadoNull === null ? "VALOR NULO DETECTADO en la función saludar6() con TIPO DE RETORNO NULLABLE!\n" : $resultadoNull);

echo "\nEJECUCIÓN DE DIFERENTES TIPOS DE FUNCIONES\n\n";

//Ejemplo de función recursiva:
function factorial($n) {
    if ($n <= 1) {
        return 1; // Caso base
    } else {
        return $n * factorial($n - 1); // Llamada recursiva
    }
}
$resultado = factorial(5); // Llamada a la función recursiva
// Impresión del resultado
echo "El factorial de 5 es: $resultado (función recursiva)\n\n";


//Ejemplo de función anidada:
//Función 1
function multiplicar(float $a, float $b): float {    // Requiere dos parámetros de tipo float y devuelve un valor de tipo float 
    return $a * $b;   // Retorna el resultado de la multiplicación de dos números
}
//Función 2 que contiene a la Función 1
function calcularArea(float $base, float $altura): float {   // Requiere dos parámetros de tipo float y devuelve un valor de tipo float
    return multiplicar($base, $altura); // Invocación de la función multiplicar
}
$area = calcularArea(5, 10);   // Llamada a la función calcularArea
echo "El área es: $area (función anidada)\n\n";    // Impresión en consola del área


// Ejemplo de función anónima:
$suma = function($a, $b) {
    return $a + $b;
};
$resultado = $suma(5, 10); // Llamada a la función anónima
echo "El resultado de la suma es: $resultado (función anónima)\n\n"; // Impresión del resultado


// Ejemplo de función anónima recursiva:
$factorial = function($n) use (&$factorial) { // <--- Aquí importamos la propia variable por referencia
    if ($n <= 1) {
        return 1; // Caso base
    } else {
        // Ahora $factorial ya es reconocida aquí adentro
        return $n * $factorial($n - 1); 
    }
};

$resultado = $factorial(5); 
echo "El factorial de 5 es: $resultado (función anónima recursiva)\n\n";

echo "En este ejemplo, se muestran diferentes tipos de funciones con combinaciones de parámetros y valores de retorno.
Se incluyen funciones sin parámetros, con parámetros opcionales, con valores de retorno y con tipos de
retorno nullable, lo que ilustra la flexibilidad y utilidad de las funciones en PHP para organizar y reutilizar código de manera eficiente.\n\n\n\n";
