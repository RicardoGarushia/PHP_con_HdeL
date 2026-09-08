<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "17. ESTRUCTURA DE CONTROL FOREACH\n";
echo "======================================================================\n\n";


echo "======================================================================\n";
echo "17.2. Casos de Uso Prácticos\n";
echo "======================================================================\n\n";

echo "======================================================================\n";
echo "17.2.1 Recorrer un Arreglo Indexado (Solo Valor)\n";
echo "======================================================================\n\n";

// Definición de un array indexado
$nombres = ["Arturo", "Beatriz", "Carlos", "Daniela", "Efrén"];

foreach ($nombres as $nombre) {
    echo "Nombre: $nombre\n";
}


echo "\n\n======================================================================\n";
echo "17.2.2. Recorrer un Arreglo Asociativo (Clave y Valor)\n";
echo "======================================================================\n\n";

// Definición de un array asociativo
$persona = [
    "Nombre" => "Ricardo",
    "Apellido Paterno" => "García",
    "Apellido Materno" => "López",
    "Edad" => 34
];

foreach ($persona as $clave => $valor) {
    echo "$clave: $valor\n";
}


echo "\n\n======================================================================\n";
echo "17.2.3. Extracción de Índices Numéricos en Arreglos Indexados\n";
echo "======================================================================\n\n";

// Obtención del índice exacto
foreach ($nombres as $indice => $valor) {
    echo "Índice: $indice, Valor: $valor\n";
}

// Formateo para enumeración legible (base 1)
foreach ($nombres as $indice => $valor) {
    $numero = $indice + 1;
    echo "Nombre $numero: $valor\n";
}
