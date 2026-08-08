<?php
header("Content-Type: text/plain");

echo "40. Métodos Mágicos: __get() & __set()\n\n";

echo "40.1 ¿Qué son los métodos mágicos?\n\n";

echo "Los métodos mágicos (Magic Methods) son funciones de clase especiales en PHP
que tienen nombres reservados que comienzan con un doble guion bajo (__), como:
__construct (22.ConstructExplicito.php), __destruct (23.DestructorDeClase.php),
__get, __set... y otros que veremos en ejercicios posteriores.\n\n";

echo "A diferencia de los métodos normales que tú llamas explícitamente (\$objeto->funcionHacerAlgo()), 
los métodos mágicos son invocados automáticamente por el intérprete de PHP
en respuesta a ciertos eventos o situaciones. Actúan como hooks o interceptores.\n\n";

echo "Su principal utilidad es permitir que las clases definan
CÓMO DEBEN COMPORTARSE ANTE ACCIONES QUE, de otro modo, 
CAUSARÍAN UN ERROR O TENDRÍAN UN COMPORTAMIENTO PREDETERMINADO NO DESEADO.\n\n\n\n";



echo "40.2 ¿Para qué sirven los métodos mágicos?\n\n";

echo "Los métodos mágicos se utilizan para extender, interceptar o modificar
el comportamiento de las operaciones comunes (como leer, escribir, comprobar existencia o llamar a un método)
cuando estas operaciones se realizan sobre propiedades o métodos que no existen o son inaccesibles en la clase.\n\n";

echo "Este mecanismo es lo que permite que las clases en frameworks sean tan flexibles, 
ya que pueden simular tener un número ilimitado de propiedades y métodos sin tener que declararlos explícitamente.\n\n\n\n";


echo "40.3 Métodos mágicos __get() y __set()\n\n";

echo "Los métodos mágicos __get() y __set() 
son utilizados para interceptar el acceso a propiedades que no son accesibles directamente, ya sea porque son: 
    a) INEXISTENTES. Es decir, nunca fueron declaradas en la clase.
    b) EXISTENTES, PERO NO ACCESIBLES. Es decir, fueron declaradas como \"private\" o \"protected\". 
Estos métodos permiten definir un comportamiento personalizado 
cuando se intenta leer o escribir en dichas propiedades.\n\n\n\n";



echo "40.3.1 Definición y sintaxis de __get()\n\n";

echo "El método mágico __get() se invoca automáticamente cuando se intenta OBTENER el valor de una propiedad: 
    a) INEXISTENTE. Es decir, nunca fueron declaradas en la clase. 
    b) EXISTENTE, PERO NO ACCESIBLE. Es decir, fueron Fueron declaradas como \"private\" o \"protected\", 
y tú intentas acceder a ellas desde fuera de su ámbito permitido (por ejemplo, desde el código principal).\n\n";

echo "El método mágico __get() devuelve el valor que se intentó leer, el cual será usado por la expresión de código.
Por lo tanto, el valor de retorno es \"mixed\" (cualquier tipo, como \"string\", \"int\", \"null\", \"object\", etc.) \n\n";

echo "El método mágico __get() se define dentro de una clase con la siguiente sintaxis:\n\n";

echo "public function __get(\$nombrePropiedad) { // Valor de retorno esperado mixed (string, int, null, object, etcétera)
    // Lógica para manejar la OBTENCIÓN del valor de la propiedad NO ACCESIBLE o NO EXISTENTE
    }\n\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n";

echo "<?php
class Cerveza
{
    // Propiedades o atributos: 
    public \$nombreCerveza;
    protected \$ingredientes = \"malta, lúpulo, levadura y agua\";
    private \$stockCerveza;


    // Métodos:

    // Constructor: Se define como un método con la palabra reservada __construct 
    // public function __construct(\$nombre, \$stock)
    {
        \$this->nombreCerveza = \$nombre;
        \$this->stockCerveza = \$stock;
    }


    // Destructor:


    // Métodos mágicos:
    public function __get(\$nombrePropiedad): string    // Valor de retorno esperado mixed (string, int, null, object, etcétera)
    {
        // Lógica para manejar la OBTENCIÓN del valor de la propiedad NO ACCESIBLE o NO EXISTENTE
        if (property_exists(\$this, \$nombrePropiedad)) {
            return \"La propiedad \\\"\$nombrePropiedad\\\" existe, pero NO ES ACCESIBLE por este medio\";
        } else {
            return \"La propiedad \\\"\$nombrePropiedad\\\" NO EXISTE\";
        }
    }
}

\$instancia = new Cerveza(\"Corona\", true);
echo \"SALIDA TRAS EJECUTAR EL CÓDIGO:\\n\";
echo \"Nombre de la cerveza: \" . \$instancia->nombreCerveza . \"\\n\";
echo \"Ingredientes de la cerveza: \" . \$instancia->ingredientes . \"\\n\";
echo \"Stock de la cerveza: \" . \$instancia->stockCerveza . \"\\n\";
echo \"Creador de la receta: \" . \$instancia->autorRecetaCerveza . \"\\n\\n\\n\";\n\n\n";


class Cerveza
{
    // Propiedades o atributos: 
    public $nombreCerveza;
    protected $ingredientes = "malta, lúpulo, levadura y agua";
    private $stockCerveza;


    // Métodos:
    /* MÉTODO GETTER con VISIBILIDAD PÚBLICA para acceder a propiedades privadas y protegidas
    RECORDAR: Es más recomendable utilizar métodos públicos (getters y setters)
    para acceder y modificar propiedades privadas o protegidas,
    en lugar de hacer las propiedades directamente públicas.
    */
    public function getIngredientes(){
        return $this->ingredientes;
    }


    // Constructor: Se define como un método con la palabra reservada __construct 
    public function __construct($nombre, $stock)
    {
        $this->nombreCerveza = $nombre;
        $this->stockCerveza = $stock;
    }

    // Destructor:

    // Métodos mágicos:
    public function __get($nombrePropiedad): string     // Valor de retorno esperado mixed (string, int, null, object, etcétera)
    {
        // Lógica para manejar la OBTENCIÓN del valor de la propiedad NO ACCESIBLE o NO EXISTENTE
        echo "Intento inadecuado de OBTENCIÓN de información para: $nombrePropiedad\n";
        if (property_exists($this, $nombrePropiedad)) {
            return "La propiedad \"$nombrePropiedad\" existe, pero NO ES ACCESIBLE por este medio";
        } else {
            return "La propiedad \"$nombrePropiedad\" NO EXISTE";
        }
    }
}

$instancia = new Cerveza("Corona", true);
echo "SALIDA TRAS EJECUTAR EL CÓDIGO:\n";
echo "Nombre de la cerveza: " . $instancia->nombreCerveza . "\n";   // Salida: Corona
echo "Ingredientes de la cerveza: " . $instancia->ingredientes . "\n"; // Salida: La propiedad ingredientes existe pero no es accesible directamente    
echo "Stock de la cerveza: " . $instancia->stockCerveza . "\n";      // Salida: La propiedad stockCerveza existe pero no es accesible directamente
echo "Creador de la receta: " . $instancia->autorRecetaCerveza . "\n";
echo "Ingredientes de la cerveza (ACCESO CORRECTO mediante método getter): " . $instancia->getIngredientes() . "\n\n\n\n";


echo "40.3.2 Definición y sintaxis de __set()\n\n";

echo "El método mágico __set() se invoca automáticamente cuando se intenta ASIGNAR el valor de una propiedad:
    a) INEXISTENTE. Es decir, nunca fueron declaradas en la clase. 
    b) EXISTENTE, PERO NO ACCESIBLE. un valor a una propiedad que no es accesible directamente.\n\n"; 

echo "El método mágico __set() NO DEVUELVE NINGÚN VALOR (void) y
su función principal es manejar la ASIGNACIÓN de manera controlada y personalizada.\n\n";
    
echo "El método __set() se define dentro de una clase con la siguiente sintaxis:\n\n";

echo "public function __set(\$nombrePropiedad, \$valor): void { // Sin valor de retorno
    // Lógica para manejar la ASIGNACIÓN del valor a la propiedad NO ACCESIBLE o NO EXISTENTE
    }\n\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n";

echo "<?php
class Cerveza
{
    // Propiedades o atributos: 
    public \$nombreCerveza;
    protected \$ingredientes = \"malta, lúpulo, levadura y agua\";
    private \$stockCerveza;


    // Métodos:

    // Constructor: Se define como un método con la palabra reservada __construct 
    public function __construct(\$nombre, \$stock)
    {
        \$this->nombreCerveza = \$nombre;
        \$this->stockCerveza = \$stock;
    }


    // Destructor:


    // MÉTODOS MÁGICOS: 
    // __GET():
    public function __get(\$nombrePropiedad): string
    {
        // Lógica para manejar la OBTENCIÓN del valor de la propiedad NO ACCESIBLE o NO EXISTENTE
        if (property_exists(\$this, \$nombrePropiedad)) {
            return \"La propiedad \\\"\$nombrePropiedad\\\" existe, pero NO ES ACCESIBLE por este medio\";
        } else {
            return \"La propiedad \\\"\$nombrePropiedad\\\" NO EXISTE\";
        }
    }

    // __SET():
    public function __set(\$nombrePropiedad, \$valor): void {
        // Lógica para manejar la ASIGNACIÓN del valor a la propiedad NO ACCESIBLE o NO EXISTENTE
        echo \"Accediendo a la propiedad: \$nombrePropiedad\\n\";
        if (property_exists(\$this, \$nombrePropiedad)) {
            echo \"La propiedad \"\$nombrePropiedad\" existe, pero NO ES ACCESIBLE por este medio\";
        } else {
            echo \"La propiedad \\\"\$nombrePropiedad\\\" NO EXISTE\";
        }
    }
}

\$instancia = new Cerveza(\"Corona\", true);
echo \"SALIDA TRAS EJECUTAR EL CÓDIGO:\\n\";
echo \"Nombre de la cerveza: \" . \$instancia->nombreCerveza . \"\\n\";
echo \"Ingredientes de la cerveza: \" . \$instancia->ingredientes . \"\\n\";
echo \"Stock de la cerveza: \" . \$instancia->stockCerveza . \"\\n\";
echo \"Creador de la receta: \" . \$instancia->autorRecetaCerveza . \"\\n\\n\\n\";

\$instancia->nombreCerveza=\"Indio\"; 
\$instancia->ingredientes=\"No lo sé\"; 
\$instancia->stockCerveza=\"Quien sabe\"; \n\n\n
\$instancia->autorRecetaCervezaIndicio=\"Juanito Camaney\"; 

echo \"SALIDA TRAS TRATAR DE REALIZAR LA ASIGNACIÓN:\\n\";
echo \"Nombre de la cerveza: \" . \$instancia->nombreCerveza . \"\\n\";
echo \"Ingredientes de la cerveza: \" . \$instancia->ingredientes . \"\\n\";
echo \"Stock de la cerveza: \" . \$instancia->stockCerveza . \"\\n\";
echo \"Creador de la receta: \" . \$instancia->autorRecetaCerveza . \"\\n\\n\\n\";\n\n\n";


class Cerveza2
{
    // Propiedades o atributos: 
    public $nombreCerveza;
    protected $ingredientes = "malta, lúpulo, levadura y agua";
    private $stockCerveza;


    // Métodos:

    // Constructor: Se define como un método con la palabra reservada __construct 
    public function __construct($nombre, $stock)
    {
        $this->nombreCerveza = $nombre;
        $this->stockCerveza = $stock;
    }


    // Destructor:


    // MÉTODOS MÁGICOS: 
    // __GET():
    public function __get($nombrePropiedad): string
    {
        // Lógica para manejar la OBTENCIÓN del valor de la propiedad NO ACCESIBLE o NO EXISTENTE
        if (property_exists($this, $nombrePropiedad)) {
            return "La propiedad \"$nombrePropiedad\" existe, pero NO ES ACCESIBLE por este medio";
        } else {
            return "La propiedad \"$nombrePropiedad\" NO EXISTE";
        }
    }

    // __SET():
    public function __set($nombrePropiedad, $valor): void {
        // Lógica para manejar la ASIGNACIÓN del valor a la propiedad NO ACCESIBLE o NO EXISTENTE
        echo "Intento inadecuado de ASIGNACIÓN a: $nombrePropiedad\n";
        echo "La propiedad \"$nombrePropiedad\" NO EXISTE\n";
    }
}

$instancia2 = new Cerveza2("Corona", true);
echo "SALIDA TRAS EJECUTAR EL CÓDIGO:\n";
echo "Nombre de la cerveza: " . $instancia2->nombreCerveza . "\n";
echo "Ingredientes de la cerveza: " . $instancia2->ingredientes . "\n";
echo "Stock de la cerveza: " . $instancia2->stockCerveza . "\n";
echo "Creador de la receta: " . $instancia2->autorRecetaCerveza . "\n\n\n";

$instancia2->nombreCerveza="Indio"; 
// $instancia->ingredientes="No lo sé";    // Muestra mensaje de error
// $instancia->stockCerveza="Quien sabe";  // Muestra mensaje de error
$instancia2->autorRecetaCervezaIndio="Juanito Camaney"; 

echo "\n\n\nSALIDA TRAS TRATAR DE REALIZAR LA ASIGNACIÓN:\n";
echo "Nombre de la cerveza: " . $instancia2->nombreCerveza . "\n";
echo "Ingredientes de la cerveza: " . $instancia2->ingredientes . "\n";
echo "Stock de la cerveza: " . $instancia2->stockCerveza . "\n";
echo "Creador de la receta: " . $instancia2->autorRecetaCervezaIndio . // GEMINI ¿Por qué se realiza la asignación, si no está declarada la propiedad $autorRecetaCervezaIndio en la clase Cerveza2?

"\n\n\n"; 

echo "40.3.3 ACCESO DINÁMICO O PROPIEDADES MÁGICAS\n";

echo "Se le conoce como PROPIEDADES MÁGICAS o ACCESO DINÁMICO a la acción de usar __get() y __set()
para leer y escribir en un array interno a una clase (\$this->data) para lograr FLEXIBILIDAD.\n\n";

echo "De esta manera, puedes lograr: 
a) Flexibilidad y manejo de propiedades ilimitadas. 
    Al simular la existencia de propiedades que no están declaradas explícitamente en la clase.
    Por ejemplo:
        Si tu clase Persona solo necesita nombre y email, podrías declararlas.
        Pero, ¿qué pasa si necesitas 20 o 50 atributos que varían (como datos de perfil, configuración, o metadatos)?
            * Sin __get(), ni __set(): Tendrías que declarar esas 50 propiedades en la clase, volviendo el código verbose.
            * Con __get(), ni __set(): Solo declaras el array interno (\$datos). 
                Puedes asignar cualquier propiedad al objeto, y el método mágico la intercepta y la guarda en el array automáticamente:
b) Implementación del Patrón Active Record. -> La más común en frameworks (como Laravel) y ORMs.
    Al permitir que una clase maneje dinámicamente los campos de una tabla de base de datos sin necesidad de declarar cada campo como una propiedad separada.
    Por ejemplo: 
        * Cuando pides \$user->name, el __get() se activa, no encuentra la propiedad en la clase, y entonces va a buscar el valor en la base de datos o en un array de resultados ya cargado.
        * Cuando asignas \$user->name = 'Juan', el __set() intercepta, guarda el valor en un array interno (p. e., \$datosCliente), y marca que ese campo necesita ser actualizado en la base de datos.
c) Lógica de Intercepción Centralizada. 
    Los métodos mágicos te permiten ejecutar lógica antes o después de la asignación/lectura, 
    algo que no se puede hacer con una propiedad public simple.
    Por ejemplo: 
        * __set() para: 
                Validación: Asegurarte de que el valor sea correcto antes de guardarlo. 
                Sanitización: Limpiar datos (p. ej., eliminar scripts maliciosos) antes de la asignación.
        * __get() para:
                Cálculo: Devolver la edad calculándola a partir de la fecha de nacimiento (en lugar de guardar la edad).
                Formato: Formatear una fecha o un número antes de devolverlo.\n\n\n\n";


echo "40.3.3.1 Ejemplo de Flexibilidad y manejo de propiedades ilimitadas.\n\n";

echo "<?php
class Cliente {
    // Propiedades o atributos: 
    public array \$datosCliente = []; // Array interno para almacenar datos dinámicos

    // Métodos mágicos:
    public function __get(\$nombrePropiedad): mixed {
        // Retorna el valor si existe en el array, sino null
        // Uso de null coalescing operator (??)
        return \$this->datosCliente[\$nombrePropiedad] ?? null;
    }

    public function __set(\$nombrePropiedad, \$valor): void {
        // Asigna el valor al array interno
        \$this->datosCliente[\$nombrePropiedad] = \$valor;
    }
}

\$cliente = new Cliente();
\$cliente->nombre = \"Ana\"; // Llama a __set() -> \$datosCliente['nombre'] = \"Ana\"
\$cliente->email = \"ejemplo@gmail.com\"; // Llama a __set() -> \$datosCliente['email'] = \"ejemplo@gmail.com\"
\$cliente->telefono = \"555-1234\"; // Llama a __set() -> \$datosCliente['telefono'] = \"555-1234\"
// Otras pinchemil propiedades dinámicas por agregar...

echo \"Nombre: \" . \$cliente->nombre . \"\\n\"; // Llama a __get('nombre')
echo \"Email: \" . \$cliente->email . \"\\n\"; // Llama a __get('email')
echo \"Teléfono: \" . \$cliente->telefono . \"\\n\"; // Llama a __get('telefono')
?>\n\n";

class Cliente {
    // Propiedades o atributos: 
    public array $datosCliente = []; // Array interno para almacenar datos dinámicos

    // Métodos:

    // Constructor:

    // Destructor:
    
    // Métodos mágicos:
    public function __get($nombrePropiedad):mixed {
        // Retorna el valor si existe en el array, sino null
        return $this->datosCliente[$nombrePropiedad] ?? null;
    }

    public function __set($nombrePropiedad, $valor): void {
        // Asigna el valor al array interno
        $this->datosCliente[$nombrePropiedad] = $valor;
    }
}

$cliente = new Cliente();
$cliente->nombre = "Ana"; // No existe la propiedad 'nombre', se guarda en el array
$cliente->email = "ejemplo@gmail.com"; // No existe la propiedad 'email', se guarda en el array
$cliente->telefono = "555-1234"; // No existe la propiedad 'telefono', se guarda en el array
// Otras pinchemil propiedades dinámicas por agregar...

echo "Nombre: " . $cliente->nombre . "\n"; // Accede a 'nombre' desde el array
echo "Email: " . $cliente->email . "\n"; // Accede a 'email' desde el array
echo "Teléfono: " . $cliente->telefono . "\n\n\n"; // Accede a 'telefono' desde el array


echo "40.3.4 RESUMEN\n";

echo "Los métodos mágicos __get() y __set() son herramientas poderosas en PHP
para gestionar el acceso a propiedades de una clase de manera controlada y personalizada.
Permiten definir comportamientos específicos cuando se intenta leer o escribir, respectivamente, en propiedades
que no son accesibles directamente, ya sea porque no existen o porque su visibilidad lo impide.\n\n";


