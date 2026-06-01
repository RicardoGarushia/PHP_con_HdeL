<?php
header("Content-Type: text/plain");

echo "\n8. ESTRUCTURA SWITCH\n\n";

echo "La estructura SWITCH (o CASE) es una de las estructuras de control más utilizadas en programación.
Permite evaluar una variable y ejecutar un bloque de código específico según el valor de esa variable.
Es recomendable cuando existen categiorías o valores específicos a evaluar, como en el caso de días de la semana, meses del año, etc.\n\n";

echo "\n\nLa sintaxis básica de la estructura SWITCH es la siguiente:\n\n";
echo "switch (variable) {
    case (valorVariableA):
    // Código a ejecutar si coincide con el valorVariableA
    break\n
    case (valorVariableB):
    // Código a ejecutar si coincide con el valorVariableB
    break\n
    case (valorVariable...):
    // Código a ejecutar si coincide con el valorVariable...
    break\n
    case (valorVariableN):
    // Código a ejecutar si coincide con el valorVariableN
    break\n
    default: // En caso de que ningún valor coincida
    // Código a ejecutar si la condición N es verdadera";
    
echo "Ejemplo de SWITCH con OPERADOR AND (&&) y OR (||)\n\n";
echo "\n\nVamos a crear un ejemplo de SWITCH con la variable \$mes de tipo string (cadena).\n\n";

$mesCadena1 = "Enero";
$mesCadena2 = "Enero ";
$mesCadena3 = "enero";
$mesCadena4 = "enero ";
$mesCadena5 = "EnEro";

switch ($mesCadena3) {
    case "Enero":
        echo "El mes es enero";
        break;
    case "Febrero":
        echo "El mes es febrero";
        break;
}

echo "\n\nAunque PHP permite comparar variables de tipo string (cadena), 
no es lo más recomendable debido a que cualquier cambio mínimo,
como mayúsculas, minúsculas, acentos o incluso un espacio vacío,
haría fallar la comparación. Siempre será más recomendable utilizar tipo de dato int (entero).\n\n";

echo "\n\nVamos a crear un ejemplo de SWITCH con la variable \$mes de tipo int (entero).\n\n";
$mes = 7;
switch ($mes) {
    case 12:
    case 1:
    case 2:
        echo "Es invierno";
        break;
    case 3:
    case 4:
    case 5:
        echo "Es primavera";
        break;
    case 6:
    case 7:
    case 8:
        echo "Es verano";
        break;
    case 9:
    case 10:
    case 11:
        echo "Es otoño";
        break;
    }
?>