<?php
header("Content-Type: text/plain");

echo "65. FOS: array_map()\n\n";

echo "La Función de Orden Superior (FOS) array_map() se utiliza para 
aplicar una función dada (pseudotipo 'callable') a cada elemento de uno o más arrays,
y devuelve un nuevo array con los resultados.\n\n";

echo "Es decir: 
array_map ( ? callable \$callback , array \$array , array ...\$arrays ): array\n\n";

echo "
\$callback  |   callable    |	La función que se aplicará a cada elemento. Esta función recibe tantos argumentos como arrays se pasen.
\$array     |   array       |   El primer array al que se aplica el callback.
...\$arrays |   array (opc) |	Uno o más arrays adicionales opcionales (usando el Operador Splat). Si se usan, el callback recibirá un argumento por cada array en orden.\n\n";

echo "El objetivo de array_map() es transformar cada elemento del array original,
devolviendo un nuevo array de la misma longitud que contiene los resultados de esa transformación.\n\n";

echo "a) Transformación:
    Modifica el valor de cada elemento (ejemplo: lo convierte a mayúsculas, lo multiplica por diez).
b) Inmutabilidad Implícita:
    Al devolver un nuevo array y no modificar el original,
    fomenta (aunque no garantiza) un flujo de datos más inmutable,
    una práctica central de la Programación Funcional.\n\n\n\n";



echo "65.1 RELACIÓN DE array_map() CON PROGRAMACIÓN FUNCIONAL\n\n";

echo "La función 'array_map()' es una de las implementaciones más directas de los principios de la Programación Funcional en PHP:
    a) Función de Orden Superior:
        Acepta una función (callable) como argumento (el callback), que es la definición de una Función de Orden Superior (FOS).
        El callback se aplica a cada elemento del array y encapsula la lógica.
    b) Inmutabilidad Implícita:
        Al devolver un nuevo array y no modificar el original,
        fomenta (aunque no garantiza) un flujo de datos más inmutable,
        una práctica central de la Programación Funcional.
    c) Encadenamiento de Funciones (Pipe):
        Aunque no es un pipe completo, es un paso fundamental,
        ya que el callback actúa como una 'tubería' que transforma el dato.
    d) Operación sobre Colecciones (estilo declarativo):
        Permite realizar operaciones complejas sobre colecciones de datos sin usar bucles 'for' o 'foreach',
        promoviendo un estilo de código más declarativo (describes qué quieres hacer, no cómo iterar -imperativo-).\n\n\n\n";


                
echo "65.2 EJEMPLO\n\n";

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


// Arrow función para extraer solo los nombres
$arregloNuevoSoloNombres = array_map(fn ($persona)
    => $persona->name, $participantes);
// Mostrar el nuevo array con solo los nombres con la función show() de functions.php
showDepure($arregloNuevoSoloNombres);


// Arrow función para formatear la información de cada persona
$arregloNuevoConFormato = array_map(fn ($persona)
    => "<b style='color: red'>" . $persona->name . "</b>:  {$persona->age} años, sexo: {$persona->sex}",
    $participantes
);
// Mostrar el nuevo array con la información formateada
show($arregloNuevoConFormato);


// Arrow función con la numeración enlistada de cada participante
$arregloNuevoConFormatoConNumeracionA = array_map(fn ($persona, $indice)  // Define dos argumentos: $persona y $indice
    => $indice . " - " .  $persona->name,
    $participantes, array_keys($participantes) // <- Pasa dos arrays
);
// Mostrar el nuevo array con la información formateada
showDepure($arregloNuevoConFormatoConNumeracionA);


// Arrow función con la numeración enlistada de cada participante
$arregloNuevoConFormatoConNumeracionB = array_map(fn ($persona, $indice)  // Define dos argumentos: $persona y $indice
    => ["id" => ($indice + 1), "nombre" => $persona->name],
    $participantes, array_keys($participantes) // <- Pasa dos arrays
);
// Mostrar el nuevo array con la información formateada
showDepure($arregloNuevoConFormatoConNumeracionB);

echo $arregloNuevoConFormatoConNumeracionB[2]["nombre"]; // Impresión: María