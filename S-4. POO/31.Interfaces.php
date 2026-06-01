<?php

header("Content-Type: text/plain");

echo "\n31. INTERFACES\n\n";
echo "31.1 Definición de interfaces en PHP\n";
echo "Las interfaces son un tipo especial de estructura que: 
+ DEFINE UN CONJUNTO DE MÉTODOS PÚBLICOS (visualización public) que son IMPLÍCITAMENTE ABSTRACTOS (no contienen cuerpo o implementación, ni requieren la palabra reservada \"abstract\")
+ QUE UNA CLASE TIENE QUE IMPLEMENTAR si se compromete a ello (palabra reservada \"implements\"), sin especificar cómo deben hacerlo.

Es decir, una interfaz actúa como un CONTRATO dado que cualquier clae que implemente dicha interfaz
se compromete a definir todos sus métodos.

La funcionalidad principal de las interfaces se centra en tres pilares del diseño de software:
1) ABSTRACCIÓN: Define el QUÉ se debe hacer (el contrato), ocultando el CÓMO se hará (la implementación).
2) POLIMORFISMO: Permite que objetos de diferentes clases se manejen de manera uniforme a través del tipo de la interfaz.
3) DESACOPLAMIENTO: Rompe la dependencia directa entre clases, haciendo que una clase dependa de la abstracción (la interfaz) en lugar de una clase concreta.
\n\n\n";


echo "31.2 Objetivo de las interfaces en PHP\n";
echo "El objetivo de las interfaces es establecer una ESTRUCTURA COMÚN ENTRE CLASE NO RELACIONADAS
al forzar a dichas clases a implementar ciertos métodos. Esto se conoce como 
PROGRAMACIÓN ORIENTADA A INTERFACES y es fundamental para la flexibilidad y el DESACOPLAMIENTO del código.
\n";

echo "31.2.1 Inversión de Dependencias (DIP) y Flexibilidad\n";
echo "Las interfaces son cruciales para aplicar el principio de INVERSIÓN DE DEPENDENCIAS (DIP). 
En lugar de que una clase de alto nivel (el \"cliente\" o consumidor)
dependa de una clase de bajo nivel (el \"servicio\" o proveedor), 
ambas dependen de la misma abstracción (la interfaz). 
Esto se logra típicamente mediante:
+ Inyección de Dependencias por Constructor: 
Pasando el objeto de la clase implementadora como argumento del constructor.
\n\n\n";


echo "31.3 Características principales de las interfaces en PHP\n";
echo "Las características principales de las interfaces en PHP son: 
a) Las interfaces definen métodos abstractos con visibilidad pública (PUBLIC).
b) Las interfaces NO pueden contener variables o propiedades de instancia. Sólo se permiten constantes (implícitamente públicas y de acceso estático). 
c) NO se pueden crear instancias (OBJETOS) desde las interfaces.
d) Las clases implementan interfaces y están obligadas a implementar los métodos definidos en cada interfaz implementada. 
e) Las interfaces pueden extender otras interfaces utilizando la palabra clave extends, creando jerarquía de interfaces.
\n\n\n";


echo "31.4 Semejanzas y diferencias entre clases abstractas e interfaces\n";
echo "Entre las SEMEJANZAS tenemos: 
a) No se pueden instanciar directamente dado que su propósito es
ser extendidas o implementadas por clases concretas.
b) Se usan como base para otras clases al implementar un \"contrato\"
al definir los métodos que deben de implementar las clases que los usen. 
c) Obligan a implementar métodos. 
d) Ayudan al diseño orientado a objetos al promover 
la abstracción mediante la ocultación de detalles de implementación específicos de cada clase concreta
el polimorfismo al permitir tratar objetos de diferentes clases de manera uniforme 
al compartir un interfaz o heredar de una misma clase abstracta.\n\n";

echo "Entre las DIFERENCIAS tenemos: 
a) La clase abstracta puede tener métodos implementados; 
mientras que la interfaz solo define la firma del método.
b) La clase abstracta puede tener atributos, propiedades, variables o constantes; 
mientras que la interfaz sólo puede utilizar constantes. 
c) La clase abstracta puede emplear public, protected, o private en sus métodos y propiedades; 
mientras que la interfaz solo fuerza el contrato para métodos public.
d) Una clase solo puede heredar de una clase abstracta;
mientras que una clase puede implementar múltiples interfaces
e) Una clase abstracta puede tener constructores (para inicializar el estado);
mientras que una interfaz no puede tener constructores.\n\n\n";


echo "31.5 ¿Cuándo utilizar una clase abstracta y cuándo una interfaz?\n";
echo "Utiliza una interfaz cuando: 
a) Quieras definir un contrato que varias clases deben cumplir.
b) Necesites HERENCIA MÚLTIPLE DE COMPORTAMIENTO 
(PHP no permite heredar de varias clases, 
pero si implementar múltiples interfaces) 
c) No necesites definir atributos ni lógica compartida.
d) Quieras flexibilidad máxima entre clases no relacionadas.
\n\n";

echo "Utiliza una clase abstracta cuando: 
a) Quieras tener una base común con lógica compartida.
b) Necesites definir atributos comunes para las clases hijas.
c) Quieras implementar parte del comportamiento que será igual en todas las subclases.
d) Estás modelando una jerarquía estrechamente relacionada (por ejemplo, todos son tipos de una misma Clase).\n\n";

echo "En resumen, una interfaz responde a la pregunta ¿qué puede hacer?; 
mientras que una clase abstracta responde a ¿qué es y qué puede hacer? \n\n\n";


echo "31.6 Sintaxis de interfaz\n";
echo "Se declaran de manera similar a las clases, pero utilizando la palabra clave interface en lugar de class.\n\n";
echo "<?php
interface NombreDeLaInterface {
    public function Método1(-si corresponde- datatype parámetro1, datatype parámetro2, datatype parámetroN): datatypeRetorno;
    public function Método2(-si corresponde- datatype parámetro1, datatype parámetro2, datatype parámetroN): datatypeRetorno;
    public function MétodoN(-si corresponde- datatype parámetro1, datatype parámetro2, datatype parámetroN): datatypeRetorno;
}
?>\n\n\n";

echo "31.7 Ejemplo práctico de interfaz\n";
echo "<?php
// INTERFACES
// Definición de la interfaz EnviarDatos (Interfaz A) 
interface EnviarDatos {
    public function enviar(string \$message): void; // Función A de Interfaz A
}
// Definición de la interfaz GuardarDatos (Interfaz B) 
interface GuardarDatos {
    public function guardar(): void; // Función A de Interfaz B
}

// CLASES
// CLASE IMPLEMENTADORA DE LA INTERFAZ #1
// Definición de la clase Servidor que IMPLEMENTA ambas interfaces
class Servidor implements EnviarDatos, GuardarDatos {
    public function enviar(string \$message): void {
        echo \"Se envia la venta\\n\" . \$message ;
    }
    public function guardar(): void {
        echo \"Se guarda la venta en una BASE DE DATOS\\n\";
    }
}
// CLASE IMPLEMENTADORA DE LA INTERFAZ #2
// Definición de la clase Nube que IMPLEMENTA la interfaz GuardarDatos
class Nube implements GuardarDatos {
    public function guardar(): void {
        echo \"Se guarda la venta en LA NUBE\\n\";
    }
}
// CLASE IMPLEMENTADORA DE LA INTERFAZ #3
// Definición de la clase USB que IMPLEMENTA ambas interfaces
class USB implements EnviarDatos, GuardarDatos {
    public function enviar(string \$message): void {
        echo \"Se envia la venta\\n\" . \$message ;
    }
    public function guardar(): void {
        echo \"Se guarda la venta en UNA USB\\n\";
    }
}

// CLASE CONSUMIDORA #1: Recibe el objeto de las clases implementadoras 
// Declaración de variable que almacena una instancia (objeto) de una clase que haya declarado implementar la interfaz GuardarDatos.
// Por tanto, cualquier objeto que se quiera asignar a la propiedad \$guardado tiene que ser 
// una instancia de una clase que haya declarado explícitamente implementar la interfaz GuardarDatos 
// utilizando la palabra clave implements.
class ProcesadorDeDatos {
    private GuardarDatos \$guardado;

    // El constructor tiene como parámetro recibir un objeto que implemente la interfaz de GuardarDatos.
    // Esto es un ejemplo de inyección de dependencias, donde la forma específica de guardar los datos se decide externamente.
    public function __construct(GuardarDatos \$procesoDeGuardado){
        \$this->guardado = \$procesoDeGuardado;
    }

    public function procesar(): void {
        echo \"Procesando la información\\n\";
        \$this->guardado->guardar();
    }
}

// FUNCIÓN CONSUMIDORA #1: Recibe el objeto de las clases implementadoras
function ProcesarDatos(GuardarDatos \$objeto): void
{
    // La función acepta cualquier objeto que implemente la interfaz GuardarDatos
    // y llama a su método guardar().
    \$objeto->guardar();
}

\$nube = new Nube();
\$servidor = new Servidor();
\$usb = new USB();
// Creación del objeto ProcesadorDeDatos,
// Intercalar entre el objeto \$nube y el objeto \$servidor
\$guardado = new ProcesadorDeDatos(procesoDeGuardado: \$usb);
\$guardado->procesar();
// Ejecución de la función ProcesarDatos,
// Llamada a la función consumidora con el objeto \$nube
ProcesarDatos(\$nube);

Tanto una función como una clase pueden recibir objetos de clases que implementan una interfaz.
En el ejemplo anterior, la clase ProcesadorDeDatos recibe en su constructor un objeto que implementa la interfaz GuardarDatos, permitiendo que el método procesar() funcione con cualquier clase que cumpla ese contrato.
De igual forma, la función ProcesarDatos acepta como argumento cualquier objeto que implemente la interfaz GuardarDatos y puede invocar su método guardar().
Esto demuestra cómo las interfaces permiten escribir código flexible y desacoplado, ya que tanto funciones como clases pueden trabajar con cualquier objeto que cumpla con la interfaz, sin importar su implementación concreta.

?>\n\n\n";

// INTERFACES
// Definición de la interfaz EnviarDatos (Interfaz A) 
interface EnviarDatos {
    public function enviar(string $message);    // Función A de Interfaz A
}
// Definición de la interfaz GuardarDatos (Interfaz B) 
interface GuardarDatos {
    public function guardar();  // Función A de Interfaz B
}

// CLASES
// CLASE IMPLEMENTADORA DE LA INTERFAZ #1
// Definición de la clase Servidor que IMPLEMENTA ambas interfaces
class Servidor implements EnviarDatos, GuardarDatos {
    public function enviar(string $message): void {
        echo "Se envia la venta\n" . $message ;
    }
    public function guardar(): void {
        echo "Se guarda la venta en una BASE DE DATOS\n";
    }
}
// CLASE IMPLEMENTADORA DE LA INTERFAZ #2
// Definición de la clase Nube que IMPLEMENTA la interfaz GuardarDatos
class Nube implements GuardarDatos {
    public function guardar(): void {
        echo "Se guarda la venta en LA NUBE\n";
    }
}
// CLASE IMPLEMENTADORA DE LA INTERFAZ #3
// Definición de la clase USB que IMPLEMENTA ambas interfaces
class USB implements EnviarDatos, GuardarDatos {
    public function enviar(string $message): void {
        echo "Se envia la venta\n" . $message ;
    }
    public function guardar(): void {
        echo "Se guarda la venta en UNA USB\n";
    }
}


// CLASE CONSUMIDORA #1: Recibe el objeto de las clases implementadoras 
class ProcesadorDeDatos {
    // Declaración de variable que almacena una instancia (objeto) de una clase que haya declarado implementar la interfaz GuardarDatos.
    // Por tanto, cualquier objeto que se quiera asignar a la propiedad $saveManager tiene que ser 
    // una instancia de una clase que haya declarado explícitamente implementar la interfaz GuardarDatos 
    // utilizando la palabra clave implements.
    private GuardarDatos $guardado;

    // El constructor tiene como parámetro recibir un objeto que implemente la interfaz de GuardarDatos.
    // Esto es un ejemplo de inyección de dependencias, donde la forma específica de guardar los datos se decide externamente.
    public function __construct(GuardarDatos $procesoDeGuardado){
        $this->guardado = $procesoDeGuardado;
    }

    public function procesar(): void {
        echo "Procesando la información mediante la CLASE consumidora\n";
        $this->guardado->guardar();
    }
}

// FUNCIÓN CONSUMIDORA #1: Recibe el objeto de las clases implementadoras
function ProcesarDatos(GuardarDatos $objeto): void
{
    // La función acepta cualquier objeto que implemente la interfaz GuardarDatos
    // y llama a su método guardar().
    echo "Procesando la información mediante la FUNCIÓN consumidora\n";
    $objeto->guardar();
}

$nube = new Nube();
$servidor = new Servidor();
$usb = new USB();
// Creación del objeto ProcesadorDeDatos,
$guardado = new ProcesadorDeDatos(procesoDeGuardado: $usb);    // Intercalar entre el objeto $nube y el objeto $servidor
$guardado->procesar();
// Ejecución de la función ProcesarDatos,
ProcesarDatos(objeto: $nube); // Llamada a la función consumidora con el objeto $nube


echo"\n\nLa clase Nube y la clase Servidor ofrecen 
una forma de guardar datos al implementar la interfaz GuardarDatos. 
Al hacer esto, están obligadas a proporcionar una implementación para 
la función (método) guardar().
La clase ProcesadorDeDatos declara que necesita un ATRIBUTO DE INSTANCIA
(también conocido como PROPIEDAD DE INSTANCIA o VARIABLE DE INSTANCIA)
llamada \$saveManager que sea un objeto de una clase que haya implementado la interfaz GuardarDatos. 
Por lo tanto, ProcesadorDeDatos depende de la capacidad de 'guardar' proporcionada por otra clase (como Nube o Servidor)
para que la ejecución de su propia función (método) procesar() sea exitosa.\n\n";

echo"En términos técnicos, las clases Nube y Servidor implementan la interfaz GuardarDatos. 
Esta implementación las obliga a definir un método público llamado guardar().
Por su parte, la clase ProcesadorDeDatos declara una propiedad privada (\$saveManager) 
con un type hint de la interfaz GuardarDatos. 
+ Rol de la Interfaz: Actúa como el Type Hint en el constructor (GuardarDatos \$gestionDeGuardado), 
garantizando que cualquier objeto que se le pase cumplirá el contrato (QUÉ hacer).
+ Rol de la Clase Consumidora: ProcesadorDeDatos utiliza la propiedad \$saveManager para invocar el método guardar(). 
La clase depende de la abstracción (GuardarDatos) para la funcionalidad de guardar,
ignorando por completo la implementación específica (CÓMO se guarda).

Además, la función ProcesarDatos demuestra que no solo las clases, sino también las funciones pueden recibir objetos de clases que implementan una interfaz, permitiendo invocar el método definido en la interfaz sin importar la clase concreta del objeto.

En términos técnicos:
Esta técnica de pasar la dependencia a través del constructor, 
utilizando la Interfaz como Type Hint (GuardarDatos \$procesoDeGuardado),
se denomina INYECCIÓN DE DEPENDENCIAS POR CONSTRUCTOR. 
Es el principal mecanismo para lograr un código DESACOPLADO y POLIMÓRFICO,
ya que permite a la clase de alto nivel (ProcesadorDeDatos)
depender de la abstracción (la interfaz GuardarDatos), 
cumpliendo así con el Principio de Inversión de Dependencias (DIP).

Cuando usas el nombre de una interfaz como Type Hint, 
estás haciendo una declaración muy importante:
\"No me importa si me pasas un objeto \$Nube, un objeto \$Servidor o un objeto \$USB. 
Solo me importa que el objeto que me pases haya implementado el contrato GuardarDatos.\"
Esto permite que la clase ProcesadorDeDatos sea extremadamente flexible y reutilizable,
ya que puede trabajar con cualquier clase que implemente la interfaz, por lo que:
a) Garantiza que el objeto inyectado siempre tendrá el método guardar(), lo que evita errores en tiempo de ejecución.
b) Permite que la clase consumidora (ProcesadorDeDatos) dependa de la abstracción (GuardarDatos) y no de una implementación concreta (Servidor).
c) Puedes intercambiar fácilmente el objeto USB por el objeto Nube sin cambiar una sola línea de código dentro de la clase ProcesadorDeDatos. 
El Type Hint de la interfaz es lo que hace posible este comportamiento polimórfico.
En resumen, el Type Hint es una herramienta de tipado estático que le añade seguridad, previsibilidad y claridad a tu código."
?>