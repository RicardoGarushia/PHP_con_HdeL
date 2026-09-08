<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "18. ARRAYS: Array Multidimensional\n";
echo "======================================================================\n\n";


echo "======================================================================\n";
echo "18.2. Array Multidimensional Indexado\n";
echo "======================================================================\n\n";

echo "======================================================================\n";
echo "18.2.1 Declaración\n";
echo "======================================================================\n\n";

$usuariosIndexados = [
    ["Ricardo", "García", "López"],      // Índice 0, subarray 0
    ["María", "González", "Hernández"],  // Índice 1, subarray 1
    ["Juan", "Pérez", "Ramírez"],        // Índice 2, subarray 2
    ["Janeth", "Pérez", "Acosta"]        // Índice 3, subarray 3
];

foreach ($usuariosIndexados as $indiceArray =>$subArray) {
    echo "Arreglo $indiceArray: ";
    foreach ($subArray as $valor) {
        echo "$valor ";
    }
    echo "\n";
}


echo "\n\n======================================================================\n";
echo "18.2.2 Inserción\n";
echo "======================================================================\n\n";

// Se agrega un nuevo registro
$usuariosIndexados[] = ["Carlos", "Mendoza", "Sánchez"];

// Se agrega un nuevo campo
$usuariosIndexados[0][] = "Licenciatura"; // Se añade al final del sub-array 0

foreach ($usuariosIndexados as $indiceArray =>$subArray) {
    echo "Arreglo $indiceArray: ";
    foreach ($subArray as $valor) {
        echo "$valor ";
    }
    echo "\n";
}


echo "\n\n======================================================================\n";
echo "18.2.3 Modificación\n";
echo "======================================================================\n\n";

// Se modifica el valor en el elemento "0" del subarray "0"
$usuariosIndexados[0][0] = "Leonardo";

foreach ($usuariosIndexados as $indiceArray => $subArray) {
    echo "Arreglo $indiceArray: ";
    foreach ($subArray as $valor) {
        echo "$valor ";
    }
    echo "\n";
}


echo "\n\n======================================================================\n";
echo "18.2.4 Acceso Directo por Índices\n";
echo "======================================================================\n\n";

// Accede al Elemento 1 del Subarray 0: "García"
echo $usuariosIndexados[0][1] . "\n";


echo "\n\n======================================================================\n";
echo "18.2.5 Recorrido mediante `foreach` Anidado\n";
echo "======================================================================\n\n";

foreach ($usuariosIndexados as $indiceArray => $subArray) {
    echo "Arreglo $indiceArray: ";
    foreach ($subArray as$valor) {
        echo "$valor ";
    }
    echo "\n";
}


echo "\n\n======================================================================\n";
echo "18.3. Array Multidimensional Asociativo\n";
echo "======================================================================\n\n";

echo "======================================================================\n";
echo "18.3.1 Declaración\n";
echo "======================================================================\n\n";

$usuariosAsociativos = [
    [
        "nombre" => "Ricardo",
        "apellidoPaterno" => "García",
        "apellidoMaterno" => "López"
    ],
    [
        "nombre" => "María",
        "apellidoPaterno" => "González",
        "apellidoMaterno" => "Hernández"
    ]
];

foreach ($usuariosAsociativos as $indiceArray => $subArray) {
    echo "Arreglo $indiceArray: ";
    foreach ($subArray as $valor) {
        echo "$valor ";
    }
    echo "\n";
}


echo "\n\n======================================================================\n";
echo "18.3.2 Inserción\n";
echo "======================================================================\n\n";

// Se agrega un nuevo registro
$usuariosAsociativos[] = [
    "nombre" => "Carlos",
    "apellidoPaterno" => "Mendoza",
    "apellidoMaterno" => "Sánchez"
];

// Se agrega un nuevo campo, o mejor dicho par clave-valor
$usuariosAsociativos[0]["rol"] = "Administrador";

foreach ($usuariosAsociativos as $indiceArray => $subArray) {
    echo "Arreglo $indiceArray: ";
    foreach ($subArray as $valor) {
        echo "$valor ";
    }
    echo "\n";
}


echo "\n\n======================================================================\n";
echo "18.3.3 Modificación\n";
echo "======================================================================\n\n";

// Se modifica el valor en el elemento "0" del subarray "0"
$usuariosAsociativos[0]["nombre"] = "Ricardo Leonardo"; // Se modifica el nombre del subarray "0"

foreach ($usuariosAsociativos as $indiceArray => $subArray) {
    echo "Arreglo $indiceArray: ";
    foreach ($subArray as $valor) {
        echo "$valor ";
    }
    echo "\n";
}


echo "\n\n======================================================================\n";
echo "18.3.4. Acceso Directo\n";
echo "======================================================================\n\n";

// Accede al apellidoPaterno del primer registro: "García"
echo $usuariosAsociativos[0]["apellidoPaterno"] . "\n";


echo "\n\n======================================================================\n";
echo "18.3.5. Recorrido Completo (`foreach` Anidado)\n";
echo "======================================================================\n\n";

foreach ($usuariosAsociativos as $indice =>$persona) {
    echo "Registro $indice:\n";
    foreach ($persona as $clave =>$valor) {
        echo "  $clave:$valor\n";
    }
    echo "\n";
}