<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "8. ESTRUCTURA DE CONTROL SWITCH EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "8.2.1. Comparación de Cadenas (string) vs. Enteros (int)\n";
echo "======================================================================\n\n";

$mesCadena = "EnEro";   // Modifica el formato ("enero", "enerO", "en ero", etc.) y el valor ("febrero", "marzo", "feBrero", etc.)

echo "Evaluando la variable \$mesCadena con valor: $mesCadena \n";
echo "Resultado: ";

switch ($mesCadena) {
    case "Enero":
        echo "El mes es enero.\n\n";
        break;
    case "Febrero":
        echo "El mes es febrero.\n\n";
        break;
    default:
        echo "No coincide con ningún 'case'. Probablemente, debido a variaciones de formato (mayúsculas, minúsculas, espacios adicionales o tildes).\n\n";
        break;
}


echo "\n======================================================================\n";
echo "8.2.2. Agrupamiento de Casos (Case Stacking)\n";
echo "======================================================================\n\n";

$mes = 7; // 1 == enero, 2 == febrero, 3 == marzo, y así sucesivamente. 

switch ($mes) {
    case 12:
    case 1:
    case 2:
        echo "Es invierno\n\n";
        break;
    case 3:
    case 4:
    case 5:
        echo "Es primavera\n\n";
        break;
    case 6:
    case 7:
    case 8:
        echo "Es verano\n\n";
        break;
    case 9:
    case 10:
    case 11:
        echo "Es otoño\n\n";
        break;
    default:
        echo "Mes no válido\n\n";
        break;
}


echo "\n======================================================================\n";
echo "Actividades\n";
echo "======================================================================\n\n";



echo "\n======================================================================\n";
echo "Tu propia expresión MATCH (Ejemplo libre)\n";
echo "======================================================================\n\n";



?>