<?php
header("Content-Type: text/plain");

echo "\n14. FUNCIONES PREEXISTENTES EN PHP\n\n";
echo "Las funciones preexistentes son aquellas que ya están definidas en el lenguaje PHP 
y que podemos utilizar directamente sin necesidad de definirlas nosotros mismos.\n\n";

echo "PHP cuenta con una amplia variedad de funciones preexistentes 
que nos permiten realizar tareas comunes de manera sencilla y eficiente.\n\n";

echo "Estas funciones están organizadas en diferentes categorías, 
como funciones de cadena, funciones matemáticas, funciones de fecha y hora, 
funciones de manejo de archivos, entre otras.\n\n";

echo "A continuación, se presentan algunos ejemplos de funciones preexistentes en PHP:\n\n";

echo "1. Funciones de cadena:\n";
echo "strlen(\$cadena): Devuelve la longitud de una cadena.\n";
echo "strtoupper(\$cadena): Convierte una cadena a mayúsculas.\n";
echo "strtolower(\$cadena): Convierte una cadena a minúsculas.\n";
echo "strpos(\$cadena, \$subcadena): Devuelve la posición de la primera aparición de una subcadena en una cadena.\n";
echo "substr(\$cadena, \$inicio, \$longitud): Devuelve una parte de una cadena a partir de una posición específica y con una longitud determinada.\n";
echo "trim(\$cadena): Elimina los espacios en blanco al inicio y al final de una cadena.\n\n\n";

echo "2. Funciones matemáticas:\n";
echo "abs(\$numero): Devuelve el valor absoluto de un número.\n";
echo "round(\$numero): Redondea un número al entero más cercano.\n";
echo "ceil(\$numero): Redondea un número hacia arriba al entero más cercano.\n";
echo "floor(\$numero): Redondea un número hacia abajo al entero más cercano.\n";
echo "rand(\$min, \$max): Devuelve un número aleatorio entre \$min y \$max.\n";
echo "sqrt(\$numero): Devuelve la raíz cuadrada de un número.\n";
echo "pow(\$base, \$exponente): Devuelve la potencia de un número elevado a otro número.\n\n";

echo "3. Funciones de fecha y hora:\n";
echo "date(\$formato): Devuelve la fecha y hora actual en el formato especificado.\n";
echo "strtotime(\$fecha): Convierte una cadena de fecha en una marca de tiempo Unix.\n";
echo "time(): Devuelve la marca de tiempo Unix actual.\n";
echo "mktime(\$hora, \$minuto, \$segundo, \$mes, \$dia, \$año): Devuelve la marca de tiempo Unix para una fecha específica.\n\n";

echo "4. Funciones de manejo de archivos:\n";
echo "fopen(\$archivo, \$modo): Abre un archivo y devuelve un puntero al mismo.\n";
echo "fclose(\$puntero): Cierra un archivo abierto con fopen().\n";
echo "fread(\$puntero, \$longitud): Lee el contenido de un archivo abierto.\n";
echo "fwrite(\$puntero, \$contenido): Escribe contenido en un archivo abierto.\n";
echo "fgets(\$puntero): Lee una línea de un archivo abierto.\n";
echo "fputs(\$puntero, \$contenido): Escribe contenido en un archivo abierto.\n";
echo "fseek(\$puntero, \$offset): Mueve el puntero de un archivo a una posición específica.\n";
echo "feof(\$puntero): Devuelve verdadero si se ha llegado al final de un archivo.\n";
echo "fstat(\$puntero): Devuelve información sobre un archivo abierto.\n";
echo "ftruncate(\$puntero, \$longitud): Trunca un archivo a una longitud específica.\n";
echo "fcopy(\$origen, \$destino): Copia un archivo de origen a un destino.\n";
echo "fdelete(\$archivo): Elimina un archivo.\n";
echo "frename(\$archivoAntiguo, \$archivoNuevo): Cambia el nombre de un archivo.\n";
echo "fchmod(\$archivo, \$modo): Cambia los permisos de un archivo.\n";
echo "fchown(\$archivo, \$usuario): Cambia el propietario de un archivo.\n";
echo "fchgrp(\$archivo, \$grupo): Cambia el grupo de un archivo.\n";
echo "fstat(\$archivo): Devuelve información sobre un archivo.\n";
?>