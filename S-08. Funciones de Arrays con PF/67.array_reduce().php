<?php
header("Content-Type: text/plain");

echo "66. FOS: array_reduce()\n\n";

echo "La Función de Orden Superior (FOS) array_reduce() es la última de las tres funciones fundamentales de la Programación Funcional en colecciones (Map, Filter, Reduce).\n\n";

echo "Mientras que array_map() transforma cada elemento y array_filter() selecciona elementos basados en una condición,
array_reduce() se utiliza para 'reducir' un array a un solo valor acumulado (una suma, un promedio, una cadena de texto, o incluso un nuevo objeto)
mediante la aplicación repetida de una función de retrollamada (callback).\n\n";

echo "Es decir: 
array_reduce (array \$array , callable \$callback, mixed \$initial = null): mixed\n\n";

echo "
\$array     |   array       |   El array que se va a recorrer y se va aplicar el callback para filtrar sus elementos.
\$callback  |   callable    |	La función que se aplicará a cada elemento. Si no se proporciona ninguna función de retrollamada callback, todas las entradas vacías del array array serán eliminadas.\n\n";

echo "En este caso el callback recibe dos parámetros:
    1. El valor acumulado hasta el momento (inicialmente es el valor de \$initial).
    2. El valor actual del array que se está procesando.\n\n";

echo "El objetivo de array_reduce() es reducir un array (una colección de valores) a un solo valor de salida.\n\n";

echo "array_reduce() es la herramienta perfecta para obtener una métrica o un resultado final de un conjunto de datos.
El valor de salida puede ser:
    a) Un número: (ej. la suma total, el promedio, la cuenta de elementos únicos).
    b) Una cadena: (ej. concatenar todos los nombres del array en una sola frase).
    c) Un booleano: (ej. verificar si todos los elementos cumplen una condición).
    d) Un nuevo array u objeto: (ej. crear un array asociativo complejo a partir de una lista plana, aunque para esto array_map y array_filter combinados son a veces más claros).\n\n"; 



echo "67.1 RELACIÓN DE array_filter() CON PROGRAMACIÓN FUNCIONAL\n\n";

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



echo "67.2 EJEMPLO\n\n";

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



// Calcular el promedio de las edades usando array_reduce()
$promedioEdadParticipantes = array_reduce($participantes,
    fn ($totalAcumulado, $persona) => (
        $totalAcumulado + $persona->age
    ), 
    0) / count($participantes
);

echo "Edad Promedio de los Participantes:{$promedioEdadParticipantes} años. \n\n";



// Calcular el total de participantes mujeres con un hipotético inicial de 100 mujeres
$totalMujeresConInicial = array_reduce(
    $participantes, 
    fn ($contador, People $persona) => (
        $persona->sex === "Femenino" ? $contador + 1 : $contador    // OPERADOR TERNARIO: Si el sexo es Femenino, se suma 1. Si es Masculino, no se suma nada. 
    ),
    100 // Valor inicial (100 mujeres hipotéticas)
);



// Regresar un listado de nombres
$listadoNombres = array_reduce(
    $participantes,
    fn ($lista, People $persona) => (
        $lista . "<li>" . $persona->name . "</li>"
    ), "<ul>"
);

$listadoNombres .= "</ul>"; 

echo "Listado de Nombres de los Participantes:\n{$listadoNombres}\n\n";
