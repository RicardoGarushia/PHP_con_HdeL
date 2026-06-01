<?php

header(header: "Content-Type: text/plain");

echo "\n36. Conversión de objetos a Arrays\n\n";
echo "En PHP, puedes convertir un objeto a un array utilizando varias técnicas:\n";
echo "a) Una forma común es un casting explícito del objeto a array utilizando (array).\n";
echo "b) Otra forma es hacer  usar la función get_object_vars(), que devuelve un array asociativo con las propiedades del objeto y sus valores.\n"; 
echo "c) También puedes usar json_encode() para convertir el objeto a una cadena JSON y luego json_decode() para convertir esa cadena JSON en un array asociativo.\n\n\n";


echo "36.1 Ejemplo práctico de conversión de un objeto a un Array por casting\n\n";

echo "<?php
// Definimos una clase con propiedades públicas, protegidas y privadas.
class Producto {
    // Propiedades o atributos: 
    public \$nombre = \"Monitor\";      // Propiedad pública
    protected \$precio = 8000;          // Propiedad protegida
    private \$stock = 10;               // Propiedad privada

    // Métodos:
    public function mostrarProducto() {
        return \"Producto: \$this->nombre, Precio: \$this->precio, Stock: \$this->stock\";
    }

    // Constructor:

    // Destructor:

    // Métodos mágicos:
}

// Crear una instancia (objeto) de la clase Producto
\$productoMonitor = new Producto();
// Convertir el objeto a un array usando casting
\$arregloProducto = (array) \$productoMonitor;
// Imprimir el array resultante
echo \"Salida del array resultante:\\n\";
print_r(\$arregloProducto);
?>\n\n\n";

// Definimos una clase con propiedades públicas, protegidas y privadas.
class Producto {
    // Propiedades o atributos: 
    public $nombre = "Monitor";      // Propiedad pública
    protected $precio = 8000;          // Propiedad protegida
    private $stock = 10;               // Propiedad privada

    // Métodos:
    public function mostrarProducto() {
        return "Producto: $this->nombre, Precio: $this->precio, Stock: $this->stock";
    }

    // Constructor:

    // Destructor:

    // Métodos mágicos:
}

// Crear una instancia (objeto) de la clase Producto
$productoMonitor = new Producto();

// Mostrar el tipo de dato
echo "Tipo de dato que es \$productoMonitor: " . gettype($productoMonitor) . "\n\n"; // Salida: object

// Convertir el objeto a un array usando casting
$arregloProducto = (array) $productoMonitor;
// Imprimir el array resultante
echo "Salida del array resultante:\n";
print_r($arregloProducto);

// Mostrar el tipo de dato
echo "\nTipo de dato que es \$arregloProducto: " . gettype($arregloProducto) . "\n"; // Salida: array


echo"\n\nComo se puede observar en la salida, 
el array resultante contiene las propiedades del objeto.
- La propiedad pública 'nombre' se convierte en una clave simple 'nombre'.
- La propiedad protegida 'precio' se convierte en una clave con un prefijo especial que incluye el nombre de la clase y un asterisco: '\0*\0precio'.
- La propiedad privada 'stock' se convierte en una clave con un prefijo que incluye el nombre de la clase y un carácter nulo: '\0Producto\0stock'.\n\n\n";

echo"36.2 ¿Qué sucedió con el método mostrarProducto()?";
echo "\n\nEl método mostrarProducto() no aparece en el array resultante
porque los métodos NO son parte del estado del objeto y, por lo tanto,
NO SE INCLUYEN CUANDO SE CONVIERE UN OBJETO A UN ARRAY.
Los métodos son funciones asociadas a la clase
y no se almacenan como propiedades del objeto.\n\n";

echo "Al convertir un objeto a un array, estás obteniendo una instantánea de los datos (propiedades) de esa instancia.\n\n\n";


echo "36.3 CONCLUSIÓN\n\n";
echo "El casting (array) es técnicamente posible para cualquier objeto, pero raramente se utiliza en código profesional debido a:
a) Pérdida de Información: Pierdes la lógica (métodos).
b) Claves Complicadas: Las propiedades protected y private generan claves \"encriptadas\" que son difíciles de manejar.\n\n\n";
echo "Para convertir un objeto a array de forma controlada,
se prefieren métodos como el uso de la interfaz JsonSerializable (si el objetivo es JSON) 
o métodos mágicos como __toArray() si defines el tuyo propio.\n\n";

?>