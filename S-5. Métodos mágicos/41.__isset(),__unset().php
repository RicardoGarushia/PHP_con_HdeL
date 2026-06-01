<?php
header("Content-Type: text/plain");

echo "41. Métodos Mágicos: __isset() & __unset()\n\n";

echo "41.1 ¿Qué son los métodos mágicos?\n\n";

echo "Vease \"40.__get(),__set().php\"\n\n\n\n";


echo "41.2 ¿Para qué sirven los métodos mágicos?\n\n";

echo "Vease \"40.__get(),__set().php\"\n\n\n\n";


echo "41.3 Métodos mágicos __isset() y __unset()\n\n";

echo "Los métodos mágicos __isset() y __unset()
permiten gestionar el comportamiento de las funciones isset() y unset() cuando se aplican a propiedades: 
    a) INEXISTENTES. Es decir, nunca fueron declaradas en la clase.
    b) EXISTENTES, PERO NO ACCESIBLES. Es decir, fueron declaradas como \"private\" o \"protected\". 
Estos métodos permiten definir un comportamiento personalizado cuando 
se intenta verificar la existencia de una propiedad con isset()
o cuando se intenta eliminar una propiedad con unset().\n\n\n\n";


echo "41.3.1 Definición y sintaxis de __isset()\n\n";

echo "El método mágico __isset() se define dentro de una clase
y se invoca automáticamente cuando se utiliza la función isset()
para VERIFICAR si una PROPIEDAD está DEFINIDA y NO es null (almacena un valor, pues).\n\n";

echo "El método mágico __isset() devuelve un valor booleano:
    - true: Si la propiedad existe (o mejor dicho, está definida) y no es null.
    - false: Si la propiedad no existe (no está definida) o es null.\n\n";

echo "El método mágico __isset() se define dentro de una clase con la siguiente sintaxis: \n\n";

echo "public function __isset(string \$nombrePropiedad): bool {
    // Lógica personalizada para verificar si la propiedad existe y no es null
}\n\n\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n";

echo "<?php
class NombreDeLaClase {
    // Propiedades o atributos: 
    public \$id = 1234;
    public \$nombre; // Propiedad real de la clase

    
    public array \$datosCliente = [  // Array interno #1 para almacenar datos dinámicos
        \"dirección\"=> \"Av. Siempre Viva 123\"
    ];

    public array \$validacionDeDatosCliente = [  // Array interno #2 para almacenar datos dinámicos
        \"CURP\"=> \"GARM890123HDFRRL09\"
    ];

    // Métodos:

    // Constructor:

    // Destructor:

    // Métodos mágicos:
    public function __isset(string \$nombrePropiedad): bool { // Intercepta llamadas a isset() para propiedades no accesibles o no existentes
        // Lógica personalizada para verificar si la propiedad existe y no es null
        \$existePropiedadArregloDatosCliente = isset(\$this->datosCliente[\$nombrePropiedad]);
        \$existePropiedadArregloValidación = isset(\$this->validacionDeDatosCliente[\$nombrePropiedad]);

        echo \"-- Llamada __isset('\$nombrePropiedad'): \";

        if (\$existePropiedadArregloDatosCliente) {
            echo \"La propiedad \$nombrePropiedad existe en el arreglo datosCliente y no es null.\";
            return true;
        }
        elseif (\$existePropiedadArregloValidación) {
            echo \"La propiedad \$nombrePropiedad existe en el arreglo validación y no es null.\";
            return true;
        }
        else {
            echo \"La propiedad '\$nombrePropiedad' no está definida en los arrays internos o es null.\";
            return false;
        }
    }
}

\$objeto = new NombreDeLaClase();

if(isset(\$objeto->id)){ 
    echo \"Resultado IF: La propiedad está definida en las propiedades de la clase y no es null.\\n\";
}else{
    echo \"Resultado ELSE: La propiedad no está definida o es null.\\n\";
}?>\n\n";

class NombreDeLaClase
{
    // Propiedades o atributos: 
    public $id = 1234;
    public $nombre;



    public array $datosCliente = [  // Array interno #1 para almacenar datos dinámicos
        "dirección" => "Av. Siempre Viva 123"
    ];

    public array $validacionDeDatosCliente = [  // Array interno #2 para almacenar datos dinámicos
        "CURP" => "GARM890123HDFRRL09"
    ];

    // Métodos:

    // Constructor:

    // Destructor:

    // Métodos mágicos:
    public function __isset(string $nombrePropiedad): bool
    { // Intercepta llamadas a isset() para propiedades no accesibles o no existentes
        // Lógica personalizada para verificar si la propiedad existe y no es null
        $existePropiedadArregloDatosCliente = isset($this->datosCliente[$nombrePropiedad]);
        $existePropiedadArregloValidación = isset($this->validacionDeDatosCliente[$nombrePropiedad]);

        if ($existePropiedadArregloDatosCliente) {
            echo "La propiedad '{$nombrePropiedad}' existe en el arreglo datosCliente y no es null.\n";
            return $existePropiedadArregloDatosCliente;
        } elseif ($existePropiedadArregloValidación) {
            echo "La propiedad \"$nombrePropiedad\" existe en el arreglo validación y no es null.\n";
            return $existePropiedadArregloValidación;
        } else {
            echo "La propiedad \"$nombrePropiedad\" no está definida o es null.\n";
            return false;
        }
    }
}

$objeto = new NombreDeLaClase();
isset($objeto->id); // isset() puede ejecutar su trabajo. NO SE EJECUTA __isset()
isset($objeto->dirección);  // Se ejecuta __isset()
isset($objeto->CURP);   // Se ejecuta __isset()
isset($objeto->datoFalso);  // Se ejecuta __isset()


echo "\n\n\n\n41.3.2 Definición y sintaxis de __unset()\n\n";

echo "El método mágico __unset() se define dentro de una clase
y se invoca automáticamente cuando se utiliza la función unset()
para ELIMINAR una PROPIEDAD PÚBLICA (accesible).\n\n";

echo "El método mágico __unset() NO devuelve ningún valor.\n\n";

echo "El método mágico __unset() se define dentro de una clase con la siguiente sintaxis: \n\n";

echo "public function __unset(string \$nombrePropiedad): void {
    // Lógica personalizada para eliminar la propiedad
}\n\n\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n";

echo "
<?php
class OtraClase
{
    // Propiedades o atributos: 
    public \$eliminar = \"eliminar\";
    public array \$datosCliente = ['nombre' => 'Ricardo', 'edad' => 35];

    // Método mágico que intercepta unset(\$objeto->edad)
    public function __unset(string \$nombrePropiedad): void {
        echo \"Intentando eliminar la propiedad: {\$nombrePropiedad}\\n\";

        // Lógica de extensión: Comprueba si la clave existe en el array interno
        if (isset(\$this->datosCliente[\$nombrePropiedad])) {
            unset(\$this->datosCliente[\$nombrePropiedad]); // Elimina la clave del array interno
            echo \"La propiedad '{\$nombrePropiedad}' ha sido eliminada del array interno.\\n\";
        } else {
            echo \"La propiedad '{\$nombrePropiedad}' no existe en la colección de datos.\\n\";
        }
    }
}

\$otroObjeto = new OtraClase();
unset(\$otroObjeto->eliminar); // NO SE INVOCA el método __unset()
unset(\$otroObjeto->nombre); // Se invoca el método __unset() porque \"nombre\" NO es una propiedad declarada en la clase (es parte del array interno datosCliente)
unset(\$otroObjeto->apellido); // Probar con una propiedad no existente (por ejemplo, \"apellido\") para probar el método __unset()
?>\n\n";



class OtraClase
{
    // Propiedades o atributos: 
    public $eliminar = "eliminar";
    public array $datosCliente = ['nombre' => 'Ricardo', 'edad' => 35];

    // Método mágico que intercepta unset($objeto->edad)
    public function __unset(string $nombrePropiedad): void {
        echo "Intentando eliminar la propiedad: {$nombrePropiedad}\n";

        // Lógica de extensión: Comprueba si la clave existe en el array interno
        if (isset($this->datosCliente[$nombrePropiedad])) {
            unset($this->datosCliente[$nombrePropiedad]); // Elimina la clave del array interno
            echo "La propiedad '{$nombrePropiedad}' ha sido eliminada del array interno.\n";
        } else {
            echo "La propiedad '{$nombrePropiedad}' no existe en la colección de datos.\n";
        }
    }
}

$otroObjeto = new OtraClase();
unset($otroObjeto->eliminar); // NO SE INVOCA el método __unset()
unset($otroObjeto->nombre); // Se invoca el método __unset() porque "nombre" NO es una propiedad declarada en la clase (es parte del array interno datosCliente)
unset($otroObjeto->apellido); // Probar con una propiedad no existente (por ejemplo, "apellido") para probar el método __unset()




