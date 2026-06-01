<?php
header( "Content-Type: text/plain");

echo "\n22. POO: Constructores EXPLÍCITOS de objetos\n\n";

echo "22.1 Definición de un constructor en PHP:";
echo "En PHP, un constructor es un método especial 
que se ejecuta automáticamente cuando se crea un objeto a partir de una clase, 
como se vío en 20.POOClasesObjetos.php.\n\n";

echo "Aunque no es obligatorio definir de manera explícita un constructor en una clase, 
dado que PHP proporcionará uno implícito si no se especifica, este constructor implícito 
no recibe parámetros y simplemente permite la creación del objeto sin realizar ninguna acción adicional. 
Es decir, las propiedades del objeto se inicializarán con valores predeterminados:
0 para números, false para booleanos y null para referencias o variables no asignadas.\n\n";

echo "Por otro lado, si se desea establecer valores personalizados al momento de crear el objeto, 
es necesario definir un CONSTRUCTOR EXPLÍCITO. Este tipo de constructor permite recibir parámetros 
y asignarlos directamente a las propiedades del objeto, lo que garantiza un estado inicial más controlado y útil.\n\n";

echo "El propósito principal de un constructor explícito es inicializar las propiedades del objeto 
y realizar cualquier configuración necesaria desde el inicio. 
EN PHP NO EXISTE LA SOBRECARGA DE CONSTRUCTORES COMO EN C# O JAVA.\n\n";

echo "<?php
class DesYConsDeClase {
    // Propiedades o atributos: Recuerda que no se recomienda usar propiedades públicas
    private \$apellidoP;
    private \$apellidoM;
    private \$nombre;
    private \$edad; 

    // Métodos: 
    public function getPropiedadesPrivadasComoArray() {
        return [
            \$this-> apellidoP, 
            \$this-> apellidoM, 
            \$this-> nombre, 
            \$this-> edad
        ];
    }

    // Constructor EXPLÍCITO: Se define como un método con la palabra reservada __construct 
    public function __construct(\$apellidoPUsuario, \$apellidoMUsuario, \$nombreUsuario, \$edadUsuario){
        \$this -> apellidoP = \$apellidoPUsuario;
        \$this -> apellidoM = \$apellidoMUsuario;
        \$this -> nombre = \$nombre;
        \$this -> edad = \$apellidoPUsuario;
    }
}
// Creación de un objeto a partir de la clase
\$objetoDeLaClase = new DesYConsDeClase(\"García\", \"López\", \"Ricardo\", 34);

// Acceso de los valores 
\$arrayParaVariasPropiedadesPrivadas = \$objetoDeLaClase->getPropiedadesPrivadasComoArray();

// Impresión de la clase con los valores ingresados
echo \"Acceso a propiedades privadas mediante getter: \\n\";
print_r(\$arrayParaVariasPropiedadesPrivadas);

foreach (\$arrayParaVariasPropiedadesPrivadas as \$indice => \$valor) {
    echo \"El valor en la posición \" . \$indice+1 . \" es: \$valor\\n\";
}
?>\n\n";

class DesYConsDeClase {
    // Propiedades o atributos: Recuerda que no se recomienda usar propiedades públicas
    private $apellidoP;
    private $apellidoM; 
    private $nombre;
    private $edad;

    // Métodos: 
    public function getPropiedadesPrivadasComoArray() {
        return [
            $this-> apellidoP, 
            $this-> apellidoM, 
            $this-> nombre, 
            $this-> edad
        ];
    }

    // Constructor EXPLÍCITO: Se define como un método con la palabra reservada __construct 
    public function __construct($apellidoPUsuario, $apellidoMUsuario, $nombreUsuario, $edadUsuario){
        $this -> apellidoP = $apellidoPUsuario;
        $this -> apellidoM = $apellidoMUsuario;
        $this -> nombre = $nombreUsuario;
        $this -> edad = $edadUsuario;
    }
}

// Creación de un objeto a partir de la clase
$objetoDeLaClase = new DesYConsDeClase("García", "López", "Ricardo", 34);

// Acceso de los valores 
$arrayParaVariasPropiedadesPrivadas = $objetoDeLaClase->getPropiedadesPrivadasComoArray();

// Impresión de la clase con los valores ingresados
echo "Acceso a propiedades privadas mediante getter: \n";
print_r($arrayParaVariasPropiedadesPrivadas);

foreach ($arrayParaVariasPropiedadesPrivadas as $indice => $valor) {
    echo "El valor en la posición " . $indice+1 . " es: $valor\n";
}
?>