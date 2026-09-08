<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "19. ARRAYS: Funciones para Arrays\n";
echo "======================================================================\n\n";


echo "======================================================================\n";
echo "19.1. Funciones de Inspección y Salida\n";
echo "======================================================================\n\n";

$frutas = ["Manzana", "Naranja", "Pera"];
echo "El arreglo contiene " . count($frutas) . " registros.\n\n"; // Imprime 3
print_r($frutas);


echo "\n\n======================================================================\n";
echo "19.2. Manipulación de Elementos (Pila y Cola)\n";
echo "======================================================================\n\n";

echo "======================================================================\n";
echo "19.2.1 array_push(\$array, ...\$valores): Agrega uno o más elementos al final del arreglo.\n";
echo "======================================================================\n\n";

array_push($frutas, "Uva", "Zapote");   // $frutas = ["Manzana", "Naranja", "Pera", "Uva", "Zapote"];
echo "El arreglo contiene " . count($frutas) . " registros.\n\n"; // Imprime 5
print_r($frutas);


echo "\n\n======================================================================\n";
echo "19.2.2 array_pop(\$array): Extrae y elimina el último elemento del arreglo, retornando su valor.\n";
echo "======================================================================\n\n";

$ultimo = array_pop($frutas);   // $frutas = ["Manzana", "Naranja", "Pera", "Uva"];
echo "El arreglo contiene " . count($frutas) . " registros.\n\n"; // Imprime 4
print_r($frutas);
echo "\n\nEl último valor pop-eado es: $ultimo";


echo "\n\n======================================================================\n";
echo "19.2.3 array_unshift(\$array, ...\$valores): Agrega uno o más elementos al inicio del arreglo.\n";
echo "======================================================================\n\n";

array_unshift($frutas, "Albaricoque", "Cereza");   // $frutas = ["Albaricoque", "Cereza", "Manzana", "Naranja", "Pera", "Uva"];
echo "El arreglo contiene " . count($frutas) . " registros.\n\n"; // Imprime 6
print_r($frutas);


echo "\n\n======================================================================\n";
echo "19.2.4 array_shift(\$array): Extrae y elimina el primer elemento del arreglo, retornando su valor.\n";
echo "======================================================================\n\n";

$primero = array_shift($frutas); // $frutas = ["Cereza", "Manzana", "Naranja", "Pera", "Uva"];
echo "El arreglo contiene " . count($frutas) . " registros.\n\n"; // Imprime 5
print_r($frutas);
echo "El primer valor shift-eado es: $primero";


echo "\n\n======================================================================\n";
echo "19.3. Búsqueda y Verificación\n";
echo "======================================================================\n\n";

if (in_array("Manzana", $frutas)) {
    echo "El valor 'Manzana' está presente en el array de frutas.\n\n";
}


$usuario = ["nombre" => "Ricardo", "edad" => 34];

if (in_array("Ricardo", $usuario)) {
    echo "El nombre 'Ricardo' está presente.\n\n";
}

if (array_key_exists("edad", $usuario)) {
    echo "La clave 'edad' existe en el arreglo.\n\n";
}


echo "======================================================================\n";
echo "19.4. Combinación y Modificación\n";
echo "======================================================================\n\n";

$backend = ["PHP", "Laravel"];
echo "El arreglo contiene " . count($backend) . " registros.\n\n"; // Imprime 2
print_r($backend);

$frontend = ["HTML", "CSS", "Bootstrap", "JavaScript", "Vue"];
echo "\n\nEl arreglo contiene " . count($frontend) . " registros.\n\n"; // Imprime 5
print_r($frontend);

$fullstack = array_merge($backend, $frontend);
echo "\n\nEl arreglo contiene " . count($fullstack) . " registros.\n\n"; // Imprime 7
print_r($fullstack);

