<?php
header("Content-Type: text/plain");

echo "68. Funciones de Ordenación y la FOS: usort()\n\n";

echo "Las Funciones de Ordenación son cruciales, y entender las diferencias entre ellas es vital para manejar datos de manera eficiente en PHP.\n\n";

echo "Existen varios grupos de funciones sort en PHP, y cada una tiene un objetivo diferente, especialmente en cómo maneja las claves (keys) de los arrays.";

echo "Las 8 Funciones de Ordenación Esenciales en PHP son: 
a) sort() / rsort(): Ordena arrays indexados en orden ascendente o descendente, reindexando las claves.
b) asort() / arsort(): Ordena arrays asociativos en orden ascendente o descendente, preservando las claves originales.
c) ksort() / krsort(): Ordena arrays asociativos por sus claves en orden ascendente o descendente, preservando las claves.
d) usort(): Ordena arrays indexados utilizando una función de comparación definida por el usuario. REINDEXA (pierde los índices originales).
e) uasort(): Ordena por valor usando una función de comparación personalizada (tu callback). MANTIENE la asociación clave -> valor.\n\n\n\n";



echo "68.2 EJEMPLOS para usort() y uasort()\n\n";

require "modelsArray/people.php";
require "modelsArray/functions.php";

use ModelsArray\People;

// Crear un array de objetos People
$participantes = [
    new People("Ana", 18, "Femenino"),
    new People("Benito", 25, "Masculino"),
    new People("Carla", 28, "Femenino"),
    new People("Daniel", 35, "Masculino"),
    new People("Elizabeth", 21, "Femenino"),
    new People("Francisco", 34, "Masculino")
];


// Nota: usort() modifica el array original ($participantes) in-place.
// Para demostrar la ordenación con usort() y uasort(), creamos una copia que ordenaremos con cada función.
$participantesUsortPorEdadAscendente = $participantes; // Clonar el array original

$participantesUasortPorEdadAscendente = $participantes; // Clonar el array original

$participantesUsortPorEdadDescendente = $participantes; // Clonar el array original

$participantesUasortPorEdadDescendente = $participantes; // Clonar el array original

// Ordenar con usort() por edad ascendente
usort($participantesUsortPorEdadAscendente, fn ($a, $b) => $a->age <=> $b->age);
// Ordenar con uasort() por edad ascendente
uasort($participantesUasortPorEdadAscendente, fn ($a, $b) => $a->age <=> $b->age);

// Ordenar con usort() por edad descendente
usort($participantesUsortPorEdadDescendente, fn ($a, $b) => $b->age <=> $a->age);
// Ordenar con uasort() por edad descendenteS
uasort($participantesUasortPorEdadDescendente, fn ($a, $b) => $b->age <=> $a->age);


echo "Ordenación con usort() por edad (reindexado) ascendente :\n";
showDepure($participantesUsortPorEdadAscendente);

echo "Ordenación con uasort() por edad (preservando claves) ascendente:\n";
showDepure($participantesUasortPorEdadAscendente);

echo "Ordenación con usort() por edad (reindexado) descendente :\n";
showDepure($participantesUsortPorEdadDescendente);

echo "Ordenación con uasort() por edad (preservando claves) descendente:\n";
showDepure($participantesUasortPorEdadDescendente);


echo "68.3 El operador nave espacial <=>\n\n";

echo "El operador nave espacial (<=>) es un operador de comparación introducido en PHP 7 que facilita la comparación entre dos valores. 
Devuelve -1, 0 o 1 dependiendo de si el valor de la izquierda es menor, igual o mayor que el valor de la derecha, respectivamente.\n\n"; 


