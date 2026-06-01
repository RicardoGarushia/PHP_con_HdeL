<?php
header("Content-Type: text/plain");

echo "\n5. TIPOS DE DATOS BÁSICOS EN PHP\n\n";

echo "En PHP (y en la programación en general), 
un tipo de dato o data type es una clasificación que especifica el tipo de valor que una variable puede contener 
y los tipos de operaciones que se pueden realizar con esos valores.\n\n";

echo "En PHP los tipos de datos se dividen entre categorías: 
a) Tipos Escalares (básicos o primitivos). Estos tipos almacenan un único valor. Y son los que se abordan en este archivo.
b) Tipos Compuestos. Estos tipos pueden contener múltiples valores como los array, object, callable e iterable. 
c) Tipos Especiales. Son especiales como resource, null, void, mixed, static, union e intersección.";

echo "En PHP los tipos de datos escalares, básicos o primitivos son los siguientes:
1. String (cadena): Es una secuencia de carácteres.
2. Integer (entero): Es número entero (sin punto decimal).
3. Float (punto flotante): Es número decimal (con punto decimal).
4. Boolean (booleano): Solo puede tomar el valor \"true\" o \"false\".
Un tipo de dato especial es: 
5. Null (nulo): Indica la ausencia de valor. \n\n";

echo "Existen otros tipos de datos compuestos como array (arreglo) u object (objeto). Pero se verán más adelante.\n\n\n";


echo "5.1 FUNCIONES PARA OBTENER TIPO DE DATO\n";
echo "Básicamente son dos:
a) gettype(): Devuelve mediante un string (cadena) el tipo de dato de una variable. 
Es útil para obtener rápidamente el tipo de una variable.
b) var_dump(): Manda información directamente al buffer de salida 
que muestra información detallada sobre una o más variables, incluyendo su tipo y valor.
Dado que NO devuelve un tipo de dato que se pueda utilizar directamente en una concatenación mediante echo, 
su información se \"imprime\" de inmediato.\n\n";

echo "Analicemos ambas funciones con una variable que almacena un nombre. 
La variable declarada e inicializada es la siguiente:\n\n";

echo "<?php
// Se inicializa la variable \$nombre con el valor \"Ricardo García López\"
\$nombre = \"Ricardo García López\";
echo \"Ejemplo de INICIALIZACIÓN de variable:\\n\";
echo \"El valor que brinda gettype(\\\$nombre) es: . gettype(\$nombre) \";
echo \"\\nEl valor que brinda var_dump(\$nombre) es: \";
var_dump(\$nombre);
?>\n\n";


// Se inicializa la variable $nombre con el valor "Ricardo García López"
$nombre = "Ricardo García López";
echo "Ejemplo de INICIALIZACIÓN de variable:\n";
echo "El valor que brinda gettype(\$nombre) es: " . gettype($nombre);
echo "\nEl valor que brinda var_dump(\$nombre) es: ";
var_dump($nombre);


echo "\nComo se observa, la función var_dump(\$nombre) proporciona información detallada 
y es esencial para depurar problemas complejos. Por otro lado, la función gettype()
solo devuelve el tipo de dato de la variable,
lo que puede ser útil para verificar el tipo de dato de una variable en un momento específico.\n\n\n";


echo "5.2 DECLARACIÓN DE TIPO DE DATO EN FUNCIONES Y PROPIEDADES DE CLASES (PHP 7.4 EN ADELANTE) \n";
echo "En PHP 7.4 se introdujo la declaración de tipo de dato en las funciones y propiedades de clases.
Esto significa que puedes especificar el tipo de dato que una función debe recibir como argumento 
o el tipo de dato que una propiedad de clase debe contener.
Esto ayuda a garantizar que los datos sean del tipo esperado y mejora la legibilidad del código.\n\n\n";

echo "5.2.1 Declaración de tipo de dato en funciones (como parámetro y valor de retorno) con sintaxis abstracta:\n";
echo "<?php
// Ejemplo de declaración de tipo de dato en una función en parametros y en retorno de tipo de dato:
function nombreFuncion(datatype \$parametroA, datatype \$parametroB, datatype \$parametroN): datatype {
    // Cuerpo de la función con código a ejecutar
    return valor;
}
?>\n\n";

echo "5.2.2 Declaración de tipo de dato en funciones (como parámetro y valor de retorno) con ejemplo concreto:\n";
echo "<?php
// Ejemplo de declaración de tipo de dato en una función como parámetro y como valor de retorno:
function sumar(int \$numeroA, int \$numeroB): int {
    return \$numeroA + \$numeroB;
}
echo \"El resultado de la suma es: \" . \$resultado = sumar(5, 6);
?>";

// Ejemplo de declaración de tipo de dato en una función como parámetro y como valor de retorno:
function sumar(int $numeroA, int $numeroB): int {
    return $numeroA + $numeroB;
}
echo "El resultado de la suma es: " . $resultado = sumar(5, 6);

echo "\nEn este ejemplo, la función sumar espera dos argumentos de tipo entero y devuelve un valor de tipo entero.\n\n\n";


echo "5.2.2 Ejemplo de declaración de tipo de dato en una propiedad de clase:\n";
echo "<?php
// Ejemplo de declaración de tipo de dato en una propiedad de clase:
class Persona {
    public string \$nombre; // Tipo de dato cadena
    public int \$edad;  // Tipo de dato entero
}
?>\n\n";

// Ejemplo de declaración de tipo de dato en una propiedad de clase:
class Persona {
    public string $nombre;
    public int $edad;
}

echo "En este ejemplo, la clase Persona tiene dos propiedades: nombre de tipo string (cadena) y edad de tipo int (entero).\n\n";

echo "Esto ayuda a garantizar que las propiedades de la clase contengan los tipos de datos correctos 
y mejora la legibilidad del código.\n\n\n";


echo "5.3 CONVERSIÓN DE TIPO (TYPE CASTING, O \"CASQUEO\") DE VARIABLES\n\n";
echo "La conversión de tipo (\"casqueo\") de variables es el proceso de convertir una variable de un tipo de dato a otro.
Esto puede ser útil cuando necesitas realizar operaciones con diferentes tipos de datos 
o cuando deseas asegurarte de que una variable tenga un tipo específico antes de usarla.\n\n";

echo "Existen dos tipos de \"casqueo\":
1. \"Casqueo\" automático: PHP realiza automáticamente el \"casqueo\" de variables cuando es necesario.
2. \"Casqueo\" manual: Puedes utilizar funciones específicas para convertir una variable de un tipo a otro.\n\n\n";

echo "5.3.1 EJEMPLO DE \"CASQUEO\" AUTOMÁTICO DE VARIABLES\n\n";
echo "<?php
// Ejemplo de \"casqueo\" AUTOMÁTICO:
echo \"Ejemplo de \\\"casqueo\\\" AUTOMÁTICO:\\n\";
\$numeroCadena = \"10\"; // Inicialización de variable de tipo string (cadena)
echo \"El valor de \\\$numeroCadena es: \$numeroCadena\"; // Imprime el valor de la variable \$numeroCadena
echo \"El tipo de dato de \\\$numeroCadena es: \" . gettype(\$numeroCadena); // Imprime el tipo de dato de \"numeroCadena\" que es \"string\"
\$resultado = \$numeroCadena + 5; // PHP convierte automáticamente \$numeroCadena a entero para realizar la suma
echo \"El valor de \\\$resultado, tras conversión automática (\$resultado = \$numeroCadena + 5), es: \$resultado; // Imprime el valor de 15
echo \"El tipo de dato de \\\$resultado es: \" . gettype(\$resultado); // Imprime el tipo de dato de \"resultado\" que es \"integer\"
echo \"El tipo de dato de \\\$numeroCadena es: \" . gettype(\$numeroCadena); // Imprime el tipo de dato de \"numeroCadena\" que es \"string\"// 
?>\n\n";

// Ejemplo de "casqueo" AUTOMÁTICO:";
echo "Ejemplo de \"casqueo\" AUTOMÁTICO:\n";
$numeroCadena = "10"; // Inicialización de ariable de tipo string (cadena)
echo "\nEl valor de \$numeroCadena es: $numeroCadena"; // Imprime el valor de la variable $numeroCadena 
echo "\nEl tipo de dato de \$numeroCadena es: " . gettype($numeroCadena); // Imprime el tipo de dato de "numeroCadena" que es "string"
$resultado = $numeroCadena + 5; // PHP convierte automáticamente $numeroCadena a entero para realizar la suma
echo "\nEl valor de \$resultado, tras conversión automática (\$resultado = \$numeroCadena + 5), es: $resultado"; // Imprime el valor de 15
echo "\nEl tipo de dato de \$resultado es: " . gettype($resultado); // Imprime el tipo de dato de "resultado" que es "integer"
echo "\nEl tipo de dato de \$numeroCadena es: " . gettype($numeroCadena); // Imprime el tipo de dato de "numeroCadena" que es "string"


echo "\n\n\n5.3.2 \"CASQUEO\" MANUAL DE VARIABLES\n\n";
echo "Por otro lado, puedes hacer \"casqueo\" manual utilizando:
a) Operadores
b) Funciones\n\n\n";

echo "5.3.2.1 OPERADORES DE \"CASQUEO\" MANUAL DE VARIABLES\n\n";
echo "Los siguientes son OPERADORES de \"casqueo\": 
(int) o (integer): Convierte a entero.
(float) o (double) o (real): Convierte a número de punto flotante.
(string): Convierte a cadena.
(bool) o (boolean): Convierte a booleano.
(array): Convierte a arreglo.
(object): Convierte a objeto.
(unset): Convierte a NULL (PHP 5).\n\n\n";

echo "5.3.2.1.1 EJEMPLO DE \"CASTING\" (\"CASQUEO\") MANUAL CON OPERADORES\n\n";
echo "<?php
// Ejemplo de \"casqueo\" manual utilizando OPERADORES:
echo \"Ejemplo de \\\"casqueo\\\" manual utilizando OPERADORES:\\n\";
\$numero = \"10\"; // Variable de tipo string (cadena)
\$numeroFlotante = (float) \$numero; // \"Casqueo\" a flotante e inicializa la variable \$numeroFlotante
echo \"El valor de \\\$numero es: \$numero\\n\"; // Imprime \"10\"
echo \"El tipo de dato de \\\$numero es: \" . gettype(\$numero); // Imprime el tipo de dato \"string\"
echo \"\\nEl valor de \\\$numeroFlotante es: \$numeroFlotante // Imprime 10
echo \"El tipo de dato de \\\$numeroFlotante es: \" . gettype(\$numeroFlotante); // Imprime el tipo de dato \"float\"
?>\n\n";

// Ejemplo de "casqueo" manual con OPERADORES:
echo "Ejemplo de \"casqueo\" manual utilizando OPERADORES:\n";
$numero = "10"; // Variable de tipo string (cadena)
$numeroFlotante = (float) $numero; // "Casqueo" a flotante e inicializa la variable \$numeroFlotante
echo "El valor de \$numero es: $numero\n"; // Imprime "10"
echo "El tipo de dato de \$numero es: " . gettype($numero); // Imprime el tipo de dato "string"
echo "\nEl valor de \$numeroFlotante es: $numeroFlotante\n"; // Imprime 10
echo "El tipo de dato de \$numeroFlotante es: " . gettype($numeroFlotante); // Imprime el tipo de dato "float"


echo "\n\nEn este ejemplo, la variable \$numero es un string que contiene un cadena.
Al aplicar el \"casqueo\" manual (int) a \$numero se convierte en un entero y se almacena en la variable \$numeroEntero.\n\n\n";

echo "5.3.2.2 FUNCIONES DE \"CASQUEO\" MANUAL DE VARIABLES\n\n";
echo "Las siguientes son FUNCIONES de \"casqueo\" manual: 
intval(): Convierte a entero.
floatval(): Convierte a número de punto flotante.
strval(): Convierte a cadena.
boolval(): Convierte a booleano.
(array): Convierte a array.
(object): Convierte a objeto.
para realizar el \"casqueo\" manual de variables.\n\n\n";

echo "5.3.2.2.1 EJEMPLO DE \"CASQUEO\" MANUAL CON FUNCIONES\n\n";
echo "<?php
// Ejemplo de \\\"casqueo\\\" manual utilizando FUNCIONES:
echo \"Ejemplo de \\\"casqueo\\\" manual utilizando FUNCIONES:\\n\";
\$edadNumero = 18; // Variable de tipo int (entero)
\$edadCadena = strval(\$edadNumero); // Casqueo por función a string (cadena)
echo \"El valor de \\\$edadNumero es: \$edadNumero // Imprime 18
echo \"El tipo de dato de \\\$edadNumero es: \" . gettype(\$edadNumero); // Imprime el tipo de dato \"int\"
echo \"El valor de \\\$edadCadena es: \$edadCadena\\n\"; // Imprime \"18\"
echo \"El tipo de dato de \\\$edadCadena es: . gettype(\$edadCadena); // Imprime el tipo de dato \"string\"
?>\n\n";

// Ejemplo de "casqueo" manual utilizando FUNCIONES:
echo "Ejemplo de \"casqueo\" manual utilizando FUNCIONES:\n";
$edadNumero = 18; // Variable de tipo int (entero)
$edadCadena = strval($edadNumero); // Casqueo por función a string (cadena)
echo "El valor de \$edadNumero es: $edadNumero\n"; // Imprime 18
echo "El tipo de dato de \$edadNumero es: " . gettype($edadNumero); // Imprime el tipo de dato "int"
echo "El valor de \$edadCadena es: $edadCadena\n"; // Imprime "18"
echo "El tipo de dato de \$edadCadena es: " . gettype($edadCadena); // Imprime el tipo de dato "string"
?>