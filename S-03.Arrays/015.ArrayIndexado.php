<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "15. ARRAYS: Parte 1. Array Indexado\n";
echo "======================================================================\n\n";


echo "======================================================================\n";
echo "15.2.1 Array Indexado con Sintaxis Tradicional (`array()`)\n";
echo "======================================================================\n\n";

// Inicialización
$nombres = array("Pedro", "María", "Juan", "Agustín", "Janeth");

echo "El array indexado con sintaxis tradicional PRIMERO contiene los siguientes elementos (uso de \"print_r\"):\n";
print_r($nombres);

/*
echo "\nEl array indexado con sintaxis tradicional PRIMERO contiene los siguientes elementos (uso de \"foreach\"):\n";
foreach ($nombres as $indice => $nombre) {
    echo "Índice: $indice, Valor: $nombre\n";
}
*/

// Agregar elementos al final mediante función array_push()
array_push($nombres, "Mónica", "Violeta", "Claudia");

echo "\nEl array indexado con sintaxis tradicional AHORA contiene los siguientes elementos INSERTADOS AL FINAL (uso de \"print_r\"):\n";
print_r($nombres);

/*
echo "\nEl array indexado con sintaxis tradicional AHORA contiene los siguientes elementos (uso de \"foreach\"):\n";
foreach ($nombres as $indice => $nombre) {
    echo "Índice: $indice, Valor: $nombre\n";
}
*/


echo "\n\n======================================================================\n";
echo "15.2.2 Array Indexado con Sintaxis Corta (`[]`)\n";
echo "======================================================================\n\n";

// Inicialización con sintaxis corta
$nombres = ["Pedro", "María", "Juan", "Agustín", "Janeth"];

echo "El array indexado con sintaxis corta contiene PRIMERO los siguientes elementos (uso de \"print_r\"):\n";
print_r($nombres);

/*
echo "\nEl array indexado con sintaxis tradicional PRIMERO contiene los siguientes elementos (uso de \"foreach\"):\n";
foreach ($nombres as $indice => $nombre) {
    echo "Índice: $indice, Valor: $nombre\n";
}
*/

// Agregar elementos al final utilizando corchetes vacíos []
$nombres[] = "Mónica";
$nombres[] = "Violeta";
$nombres[] = "Claudia";

echo "\nEl array indexado con sintaxis corta contiene AHORA los siguientes elementos INSERTADOS AL FINAL (uso de \"print_r\"):\n";
print_r($nombres);

/*
echo "\nEl array indexado con sintaxis tradicional PRIMERO contiene los siguientes elementos (uso de \"foreach\"):\n";
foreach ($nombres as $indice => $nombre) {
    echo "Índice: $indice, Valor: $nombre\n";
}
*/


echo "\n\n======================================================================\n";
echo "15.2.3 Modificación y Sobreescritura por Índice\n";
echo "======================================================================\n\n";

// Sobrescribe el valor existente en los índices 0 a 6
$nombres[0] = "Ricardo";
$nombres[1] = "Ricardo";
$nombres[2] = "Ricardo";
$nombres[3] = "Ricardo";
$nombres[4] = "Ricardo";
$nombres[5] = "Ricardo";
$nombres[6] = "Ricardo";

echo "El array indexado con sintaxis corta contiene FINALMENTE los siguientes elementos SOBREESCRITOS POR ÍNDICE (uso de \"print_r\"):\n";
print_r($nombres);

/*
echo "\nEl array indexado con sintaxis corta contiene FINALMENTE los siguientes elementos SOBREESCRITOS POR ÍNDICE (uso de \"foreach\"):\n";
foreach ($nombres as $indice => $nombre) {
    echo "Índice: $indice, Valor: $nombre\n";
}
*/