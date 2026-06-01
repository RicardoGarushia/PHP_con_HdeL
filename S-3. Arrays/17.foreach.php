<?php
header( "Content-Type: text/plain");

echo "\n17. ESTRUCTURA DE CONTROL FOREACH\n\n";

echo "17.1 Definición de foreach:
Un foreach es una estructura de control que permite recorrer un array o un objeto, 
iterando sobre cada uno de sus elementos.
Su propósito principal es simplificar el proceso de recorrer cada elemento de una colección de datos, 
permitiendo ejecutar un bloque de código para cada elemento.

Su sintaxis es, en términos generales: 
foreach (array as \$valor) {
    // Código a ejecutar para cada elemento
}\n\n";

echo "17.2 Ejemplo del uso de foreach:
Reutilicemos el ejemplo del array indexado con sintaxis corta -usando corchetes []-, introducida en PHP 5.4:
\$arrayIndexadoSintaxisCorta = [\"Arturo\", \"Beatriz\", \"Carlos\", \"Daniela\", \"Efrén\"];\n\n";

$arrayIndexadoSintaxisCorta = ["Arturo", "Beatriz", "Carlos", "Daniela", "Efrén"];

echo "Utilizando la estructura de control de \"foreach\" se pueden obtener los elementos del arreglo de la siguiente manera:
foreach (\$arrayIndexadoSintaxisCorta as \$valorArreglo) {
    echo \"Nombre: \$valorArreglo\\n\";
}\n\n";

echo "Entonces, el array indexado con sintaxis corta contiene los siguientes elementos:\n";

foreach ($arrayIndexadoSintaxisCorta as $valorArreglo) {
    echo "Nombre: $valorArreglo\n";
}

echo "\n\nAhora, reutilicemos el ejemplo de inicialización de un array asociativo:
\$arrayAsociativoSintaxisCorta = (
    \"Nombre\" => \"Ricardo\",
    \"Apellido Paterno\" => \"García\",
    \"Apellido Materno\" => \"López\",
    \"Edad\" => 34,
);\n\n";

$arrayAsociativoSintaxisCorta = [
    "Nombre" => "Ricardo",
    "Apellido Paterno" => "García",
    "Apellido Materno" => "López", 
    "Edad" => 34
];

echo "En este caso, es posible que queramos especificar tanto la clave asociativa (string) como el valor.
foreach (\$arrayAsociativoSintaxisCorta as \$clave => \$valor) {
    echo \"\$clave: \$valor\\n\";
}\n\n";

echo "Entonces, el array asociativo con sintaxis corta contiene los siguientes elementos:\n";

foreach ($arrayAsociativoSintaxisCorta as $clave => $valor) {
    echo "$clave: $valor\n";
}

echo "\nIgualmente, si queremos extraer el índice de un array indexado se utiliza la sintaxis anterior de la siguiente manera:
foreach (\$arrayIndexadoSintaxisCorta as \$indice => \$valor) {
    echo \"Índice: \$indice, Valor: \$valor\\n\";
}\n\n";

foreach ($arrayIndexadoSintaxisCorta as $indice => $valor) {
    echo "Índice: $indice, Valor: $valor\n";
}

echo "\nAhora, si queremos extraer el índice de un array indexado de una forma más orgánica. 
Podemos utilizar la siguiente sintaxis:
foreach (\$arrayIndexadoSintaxisCorta as \$indice => \$valor) {
    echo \"Nombre \" . \$indice+1 . \": \$valor\\n\";
}\n\n";

foreach ($arrayIndexadoSintaxisCorta as $indice => $valor) {
    echo "Nombre " . $indice+1 . ": $valor\n";
}

?>