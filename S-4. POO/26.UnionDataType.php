<?php
declare(strict_types=1);   // Ejecución de la directiva "strict_types" mediante el constructo "declare" para tipo de datos duro. 

header( "Content-Type: text/plain");

echo "\n25. TIPO DE DATO UNIÓN (PHP 7.4 EN ADELANTE) \n\n\n";

echo "25.1 DEFINICIÓN DE (tipo de dato) UNIÓN\n\n";
echo "En PHP, un tipo de dato unión (union type), agregado en PHP 8.0 
es una declaración de tipo que especifica que 
a) una variable, 
b) un parámetro de función, 
c) un valor de retorno de función o
d) una propiedad de clase 
puede contener valores que pertenecen a uno o más de los tipos de datos listados.\n\n";

echo "En esencia, un tipo de unión es una forma de decir 
\"esta cosa puede ser de este tipo, o de este otro tipo, o de este otro tipo...\".\n\n";

echo "Los tipos de datos válidos en un tipo de dato unión son los siguientes: 
a) Tipos escalares: string, int, float, bool
b) Tipos compuestos: array, object, callable, iterable
c) Tipos especiales: null, nombres de clases, interfaces\n\n\n";

echo "25.2 SINTAXIS DE (tipo de dato) UNIÓN\n\n";
echo "El tipo de dato unión declara utilizando la barra vertical (|) para separar los tipos permitidos de la siguiente forma:\n\n";

echo "<?php
// Tipo de dato union en una variable
datatype1|datatype2|datatypeN \$unaVariableDeTipoUnion;

// Tipo de dato union en una función
function nombreFuncion(datatype1|datatype2|datatypeN \$parametroA) { // Función de tipo unión
    // Código a ejecutar
    return valor; // El valor de retorno debe devolver un valor que coincida con uno de los tipos especificado en la declaración
}

// Tipo de dato union en el valor de retorno de una función
function nombreFuncion(\$parametroA):datatype1|datatype2|datatypeN { // Valor de retorno de tipo unión
    // Código a ejecutar
    return valor; // El valor de retorno debe devolver un valor que coincida con uno de los tipos especificado en la declaración
}
?>\n\n\n";

echo "25.3 ¿QUÉ SUCEDE SI SE COMBINA (el tipo de dato) UNION CON declare(strict_types=1)?\n\n";
echo "La directiva 
<?php
    declare(strict_types=1);
?>
y el tipo de dato unión (datatype1|datatype2|datatypeN) en PHP trabajan en conjunto 
para proporcionar un sistema de tipado robusto y flexible al mismo tiempo dado que, 
por un lado la directiva anula el \"Type Casting\" automático de PHP, 
mientras que el tipo de dato UNION flexibiliza a selectos tipos de dato.\n\n";

echo "<?php
declare(strict_types=1);    // Anulación de la configuración predeterminada de \"type casting\" automático en un archivo PHP
// Tipo de dato union en una variable
int|string \$edad;  // la variable edad puede ser de tipo entero o de tipo cadena
?>\n\n\n";
?>