<?php
header("Content-Type: text/plain");

echo "\n16. ARRAYS: Array Asociativo\n\n";

echo "16.1 Definición de un array:
Como se abordó en \"15.ArraysIndexado\", un array es una estructura de datos 
que permite almacenar múltiples valores en una sola variable.\n\n";

echo "16.2 Tipos de arrays:\n\n
Como se abordó en \"15.ArraysIndexado\", 
existen tres tipos de arrays, más una combinación en PHP:
1. Array indexado: Un array en el que cada elemento se identifica mediante un índice numérico  (se aborda en \"15.\").
2. Array asociativo: Un array en el que cada elemento se identifica mediante una clave asociativa (string)  (se aborda aquí, en \"16.\").
3. Array multidimensional: Un array que contiene otros arrays como elementos (se aborda en \"18.\").
Este a su vez puede ser un array asociativo o indexado, por lo que se puede decir que hay cuatro tipos de arrays:
4. Array asociativo multidimensional: Un array que contiene otros arrays como elementos y 
en el que cada elemento se identifica mediante una clave asociativa (string)  (se aborda en \"18.\"). \n\n\n";

echo "15.2.2. Array Asociativo:
Un array asociativo es un array en el que cada elemento se identifica mediante una clave asociativa (string).\n\n";

echo "Ejemplo de inicialización de un array asociativo:
\$arrayAsociativoSintaxisCorta = [
    \"nombre\" => \"Ricardo\",
    \"apellidoP\" => \"García\",
    \"apellidoM\" => \"López\",
    \"edad\" => 34,
];\n\n";

$arrayAsociativoSintaxisCorta = [
    "nombre" => "Ricardo",
    "apellidoP" => "García",
    "apellidoM" => "López", 
    "edad" => 34
];

echo "El array asociativo contiene los siguientes elementos:\n";
print_r($arrayAsociativoSintaxisCorta);
/*
foreach ($arrayAsociativoSintaxisCorta as $clave => $valor) {
    echo "Clave: $clave, Valor: $valor\n";
}
*/

echo "\nEjemplo de agregado de elementos a un array asociativo mediante []:
\$arrayAsociativoSintaxisCorta[\"estado\"] = \"CDMX\";
\$arrayAsociativoSintaxisCorta[\"pais\"] = \"México\";\n\n";

$arrayAsociativoSintaxisCorta["estado"] = "CDMX";
$arrayAsociativoSintaxisCorta["pais"] = "México";

echo "Si se agrega una \"clave\" entre los corchetes [] se reinscribe en dicha posición.
Por ejemplo:
\$arrayAsociativoSintaxisCorta[\"nombre\"] = \"Ricardo\"; \n";
print_r($arrayAsociativoSintaxisCorta);
/*
echo "El array asociativo AHORA contiene los siguientes elementos:\n";
foreach ($arrayAsociativoSintaxisCorta as $clave => $valor) {
    echo "Clave: $clave, Valor: $valor\n";
}
*/
?>