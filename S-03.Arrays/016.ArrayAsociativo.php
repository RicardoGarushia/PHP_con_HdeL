<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "16. ARRAYS: Parte 2. Array Asociativo\n";
echo "======================================================================\n\n";


echo "======================================================================\n";
echo "16.2. Declaración e Inicialización de Array Asociativo con Sintaxis Corta (`[]`)\n";
echo "======================================================================\n\n";

// Definición de un array asociativo
$persona = [
    "nombre" => "Ricardo",
    "apellidoP" => "García",
    "apellidoM" => "López",
    "edad" => 34
];

echo "El array asociativo con sintaxis corta contiene PRIMERO los siguientes elementos (uso de \"print_r\"):\n";
print_r($persona);

/*
echo "\nEl array indexado con sintaxis corta contiene PRIMERO los siguientes elementos (uso de \"foreach\"):\n";
foreach ($persona as $indice => $nombre) {
    echo "Índice: $indice, Valor: $nombre\n";
}
*/


echo "\n\n======================================================================\n";
echo "16.3. Inserción y Modificación de Elementos en Array Asociativo con Sintaxis Corta (`[]`)\n";
echo "======================================================================\n\n";


echo "======================================================================\n";
echo "16.3.1. Inserción de Nuevas Claves\n";
echo "======================================================================\n\n";

// Inserción en un array asociativo
$persona["estado"] = "CDMX";
$persona["pais"] = "México";

echo "El array asociativo con sintaxis corta contiene AHORA los siguientes elementos INSERTADOS AL FINAL (uso de \"print_r\"):\n";
print_r($persona);

/*
echo "\nEl array indexado con sintaxis corta contiene AHORA los siguientes elementos INSERTADOS AL FINAL (uso de \"foreach\"):\n";
foreach ($persona as $indice => $nombre) {
    echo "Índice: $indice, Valor: $nombre\n";
}
*/


echo "\n\n======================================================================\n";
echo "16.3.2. Modificación/Sobreescritura de Claves Existentes\n";
echo "======================================================================\n\n";

// Sobrescribe el valor de la clave "nombre"
$persona["nombre"] = "Leonardo";

echo "El array asociativo con sintaxis corta contiene FINALMENTE los siguientes elementos SOBREESCRITOS POR CLAVE (uso de \"print_r\"):\n";
print_r($persona);

/*
echo "\nEl array indexado con sintaxis corta contiene FINALMENTE los siguientes elementos SOBREESCRITOS POR CLAVE (uso de \"foreach\"):\n";
foreach ($persona as $indice => $nombre) {
    echo "Índice: $indice, Valor: $nombre\n";
}
*/