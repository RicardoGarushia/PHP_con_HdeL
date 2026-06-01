<?php
header(header: "Content-Type: text/plain");

echo "\n37. JSON\n\n";

echo "JSON (JavaScript Object Notation) es un formato de texto ligero y legible por humanos 
que se utiliza para intercambiar datos entre sistemas.
Aunque su nombre proviene de JavaScript, es completamente independiente del lenguaje,
lo que lo convierte en el estándar de facto para la comunicación entre un servidor (como el que ejecuta PHP) 
y un cliente (como un navegador web o una aplicación móvil).\n\n";

echo "JSON es fundamental para el desarrollo web moderno, 
y su integración con PHP es muy sencilla y eficiente.\n\n\n";

echo "37.1 Características Clave de JSON\n\n";
echo "a) Sintaxis Simple: Se basa en una estructura de clave-valor.
b) Legible: Es fácil de leer y escribir.
c) Estructurado: Utiliza dos estructuras principales:
    c1) Colecciones de pares clave/valor (objetos en JSON, equivalentes a arrays asociativos en PHP).
    c2) Listas ordenadas de valores (arrays en JSON, equivalentes a arrays indexados en PHP).\n\n\n";


echo "37.1.1 Sintaxis Simple: Ejemplo\n\n";
echo "{
    \"Nombre\": \"Ricardo\",
    \"Edad\": 34,
    \"Id\": 307036087,
    \"estudianteActivo\": true,
    \"direccion\": {
        \"Calle\": \"Av. Siempre Viva 123\",
        \"Ciudad\": \"Springfield\",
        \"CódigoPostal\": \"12345\"
    }
    \"hobbies\": [\"frontón\", \"lectura\", \"videojuegos\"]
}\n\n";

echo "\"direccion\" es un Objeto JSON anidado dentro del Objeto JSON principal.
    Su sintaxis está delimitado por llaves {}.
    Su contenido es una colección de pares clave/valor.
    Se convierte en un objeto stdClass anidado o un array asociativo anidado en PHP, dependiendo de cómo se decodifique con json_decode().\n\n";
echo "\"hobbie\" es un Array JSON anidado dentro del Objeto JSON principal.
    Su sintaxis está delimitado por corchetes [].
    Su contenido es una lista ordenada de valores. En este caso, cadenas de texto: \"frontón\", \"lectura\", \"videojuegos\"
    SIEMPRE se convierte en un Array Indexado (numérico) de PHP\n\n\n";

echo "37.1.2 Tipos de Datos en JSON\n\n";
echo "a) Cadenas de Texto (Strings): Deben estar entre comillas dobles. Ejemplo: \"Hola, Mundo!\"
b) Números: Pueden ser enteros o de punto flotante. Ejemplo: 42, 3.14
c) Objetos: Colecciones de pares clave/valor, delimitados por llaves {}
d) Arrays: Listas ordenadas de valores, delimitadas por corchetes []
e) Booleanos: true o false
f) Null: Representa un valor nulo\n\n\n";


echo "37.1.3 Arrays de objetos JSON\n\n";
echo "Un array de objetos JSON es una estructura que contiene múltiples objetos JSON dentro de un array.
Cada objeto dentro del array puede tener su propia estructura de pares clave/valor.
Esta estructura es útil para representar listas de elementos complejos, como usuarios, productos, etc.\n\n\n";


echo "Ejemplo de un Array de Objetos JSON\n\n";
echo "[{
    \"Nombre\": \"Ricardo\",
    \"Edad\": 34,
    \"Id\": 307036087,
    \"estudianteActivo\": true,
    \"direccion\": {
        \"Calle\": \"Av. Siempre Viva 123\",
        \"Ciudad\": \"Springfield\",
        \"CódigoPostal\": \"12345\"
    }
    \"hobbies\": [\"frontón\", \"lectura\", \"videojuegos\"]
{
    \"Nombre\": \"José\",
    \"Edad\": 64,
    \"Id\": 703608730,
    \"estudianteActivo\": false,
    \"direccion\": {
        \"Calle\": \"Av. Siempre Viva 456\",
        \"Ciudad\": \"Springfield\",
        \"CódigoPostal\": \"12345\"
    }
    \"hobbies\": [\"frontón\", \"lectura\", \"videojuegos\"]
}
{
    \"Nombre\": \"Quetzalli\",
    \"Edad\": 14,
    \"Id\": 360873070,
    \"estudianteActivo\": true,
    \"direccion\": {
        \"Calle\": \"Av. Siempre Viva 789\",
        \"Ciudad\": \"Springfield\",
        \"CódigoPostal\": \"12345\"
    }
    \"hobbies\": [\"frontón\", \"lectura\", \"videojuegos\"]
}
    }]\n\n\n";


echo "37.2 Funciones JSON en PHP\n\n";

echo "PHP proporciona dos funciones principales para trabajar con JSON:
a) json_encode(): Convierte datos de PHP (arrays o objetos) en una cadena JSON.
b) json_decode(): Convierte una cadena JSON en datos de PHP (arrays o objetos).
En la siguiente clase se aborda a detalle estás dos funciones.\n\n\n";


?>