<?php
declare(strict_types=1);   // Ejecución de la directiva "strict_types" mediante el constructo "declare" para tipo de datos duro. 

header("Content-Type: text/plain");

echo "\n25. DECLARACIÓN DE TIPO DE DATO EN FUNCIONES Y PROPIEDADES DE CLASES (PHP 7.4 EN ADELANTE) \n\n";

echo "Cómo se mencionó en 5.2, desde PHP 7.4 se introdujo la declaración de tipo de dato en las funciones y propiedades de clases.
Esto significa que puedes especificar el tipo de dato que una función debe recibir como argumento 
o el tipo de dato que una propiedad de clase debe contener. Esto ayuda a garantizar que los datos sean del tipo esperado 
y mejora la legibilidad del código.\n\n\n";

echo "25.1 CONSTRUCTO \"DECLARE()\"";
echo "El constructo \"declare()\" es usado para establecer la ejecución de directivas para un bloque de código. 
La sintaxis de \"declare()\" es similar a la sintaxis de otros constructor de control de flujo.\n\n";

echo "<?php
declare(directiva); 
    // declaración/statement
?>\n\n";

echo "La sección \"directiva\" permite establecer el comportamiento del bloque de código. Actualmente, solo existen tres directivas:
a) ticks. Son eventos que ocurren por cada N sentencias de bajo nivel que permiten ticks ejecutadas por el analizador dentro del bloque \"declare()\".
b) encoding. Mediante esta directiva se especifica para cada secuencia de comandos su codificación(encoding).
c) strict_types. Esta directiva anula la configuración predeterminada de \"type casting\" automático en un archivo PHP.
Por lo tanto, mediante esta directiva sólo se aceptaran valores que coincidan EXACTAMENTE con la declaración del tipo de dato
para funciones, métodos, parámetros y propiedades/atributos.\n\n";

echo "NOTA: 
Exclusivamente en el caso de 
<?php
declare(strict_types=1); // PRIMERA LÍNEA DE CÓDIGO, SIN COMENTARIOS, ESPACIOS EN BLANCO O CUALQUIER OTRO ELEMENTO PREVIO. 
    // declaración/statement
?>
TIENE QUE SER LA PRIMERA LÍNEA DE CÓDIGO SIN NADA PREVIO. 
Es decir, sin comentarios, espacios en blanco o cualquier otro elemento previo.\n\n";

echo "<?php
declare(strict_types=1); // Primera línea de código, sin comentarios, espacios en blanco o cualquier otro elemento previo. 

class Persona{
    // Propiedades o atributos con tipo de dato explícito
    private string \$nombre;
    private int \$edad; 
    private float \$monto;
    
    // Constructor con tipo de dato explícito
    public function __construct(string \$nombreCliente, int \$edadCliente, float \$montoCliente)
    {
        \$this -> nombre = \$nombreCliente;
        \$this -> edad = \$edadCliente;
        \$this -> monto = \$montoCliente;
    }

    // Destructor EXPLÍCITO: Se define como un método con la palabra reservada __destruct 
    public function __destruct()
    {
        echo \"Se ha eliminado el objeto\";
    }

    // Funciones getter y setter
    public function obtenerDatosCliente(): array
    {
        return [
            \$this -> nombre,
            \$this -> edad,
            \$this -> monto
        ];
    }
}
\$objetoPersona1 = new Persona(\"Ricardo\", 34, 10000.65);
// \$objetoPersona2 = new Persona(1234, \"21\", \"2566\");   // Error dado que ya no se da la conversión de tipos automática de PHP
// \$objetoPersona3 = new Persona(\"1234\", 21.54, 2566);   // Error dado que ya no se da la conversión de tipos automática de PHP

// Llamada de la función obtenerDatosCliente() para obtener los datos del objeto mediante un array
\$datosCliente = \$objetoPersona -> obtenerDatosCliente();

echo \"Impresión de lo almacenado en el objeto creado a partir de la clase Persona\\n\";
foreach(\$datosCliente as \$indice => \$valor){
    echo \"\$valor\\n\";  
}
?>\n\n";

class Persona{
    // Propiedades o atributos con tipo de dato explícito
    private string $nombre;
    private int $edad;
    private float $monto;
    
    // Constructor con tipo de dato explícito
    public function __construct(string $nombreCliente, int $edadCliente, float $montoCliente)
    {
        $this -> nombre = $nombreCliente;
        $this -> edad = $edadCliente;
        $this -> monto = $montoCliente;
    }

    // Destructor EXPLÍCITO: Se define como un método con la palabra reservada __destruct 
    public function __destruct()
    {
        echo "Se ha eliminado el objeto";
    }

    // Funciones getter y setter
    public function obtenerDatosCliente(): array
    {
        return [
            $this -> nombre,
            $this -> edad,
            $this -> monto
        ];
    }
}
$objetoPersona = new Persona("Ricardo", 34, 10000.65);
// $objetoPersona = new Persona(1234, "21", "2566");   // Error dado que no se da la conversión de tipos automática de PHP
// $objetoPersona3 = new Persona("1234", 21.54, 2566);   // Error dado que ya no se da la conversión de tipos automática de PHP

// Llamada de la función obtenerDatosCliente() para obtener los datos del objeto mediante un array
$datosCliente = $objetoPersona -> obtenerDatosCliente();

echo "Impresión de lo almacenado en el objeto creado a partir de la clase Persona\n";
foreach($datosCliente as $indice => $valor){
    echo "$valor\n";  
}
?>