<?php

header(header: "Content-Type: text/plain");

echo "\n35. Clases con propiedades dinámicas (stdClass)\n\n";

echo "35.1 ¿Qué son las clases con propiedades dinámicas (stdClass)?\n";
echo "Las clases con propiedades dinámicas en PHP, ejemplificadas por \"stdClass\", 
son esencialmente objetos genéricos vacíos que puedes crear y 
a los que puedes añadir propiedades y valores sobre la marcha (dinámicamente)
sin tener que definir previamente una clase formal.\n\n";

echo "35.2 ¿Cómo se crean y utilizan las clases con propiedades dinámicas?\n";
echo "Puedes crear un objeto stdClass de tres maneras principales:

1. Instaciación directa: Utilizando \"stdClass\"
   \$objetoGenerico = new stdClass();

2. Conversión de un array a tipo object: Cuando conviertes un array asociativo a un tipo object usando casting
(\"casquear\" a tipo object utilizando la palabra reservada \"object\"):
    \$array = ['nombreSoftware' => 'Gemini', 'tipo' => 'AI'];
    \$objetoGenerico = (object) \$array;

3. JSON Decodificado (json_decode): Al decodificar una cadena JSON sin el segundo parámetro como \"true\" (que convierte a array)
    \$json ='{\"nombre\": \"Ricardo\",
            \"edad\": 25}';
    \$objetoGenerico = json_decode(\$json);\n\n\n";


echo "35.2 PROPIEDADES DINÁMICAS\n";
echo "La característica más importante es que, una vez creado el objeto 
con \"stdClass\", puedes añadirle propiedades en cualquier momento:\n\n";

echo "35.2.1 EJEMPLO PRÁCTICO con \"stdClass\" de clase con propiedades dinámicas\n";
echo "<?php
\$usuario = new stdClass();

// Añadir la propiedad 'nombre'
\$usuario->nombre = \"Ricardo\"; 

// Añadir la propiedad 'edad'
\$usuario->edad = 34;

// Añadir la propiedad 'activo'
\$usuario->activo = true;

// Acceder a la propiedad
echo \"IMPRESIÓN EN CONSOLA: \\nDatos usuario: \" . \$usuario->nombre . \", \" . \$usuario->edad . \" años, \" . \$usuario->activo . \"\\n\\n\"; // Salida: Ricardo, 34, 1

// Mostrar tipo de dato de cada propiedad y del objeto
echo \"Tipo de dato que es \$usuario: \" . gettype(\$usuario) . \"\\n\"; // Salida: object
echo \"Tipo de dato que es \$usuario->nombre: \" . gettype(\$usuario->nombre) . \"\\n\"; // Salida: string
echo \"Tipo de dato que es \$usuario->edad: \" . gettype(\$usuario->edad) . \"\\n\"; // Salida: integer
echo \"Tipo de dato que es \$usuario->activo: \" . gettype(\$usuario->activo) . \"\\n\"; // Salida: boolean
echo \"NOTA: En la salida, el valor booleano 'true' se muestra como '1' cuando se convierte a cadena.\\n\\n\\n\";

// Acceder a las propiedades del array asociativo
echo \"Datos de software: \" . \$arrayDeJSON['nombre'] . \", \" . \$arrayDeJSON['edad'] . \", \" . implode(\", \", \$arrayDeJSON['aplicativos']) . \"\\n\\n\"; // Salida: Ricardo, 34, VisualStudio Code, Gemini, OBS Studio

// Acceder a las propiedades del objeto
echo \"Nombre: \" . \$objetoDeJSON->nombre . \", Edad: \" . \$objetoDeJSON->edad . \", Aplicativos: \" . implode(\", \", \$objetoDeJSON->aplicativos) . \"\\n\\n\"; // Salida: Ricardo, 34, VisualStudio Code, Gemini, OBS Studio

echo \"Tipo de dato que es \$arrayDeJSON: \" . gettype(\$arrayDeJSON) . \"\\n\"; // Salida: array
echo \"Tipo de dato que es \$arrayDeJSON['nombre']: \" . gettype(\$arrayDeJSON['nombre']) . \"\\n\"; // Salida: string
echo \"Tipo de dato que es \$arrayDeJSON['edad']: \" . gettype(\$arrayDeJSON['edad']) . \"\\n\"; // Salida: integer
echo \"Tipo de dato que es \$arrayDeJSON['aplicativos']: \" . gettype(\$arrayDeJSON['aplicativos']) . \"\\n\"; // Salida: array

echo \"Tipo de dato que es \$objetoDeJSON: \" . gettype(\$objetoDeJSON) . \"\\n\"; // Salida: object
echo \"Tipo de dato que es \$objetoDeJSON->nombre: \" . gettype(\$objetoDeJSON->nombre) . \"\\n\"; // Salida: string
echo \"Tipo de dato que es \$objetoDeJSON->edad: \" . gettype(\$objetoDeJSON->edad) . \"\\n\"; // Salida: integer
echo \"Tipo de dato que es \$objetoDeJSON->aplicativos: \" . gettype(\$objetoDeJSON->aplicativos) . \"\\n\\n\\n\"; // Salida: array
?>\n\n";

$usuario = new stdClass();

// Añadir la propiedad 'nombre'
$usuario->nombre = "Ricardo";

// Añadir la propiedad 'edad'
$usuario->edad = 34;

// Añadir la propiedad 'activo'
$usuario->activo = true;

// Acceder a la propiedad
echo "IMPRESIÓN EN CONSOLA: \nDatos usuario: " . $usuario->nombre . ", " . $usuario->edad . " años, " . $usuario->activo .
    "\n\n"; // Salida: Ricardo, 34, 1

echo "Tipo de dato que es \$usuario: " . gettype($usuario) . "\n"; // Salida: boolean
echo "Tipo de dato que es \$usuario->nombre: " . gettype($usuario->nombre) . "\n"; // Salida: string
echo "Tipo de dato que es \$usuario->edad: " . gettype($usuario->edad) . "\n"; // Salida: integer
echo "Tipo de dato que es \$usuario->activo: " . gettype($usuario->activo) . "\n"; // Salida: boolean
echo "NOTA: En la salida, el valor booleano 'true' se muestra como '1' cuando se convierte a cadena.\n\n\n";



echo "35.2.2 EJEMPLO PRÁCTICO de conversión de un Array Asociativo a tipo object (\"stdClass\") por casting\n";

echo "<?php
\$array = ['nombreSoftware' => 'Gemini', 'tipo' => 'AI'];
\$objetoGenerico = (object) \$array;    // Este casting crea un objeto stdClass

// Acceder a la propiedad
echo \"Datos de software: \" . \$objetoGenerico->nombreSoftware . \", \" . \$objetoGenerico->tipo . \"\\n\\n\"; // Salida: Datos de software: Gemini, AI

echo \"Tipo de dato que es \$objetoGenerico: \" . gettype(\$objetoGenerico) . \"\\n\"; // Salida: object
echo \"Tipo de dato que es \$objetoGenerico->nombreSoftware: \" . gettype(\$objetoGenerico->nombreSoftware) . \"\\n\"; // Salida: string
echo \"Tipo de dato que es \$objetoGenerico->tipo: \" . gettype(\$objetoGenerico->tipo) . \"\\n\\n\\n\"; // Salida: string
?>\n\n";


echo "Cuando PHP realiza el casting de un array asociativo a un objeto:
a) Crea una instancia de la clase genérica stdClass.
b) Cada clave del array se convierte en una propiedad del nuevo objeto.
c) El valor asociado a esa clave se convierte en el valor de la propiedad.\n\n";

echo "Array Asociativo              Objeto stdClass Resultante del Casting
\$array['nombreSoftware']       \$objeto->nombreSoftware
\$array['tipo']                 \$objeto->tipo
\n";

$array = ['nombreSoftware' => 'Gemini', 'tipo' => 'AI'];
$objetoGenerico = (object) $array;    // Este casting crea un objeto stdClass

// Acceder a la propiedad
echo "Datos de software: " . $objetoGenerico->nombreSoftware . ", " . $objetoGenerico->tipo
    . "\n\n"; // Salida: Datos de software: Gemini, AI

echo "Tipo de dato que es \$objetoGenerico: " . gettype($objetoGenerico) . "\n"; // Salida: object
echo "Tipo de dato que es \$objetoGenerico->nombreSoftware: " . gettype($objetoGenerico->nombreSoftware) . "\n"; // Salida: string
echo "Tipo de dato que es \$objetoGenerico->tipo: " . gettype($objetoGenerico->tipo) . "\n\n\n"; // Salida: string


echo "NOTA: Si el array SÓLO tiene claves numéricas, al convertirlo a tipo object (\"stdClass\") por casting,
estas se convierten en propiedades con nombres como '0', '1', '2', etc.\n\n";

echo "<?php
// Ejemplo de conversión de un array numérico a objeto stdClass por casting
\$numeros = [66, 21, 25];
\$otroObjeto = (object) \$numeros;

// Acceder a la propiedad
echo \"Números: \" . \$otroObjeto->{0} . \", \" . \$otroObjeto->{1} . \",\" . \$otroObjeto->{2} . \"\\n\\n\"; // Salida: Números: 66, 21, 25
echo \"Tipo de dato que es \$objetoObjeto: \" . gettype(\$objetoObjeto) . \"\\n\"; // Salida: object
echo \"Tipo de dato que es \$objetoObjeto->{0}: \" . gettype(\$objetoObjeto->{0}) . \"\\n\"; // Salida: integer
echo \"Tipo de dato que es \$objetoObjeto->{1}: \" . gettype(\$objetoObjeto->{1}) . \"\\n\\n\\n\"; // Salida: integer
echo \"Tipo de dato que es \$objetoObjeto->{2}: \" . gettype(\$objetoObjeto->{2}) . \"\\n\\n\\n\"; // Salida: integer
?>\n\n";

// Ejemplo de conversión de un array numérico a objeto stdClass por casting
$numeros = [66, 21, 25];
$otroObjeto = (object) $numeros;

// Acceder a la propiedad
echo "Números: " . $otroObjeto->{0} . ", " . $otroObjeto->{1} . "," . $otroObjeto->{2} . "\n\n"; // Salida: Números: 66, 21, 25
echo "Tipo de dato que es \$otroObjeto: " . gettype($otroObjeto) . "\n"; // Salida: object
echo "Tipo de dato que es \$otroObjeto->{0}: " . gettype($otroObjeto->{0}) . "\n"; // Salida: integer
echo "Tipo de dato que es \$otroObjeto->{1}: " . gettype($otroObjeto->{1}) . "\n"; // Salida: integer
echo "Tipo de dato que es \$otroObjeto->{2}: " . gettype($otroObjeto->{2}) . "\n\n\n"; // Salida: integer



echo "35.2.3 EJEMPLO PRÁCTICO de JSON Decodificado\n";
echo "<?php
\$estructuraJSON ='{\"nombre\": \"Ricardo\", \"edad\": 34, \"aplicativos\": [\"VisualStudio Code\", \"Gemini\", \"OBS Studio\"]}';

// El primer parámetro es true
\$arrayDeJSON = json_decode(json: \$estructuraJSON, associative: true); // Decodificar JSON a array asociativo

// El segundo parámetro es false (o se omite)
\$objetoDeJSON = json_decode(json: \$estructuraJSON); // Decodificar JSON a objeto \"stdClass\"

// Acceder a la propiedad
echo \"Nombre: \" . \$objetoGenerico->nombre . \", Edad: \" . \$objetoGenerico->edad . \"\\n\\n\"; // Salida: Nombre: Ricardo, Edad: 25

// Mostrar tipo de dato de cada propiedad y del objeto
echo \"Tipo de dato que es \$objetoGenerico: \" . gettype(\$objetoGenerico) . \"\\n\"; // Salida: object
echo \"Tipo de dato que es \$objetoGenerico->nombre: \" . gettype(\$objetoGenerico->nombre) . \"\\n\"; // Salida: string
echo \"Tipo de dato que es \$objetoGenerico->edad: \" . gettype(\$objetoGenerico->edad) . \"\\n\"; // Salida: integer
?>\n\n";

$estructuraJSON = '{
"nombre": "Ricardo",
"edad": 34,
"aplicativos": ["VisualStudio Code", "Gemini", "OBS Studio"]
}';

// El primer parámetro es true
$arrayDeJSON = json_decode(json: $estructuraJSON, associative: true); // Decodificar JSON a array asociativo

// El segundo parámetro es false (o se omite)
$objetoDeJSON = json_decode(json: $estructuraJSON); // Decodificar JSON a objeto "stdClass"

// Acceder a las propiedades del array asociativo
echo "Datos de software: " . $arrayDeJSON['nombre'] . ", " . $arrayDeJSON['edad'] . ", " . implode(", ", $arrayDeJSON['aplicativos']) . "\n\n"; // Salida: Ricardo, 34, VisualStudio Code, Gemini, OBS Studio

// Acceder a las propiedades del objeto
echo "Nombre: " . $objetoDeJSON->nombre . ", Edad: " . $objetoDeJSON->edad . ", Aplicativos: " . implode(", ", $objetoDeJSON->aplicativos) . "\n\n"; // Salida: Ricardo, 34, VisualStudio Code, Gemini, OBS Studio

// Mostrar tipo de dato de cada propiedad y del array
echo "Tipo de dato que es \$arrayDeJSON: " . gettype($arrayDeJSON) . "\n"; // Salida: array
echo "Tipo de dato que es \$arrayDeJSON['nombre']: " . gettype($arrayDeJSON['nombre']) . "\n"; // Salida: string
echo "Tipo de dato que es \$arrayDeJSON['edad']: " . gettype($arrayDeJSON['edad']) . "\n"; // Salida: integer
echo "Tipo de dato que es \$arrayDeJSON['aplicativos']: " . gettype($arrayDeJSON['aplicativos']) . "\n"; // Salida: array

// Mostrar tipo de dato de cada propiedad y del objeto
echo "Tipo de dato que es \$objetoDeJSON: " . gettype($objetoDeJSON) . "\n"; // Salida: boolean
echo "Tipo de dato que es \$objetoDeJSON->nombre: " . gettype($objetoDeJSON->nombre) . "\n"; // Salida: string
echo "Tipo de dato que es \$objetoDeJSON->edad: " . gettype($objetoDeJSON->edad) . "\n"; // Salida: integer
echo "Tipo de dato que es \$objetoDeJSON->aplicativos: " . gettype($objetoDeJSON->aplicativos) . "\n\n\n"; // Salida: integer



echo "35.3 Ventajas y desventajas de usar clases con propiedades dinámicas (\"stdClass\")\n";
echo "Ventajas:
- Flexibilidad: Puedes añadir o quitar propiedades fácilmente sin necesidad de redefinir la estructura de la clase.
- Ideal para datos semi-estructurados o desconocidos.

Desventajas:
- Falta de estructura: Puede llevar a una menor claridad sobre qué propiedades están disponibles en el objeto.
- Posibles errores tipográficos: Al no tener una definición de clase estricta, es fácil cometer errores al acceder o asignar propiedades.
- NO HAY Type Hinting: Un objeto \"stdClass\" no puede usarse como Type Hint en una función, lo que anula la seguridad y el desacoplamiento que brindan las interfaces.
- Falta de Contrato: Al NO TENER una estructura definida, cualquier error de escritura (\$datos->usaurio en lugar de \$datos->usuario) resulta en una nueva propiedad, NO ES UN ERROR.
- Falta de Comportamiento: Solo almacenan datos; no tienen métodos (comportamiento) asociados a ellos.
\n\n";

echo "35.4 Conclusión y recomendación\n";
echo "Utiliza \"stdClass\" principalmente cuando interactúas con datos externos (como la salida predeterminada de json_decode), pero para estructuras internas de tu aplicación, SIEMPRE ES MEJOR DEFINIR UNA CLASE O UNA INTERFAZ.\n\n";
