<?php
header("Content-Type: text/plain");

echo "66. FOS: array_filter()\n\n";

echo "La Función de Orden Superior (FOS) array_filter() es la contraparte de array_map():
en lugar de transformar TODOS los elementos, se utiliza para SELECCIONAR solo aquellos que cumplen con una condición específica.\n\n";

echo "Entonces, la Función de Orden Superior (FOS) array_filter() se utiliza para 
filtrar los elementos de un array mediante una función de retrollamada."; 

echo "Es decir: 
array_filter (array \$array , ? callable \$callback = \$null, int \$mode = 0 ): array\n\n";

echo "
\$array     |   array       |   El array de entrada al que se le va aplicar el callback para reducir sus elementos.
\$callback  |   callable    |	La función que se aplicará a cada elemento. Si no se proporciona ninguna función de retrollamada callback, todas las entradas vacías del array array serán eliminadas.\n\n";

echo "El objetivo de array_filter() es evaluar cada valor del array array pasándolos a la función de retrollamada callback.
Si la función de retrollamada callback devuelve true, el valor actual del array array es devuelto en el array resultante.\n\n";

echo "Las claves del array son preservadas, y puede causar anomalías si el array array estaba indexado.
El array resultante puede ser reindexado utilizando la función array_values().\n\n"; 



echo "66.1 RELACIÓN DE array_filter() CON PROGRAMACIÓN FUNCIONAL\n\n";

echo "La función 'array_map()' es una de las implementaciones más directas de los principios de la Programación Funcional en PHP:
    a) Función de Orden Superior:
        Acepta una función (callable) como argumento (el callback), que es la definición de una Función de Orden Superior (FOS).
        El callback se aplica a cada elemento del array y encapsula la lógica.
    b) Inmutabilidad Implícita:
        Al devolver un nuevo array y no modificar el original,
        fomenta (aunque no garantiza) un flujo de datos más inmutable,
        una práctica central de la Programación Funcional.
    c) Encadenamiento de Funciones (Pipe):
        array_map() y array_filter() a menudo se usan juntas,
        lo cual es la base de un pipe (tubería) funcional.
    d) Operación sobre Colecciones (estilo declarativo):
        Permite realizar operaciones complejas sobre colecciones de datos sin usar bucles 'for' o 'foreach',
        promoviendo un estilo de código más declarativo (describes qué quieres hacer, no cómo iterar -imperativo-).\n\n\n\n";



echo "66.2 EJEMPLO\n\n";

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



// Mostrar el nuevo array con solo los nombres con la función showDepure() de functions.php
echo "Impresión del Arreglo sin Modificaciones:\n\n";
show($participantes);



echo "\n\n\n\nLista Original de Participantes con formato:\n\n";

// Uso de array_map() para formatear toda la lista
$listaCompleta = array_map(fn ($p) 
=> "{$p->name} ({$p->sex}): {$p->age} años\n",
$participantes);    // Arrow función para mostrar todo el array con formato

showFormat($listaCompleta);



echo "\n\n\n\nLista de Participantes Femeninos con formato:\n\n";

// Uso de array_filter() para filtrar solo a las mujeres
$soloMujeres = array_filter(
    $participantes, 
    fn (People $persona): bool
    // Condición 
    => $persona->sex === "Femenino" // Arrow función para seleccionar sólo a mujeres (sex === 'Femenino')
);

showDepure($soloMujeres);



// Arrow función para mostrar todo el array filtrado
echo "\n\n\n\nLista de Participantes Masculinos y con más de 30 años con formato:\n\n";


$soloHombresMayoresA30 = array_filter(
    $participantes,
    fn (People $persona): bool => (
        // Condición #1
        $persona->sex === "Masculino"
        &&
        // Condición #2
        $persona->age >= 30
        )   // Arrow función para seleccionar sólo a hombres (sex === 'Masculino') y con edad >= 30
);

showDepure($soloHombresMayoresA30);



