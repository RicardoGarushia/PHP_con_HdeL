<?php
header( "Content-Type: text/plain");

echo "\n18. ARRAYS: Array Multidimensional\n\n";

echo "18.1 Definición de un array:
Como se abordó en \"15.ArraysIndexado\" y \"16.ArraysAsociativo\",
, un array es una estructura de datos 
que permite almacenar múltiples valores en una sola variable.\n\n";

echo "18.2 Tipos de array:
Igualmente, como se abordó en \"15.ArraysIndexado\" y \"16.ArraysAsociativo\",
existen tres tipos de arrays, más una combinación en PHP:
1. Array indexado: Un array en el que cada elemento se identifica mediante un índice numérico  (se aborda en \"15.\").
2. Array asociativo: Un array en el que cada elemento se identifica mediante una clave asociativa (string)  (se aborda en \"16.\").
3. Array multidimensional: Un array que contiene otros arrays como elementos (se aborda aquí, en \"18.\").
Este a su vez puede ser un array asociativo o indexado, por lo que se puede decir que hay cuatro tipos de arrays:
4. Array asociativo multidimensional: Un array que contiene otros arrays como elementos y 
en el que cada elemento se identifica mediante una clave asociativa (string)  (se aborda en \"18.\"). \n\n";

echo "15.2.3. Array Multidimensional:
Un array multidimensional es un array que contiene otros arrays como elementos.";

echo "\n\nEjemplo de array multidimensional con sintaxis corta -usando corchetes []-:
\$arrayMultidimensionalSintaxisCorta = [
    [\"Ricardo\", \"García\", \"López\"], // Array 0
    [\"María\", \"González\", \"Hernández\"], // Array 1
    [\"Juan\", \"Pérez\", \"Ramírez\"], // Array 2
    [\"Janeth\", \"Pérez\", \"Acosta\"] // Array 3
];  // Array principal\n\n";

$arrayMultidimensionalSintaxisCorta = [
    ["Ricardo", "García", "López"], // Array 0
    ["María", "González", "Hernández"], // Array 1
    ["Juan", "Pérez", "Ramírez"], // Array 2
    ["Janeth", "Pérez", "Acosta"] // Array 3
];  // Array principal

echo "Ahora, dado que array multidimensional es un array que contiene otros arrays. 
Un array multidimensional se puede recorrer y extraer sus elementos utilizando
un bucle foreach, dentro de otro bucle foreach (término técnico: foreach anidados)\n\n";

echo "Un ejemplo de sintaxis de un foreach anidado es el siguiente:
echo \"El array multidimensional contiene los siguientes elementos:
foreach (\$arrayMultidimensionalSintaxisCorta as \$indiceArray => \$valor) {
    echo \"Arreglo: \$indiceArray, Valor: \";
    foreach (\$valor as \$subIndice => \$subValor) {
        echo \"\$subValor \";
    }
    echo \"\n\";
}   // foreach anidados\n\n";

echo "El array multidimensional contiene los siguientes elementos:\n";
foreach ($arrayMultidimensionalSintaxisCorta as $indiceArray => $valor) {
    echo "Arreglo: $indiceArray, Valor: ";
    foreach ($valor as $subIndice => $subValor) {
        echo "$subValor ";
    }
    echo "\n";
}   // foreach anidados

echo "\nSi desea obtener un valor específico de un array multidimensional,
por ejemplo, el apellido \"García\", se utiliza la siguiente sintaxis:
echo \"Impresión de mi apellido: \" . \$arrayMultidimensionalSintaxisCorta[0][1] . \"\\n\"; // Impresión de \"García\"
El primer valor de la sintaxis anterior [0] especifica el array, mientras que
el segundo valor [1] especifica el elemento dentro del array.\n\n";

echo "Impresión de mi apellido: " . $arrayMultidimensionalSintaxisCorta[0][1] . "\n";  // Impresión de "García"



echo "\n\n15.2.4. Array Asociativo Multidimensional:
Un array multidimensional es un array que contiene otros arrays como elementos. 
En este caso, cada elemento del array multidimensional es un array asociativo.
Es decir, un array en el que cada elemento se identifica mediante una clave asociativa (string).\n\n";

echo "Un ejemplo de sintaxis de array asociativo multidimensional con sintaxis corta -usando corchetes []-:
\$arrayMultidimensionalAsociativoSintaxisCorta = [
    [
        \"nombre\" => \"Ricardo\",
        \"apellido Paterno\" => \"García\",
        \"apellido Materno\" => \"López\"
    ],
    [
        \"nombre\" => \"María\",
        \"apellido Paterno\" => \"González\",
        \"apellido Materno\" => \"Hernández\"
    ],
    [
        \"nombre\" => \"Juan\",
        \"apellido Paterno\" => \"Pérez\", 
        \"apellido Materno\" => \"Ramírez\"],
    [
        \"nombre\" => \"Janeth\",
        \"apellido Paterno\" => \"Pérez\", 
        \"apellido Materno\" => \"Acosta\"
    ]
];\n\n";


$arrayMultidimensionalAsociativoSintaxisCorta = [
    [
        "nombre" => "Ricardo",
        "apellido Paterno" => "García",
        "apellido Materno" => "López"
    ],
    [
        "nombre" => "María",
        "apellido Paterno" => "González",
        "apellido Materno" => "Hernández"
    ],
    [
        "nombre" => "Juan",
        "apellido Paterno" => "Pérez", 
        "apellido Materno" => "Ramírez"],
    [
        "nombre" => "Janeth",
        "apellido Paterno" => "Pérez", 
        "apellido Materno" => "Acosta"
    ]
];

echo "Un ejemplo de sintaxis de un foreach anidado es el siguiente:
    echo \"El array multidimensional asociativo contiene los siguientes elementos:
    foreach (\$arrayMultidimensionalSintaxisCorta as \$indiceArray => \$valor) {
        echo \"Arreglo: \$indiceArray, Valor: \";
        foreach (\$valor as \$subIndice => \$subValor) {
            echo \"\$subIndice => \$subValor \";
        }
        echo \"\n\";
    }   // foreach anidados\n\n";
    
echo "El array multidimensional asociativo contiene los siguientes elementos:\n";
foreach ($arrayMultidimensionalSintaxisCorta as $indiceArray => $numArregloAnidado) {
    echo "Arreglo: $indiceArray, Valor: ";
    foreach ($numArregloAnidado as $clave => $valor) {
        echo "$clave: . $valor ";
    }
    echo "\n";
}   // foreach anidados


foreach ($arrayMultidimensionalAsociativoSintaxisCorta as $indice => $arregloAnidado) {
    echo "Arreglo anidado en el índice " . $indice . ":\n";
    foreach ($arregloAnidado as $clave => $valor) {
        echo "  " . $clave . ": " . $valor . "\n";
    }
    echo "\n"; // Separador para mejor visualización
}

?>