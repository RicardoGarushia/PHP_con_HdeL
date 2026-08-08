<?php
header("Content-Type: text/plain");

echo "\n15. ARRAYS: Array indexado\n\n";

echo "15.1 Definición de un array:
Un array es una estructura de datos que permite almacenar múltiples valores en una sola variable.\n\n\n";

echo "15.2 Tipos de arrays:
Aunque técnicamente solo hay un tipo de array en PHP,
se pueden clasificar en tres categorías principales 
según cómo se indexan los elementos, más una combinación:
1. Array indexado: Un array en el que cada elemento se identifica mediante un índice numérico  (se aborda aquí, en \"15.\").
2. Array asociativo: Un array en el que cada elemento se identifica mediante una clave asociativa (string)  (se aborda en \"16.\").
3. Array multidimensional: Un array que contiene otros arrays como elementos (se aborda en \"18.\").
Este a su vez puede ser un array asociativo o indexado, por lo que se puede decir que hay cuatro tipos de arrays:
4. Array asociativo multidimensional: Un array que contiene otros arrays como elementos y 
en el que cada elemento se identifica mediante una clave asociativa (string)  (se aborda en \"18.\"). \n\n\n";

echo "15.2.1 Array indexado:
Un array indexado es un array en el que cada elemento se identifica mediante un índice numérico.
Los índices comienzan desde 0 y se incrementan automáticamente a medida que se agregan elementos al array\n\n\n";

echo "15.2.1.1 Array indexado con sintaxis antigua mediante función array():
Ejemplo de inicialización de un array indexado con sintaxis tradicional de arrays en PHP mediante función \"array()\":
\$arrayIndexadoSintaxisTradicional = array(\"Pedro\", \"María\", \"Juan\", \"Agustión\", \"Janeth\");\n\n";

$arrayIndexadoSintaxisTradicional = array("Pedro", "María", "Juan", "Agustín", "Janeth");

echo "El array indexado con sintaxis tradicional contiene los siguientes elementos:\n";
print_r($arrayIndexadoSintaxisTradicional);

/*
foreach ($arrayIndexadoSintaxisTradicional as $indice => $valor) {
    echo "Índice: $indice, Valor: $valor\n";
}
*/ 
echo "\nEjemplo de agregado de elementos a un array indexado con sintaxis tradicional mediante función \"array_push()\":
array_push(\$arrayIndexadoSintaxisTradicional, \"Mónica\", \"Violeta\", \"Claudia\");";
array_push($arrayIndexadoSintaxisTradicional, "Mónica", "Violeta", "Claudia");

echo "\n\nEl array indexado con sintaxis tradicional ahora contiene los siguientes elementos:\n";
print_r($arrayIndexadoSintaxisTradicional);
/*
foreach ($arrayIndexadoSintaxisTradicional as $indice => $valor) {
    echo "Índice: $indice, Valor: $valor\n";
}
*/

echo "\nExisten otras funciones para trabajar elementos de un array, como array_pop(), array_shift(), array_unshift(), etc.
Pero en este caso se enfoca más en la sintaxis corta -usando corchetes []- dado que es la más común y la que más se utiliza en la actualidad. 
Sin embargo, ten en mente esta sintaxis por si trabajas con archivos PHP de versiones más antiguas.\n\n\n";


echo "15.2.1.2 Array indexado con sintaxis corta -usando corchetes []-:
Ejemplo de array indexado con sintaxis corta -usando corchetes []-, introducida en PHP 5.4:
\$arrayIndexadoSintaxisCorta = [\"Pedro\", \"María\", \"Juan\", \"Agustión\", \"Janeth\"];\n\n";

$arrayIndexadoSintaxisCorta = ["Pedro", "María", "Juan", "Agustín", "Janeth"];
echo "El array indexado con sintaxis corta contiene los siguientes elementos (uso de \"print_r\"):\n";
print_r($arrayIndexadoSintaxisCorta);
/*
foreach ($arrayIndexadoSintaxisCorta as $indice => $valor) {
    echo "Índice: $indice, Valor: $valor\n";
}
*/

echo "\nEjemplo de agregado de elementos a un array indexado con sintaxis corta mediante []:
\$arrayIndexadoSintaxisCorta [] = \"Mónica\"; 
\$arrayIndexadoSintaxisCorta [] = \"Violeta\"; 
\$arrayIndexadoSintaxisCorta [] = \"Claudia\";\n\n";

$arrayIndexadoSintaxisCorta[] = "Mónica";
$arrayIndexadoSintaxisCorta[] = "Violeta";
$arrayIndexadoSintaxisCorta[] = "Claudia";

echo "El array indexado con sintaxis corta AHORA contiene los siguientes elementos:\n";
print_r($arrayIndexadoSintaxisCorta);
/*
foreach ($arrayIndexadoSintaxisCorta as $indice => $valor) {
    echo "Índice: $indice, Valor: $valor\n";
}
*/

echo "\nSi se agrega un numéro entre los corchetes [] se reinscribe en dicha posicición.\n
Ejemplo de agregado de elementos a un array indexado con sintaxis corta mediante []:
\$arrayIndexadoSintaxisCorta [0] = \"Ricardo\"; 
\$arrayIndexadoSintaxisCorta [1] = \"Ricardo\"; 
\$arrayIndexadoSintaxisCorta [2] = \"Ricardo\";
\$arrayIndexadoSintaxisCorta [3] = \"Ricardo\"; 
\$arrayIndexadoSintaxisCorta [4] = \"Ricardo\"; 
\$arrayIndexadoSintaxisCorta [5] = \"Ricardo\"; 
\$arrayIndexadoSintaxisCorta [6] = \"Ricardo\";\n\n";

$arrayIndexadoSintaxisCorta[0] = "Ricardo";
$arrayIndexadoSintaxisCorta[1] = "Ricardo";
$arrayIndexadoSintaxisCorta[2] = "Ricardo";
$arrayIndexadoSintaxisCorta[3] = "Ricardo";
$arrayIndexadoSintaxisCorta[4] = "Ricardo";
$arrayIndexadoSintaxisCorta[5] = "Ricardo";
$arrayIndexadoSintaxisCorta[6] = "Ricardo";

echo "El array indexado con sintaxis corta AHORA contiene los siguientes elementos:\n";
print_r($arrayIndexadoSintaxisCorta);
/*
foreach ($arrayIndexadoSintaxisCorta as $indice => $valor) {
    echo "Índice: $indice, Valor: $valor\n";
}
*/
?>