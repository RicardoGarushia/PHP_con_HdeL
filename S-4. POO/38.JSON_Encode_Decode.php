<?php
header(header: "Content-Type: text/plain");

echo"\n38. JSON: json_encode() y json_decode()\n\n";

echo"38.1 json_encode(): Convertir Datos de PHP a JSON\n\n";
echo "La función json_encode() en PHP se utiliza para convertir datos de PHP,
como arrays o objetos, en una cadena JSON.
Esta función es especialmente útil cuando se necesita enviar datos desde un servidor PHP
a una aplicación web o a otro servicio que consume JSON.\n\n\n";

echo"Ejemplo de Uso de json_encode()\n\n";
echo "
// Arreglo asociativo en PHP
\$datos = array(
    \"nombre\" => \"Juan\",
    \"edad\" => 30,
    \"usuarioActivo\" => true
);
// Tipo de dato que es \$datos
echo \"Tipo de dato que es \$datos: \" . gettype(\$datos) . \"\\n\\n\"; // Salida: array
// Mostrar los datos
print_r(\$datos); // Salida: Array ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )
echo \"\\n\\n\";

// Convertir el arreglo a JSON
\$json = json_encode(\$datos);
// Tipo de dato que es \$json
echo \"Tipo de dato que es \$json: \" . gettype(\$json) . \"\\n\\n\"; // Salida: string
// Mostrar los datos
print_r (\$json) // Salida: Array ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )
echo \"\\n\\n\\n\";
?>\n\n";

// Arreglo asociativo en PHP
$datos = array(
    "nombre" => "Juan",
    "edad" => 30,
    "usuarioActivo" => true
);
// Tipo de dato que es $datos
echo "Tipo de dato que es \$datos: " . gettype(value: $datos) . "\n\n"; // Salida: array
// Mostrar los datos
print_r(value: $datos); // Salida: Array ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )
echo "\n\n";

// Convertir el arreglo a JSON
$json = json_encode(value: $datos);
// Tipo de dato que es $json
echo "Tipo de dato que es \$json: " . gettype(value: $json) . "\n\n"; // Salida: string
// Mostrar los datos
print_r(value: $json); // Salida: Array ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )
echo "\n\n\n";


echo"38.2 json_decode(): Convertir JSON a Datos de PHP\n\n";
echo "La función json_decode() en PHP se utiliza para convertir una cadena JSON
en datos de PHP, como arrays (si se agrega el segundo parámetro)
u objetos stdClass (si se omite el segundo parámetro o se considera false).
Esta función es útil cuando se recibe una cadena JSON de una aplicación web
o de otro servicio y se necesita trabajar con esos datos en PHP.\n\n\n";

echo "Ejemplo de Uso de json_decode()\n\n";
echo "<?php
// Cadena JSON
\$json = '{\"nombre\":\"Juan\",\"edad\":30,\"usuarioActivo\":true}';

// Tipo de dato que es \$json
echo \"Tipo de dato que es \$json: \" . gettype(\$json) . \"\\n\"; // Salida: string
// Mostrar los datos
echo \$json . \"\\n\\n\"; // Salida: {\"nombre\":\"Juan\",\"edad\":30,\"usuarioActivo\":true}

// Convertir la cadena JSON a un arreglo asociativo de PHP
\$arrayDeJSON = json_decode(\$json, true);
// Tipo de dato que es \$arrayDeJSON
echo \"\\n\\nTipo de dato que es \$arrayDeJSON: \" . gettype(\$arrayDeJSON) . \"\\n\"; // Salida: array
// Mostrar los datos
print_r(\$arrayDeJSON); // Salida: Array ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )

// Convertir la cadena JSON a un objeto stdClass de PHP al no pasar el segundo parámetro
\$objetoDeJSON = json_decode(\$json);
// Tipo de dato que es \$objetoDeJSON
echo \"\\nTipo de dato que es \$objetoDeJSON: \" . gettype(\$objetoDeJSON) . \"\\n\"; // Salida: object
// Mostrar los datos
print_r(\$objetoDeJSON); // Salida: stdClass Object ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )

echo \"\\n\\n\\n\";
?>\n\n\n";

// Cadena JSON
$json = '{"nombre":"Juan","edad":30,"usuarioActivo":true}';

// Tipo de dato que es $json
echo "Tipo de dato que es \$json: " . gettype(value: $json) . "\n"; // Salida: string
// Mostrar los datos
print_r(value: $json); // Salida: Array ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )

// Convertir la cadena JSON a un arreglo asociativo de PHP
$arrayDeJSON = json_decode(json: $json, associative: true);
// Tipo de dato que es $arrayDeJSON
echo "\n\nTipo de dato que es \$arrayDeJSON: " . gettype($arrayDeJSON) . "\n"; // Salida: array
// Mostrar los datos
print_r(value: $arrayDeJSON); // Salida: Array ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )

// Convertir la cadena JSON a un objeto stdClass de PHP al no pasar el segundo parámetro
$objetoDeJSON = json_decode(json: $json);
// Tipo de dato que es $objetoDeJSON
echo "\nTipo de dato que es \$objetoDeJSON: " . gettype($objetoDeJSON) . "\n"; // Salida: object
// Mostrar los datos
print_r(value: $objetoDeJSON); // Salida: stdClass Object ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )

echo "\n\n\n";

echo"38.3 Ejemplo más práctico de json_encode() desde una clase\n\n";

echo"<?php
// Definición de la clase Usuario
class Usuario {
    public \$nombre;
    public \$edad;
    public \$usuarioActivo;

    public function __construct(\$nombre, \$edad, \$usuarioActivo) {
        \$this->nombre = \$nombre;
        \$this->edad = \$edad;
        \$this->usuarioActivo = \$usuarioActivo;
    }
}

// Crear una instancia de la clase Usuario
\$usuario = new usuario(\"Ana\", 25, true);
// Convertir el objeto a JSON
\$jsonUsuario = json_encode(value: \$usuario);
// Mostrar la cadena JSON
echo \$jsonUsuario . \"\\n\\n\\n\"; // Salida: {\"nombre\":\"Ana\",\"edad\":25,\"usuarioActivo\":true}
?>\n\n";

// Definición de la clase Usuario
class Usuario {
    public $nombre;
    public $edad;
    public $usuarioActivo;

    public function __construct($nombre, $edad, $usuarioActivo) {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->usuarioActivo = $usuarioActivo;
    }
}

// Crear una instancia de la clase Usuario
$usuario = new usuario(nombre:"Ana", edad: 25, usuarioActivo: true);
// Convertir el objeto a JSON
$jsonUsuario = json_encode(value: $usuario);
// Tipo de dato que es $objetoDeJSON
echo "Tipo de dato que es \$jsonUsuario: " . gettype(value: $jsonUsuario) . "\n\n"; // Salida: object
// Mostrar los datos
print_r(value: $jsonUsuario); // Salida: Array ( [nombre] => Juan [edad] => 30 [usuarioActivo] => true )
