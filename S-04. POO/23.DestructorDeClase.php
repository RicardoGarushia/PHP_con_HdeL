<?php
header("Content-Type: text/plain");

echo "\n23. POO: Destructores de objetos\n\n";

echo "Así como los constructores se encargan de la creación e inicialización de objetos, 
los destructores en PHP son métodos especiales que se ejecutan automáticamente 
cuando un objeto está a punto de ser destruido o cuando la ejecución del script finaliza.\n\n";

echo "23.1 Definición de un destructor en PHP:";
echo "Al igual que el constructor implícito, si no se define un destructor explícitamente en una clase, 
PHP proporcionará una \"destrucción implícita\" cuando un objeto deja de ser referenciado o al final del script. 
Esta destrucción implícita se encarga de:
a) Liberar la memoria que el objeto estaba utilizando.
b) Cerrar las referencias a otros recursos que el objeto pudiera tener (como archivos o conexiones a bases de datos).";

echo "Sin embargo, cuando necesitamos realizar ciertas acciones justo antes de que un objeto deje de existir 
(por ejemplo, cerrar conexiones a bases de datos, liberar recursos de archivos, guardar información de registro, etc.), 
es necesario definir un DESTRUCTOR EXPLÍCITO.";

echo "En PHP, un destructor se define como un método con un nombre reservado: 
__destruct(). Esta función no recibe valores, ni regresa valores. 
El propósito principal de un destructor explícito es realizar tareas de \"limpieza\" 
o finalización antes de que un objeto sea eliminado de la memoria. 
Esto asegura que los recursos utilizados por el objeto se liberen o cierren correctamente
y que cualquier estado persistente se actualice adecuadamente.";

echo "23.2 ¿Cuándo se ejecuta un destructor?";
echo "Un destructor se invoca en las siguientes circunstancias:
a) Cuando ya no existen referencias al objeto: Si todas las variables que apuntan a un objeto se eliminan (unset()) 
o se les asigna otro valor, y no hay otras referencias activas al objeto, PHP marcará ese objeto para su recolección de basura. 
El destructor se ejecutará en algún momento durante este proceso de recolección. 
Es importante notar que el momento exacto de la ejecución del destructor 
durante la recolección de basura no es determinístico y puede variar.
b) Al finalizar la ejecución del script: Cuando el script PHP termina de ejecutarse, 
todos los objetos que aún existan serán destruidos, y sus destructores serán llamados (si están definidos).";

echo "23.4 Ejemplo de un destructor explícito";

echo "El propósito principal de un constructor explícito es inicializar las propiedades del objeto 
y realizar cualquier configuración necesaria desde el inicio.\n\n";

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

    // Destructor EXPLÍCITO: Se define como un método con la palabra reservada __destruct 
    public function __destruct()
    {
        echo \"Se ha eliminado el objeto\";
    }
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
    
    // Destructor EXPLÍCITO: Se define como un método con la palabra reservada __destruct 
    public function __destruct()
    {
        echo "Se ha eliminado el objeto";
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