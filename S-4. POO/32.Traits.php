<?php

header("Content-Type: text/plain");

echo"\n32. TRAITS (Rasgos)\n\n";

echo"32.1 ¿Qué son los traits?\n";
echo"Los traits (rasgos) son un mecanismo para la reutilización de código en lenguajes de herencia simple, como PHP, 
que buscan reducir las propias limitaciones de la herencia simple. Dado que, si bien la herencia simple simplifica la
jerarquía de clases, puede dificultar la reutilización de código cuando se desea compartir funcionalidad entre clases 
que no están relacionadas por una relación \"es-un\" (is-a).\n\n";

echo "En específico, dado que PHP solo admite \"Herencia Única\", es decir, 
una clase hija solo puede heredar de una única clase padre. 
¿Qué hacer si una clase hija necesita heredar múltiples comportamientos?
Aquí es dónde los traits entran a resolver esta interrogante.\n\n";

echo"Los rasgos se utilizan para declarar métodos que pueden usarse en varias clases. 
Pueden tener métodos y métodos abstractos que pueden usarse en varias clases, y 
los métodos pueden tener cualquier modificador de acceso (público, privado o protegido).\n\n";

echo"Los traits provienen de los investigadores en POO
Nathanael Schärli, Stéphane Ducasse, Oscar Nierstrasz y Andrew Black, y promueven
una visión más moderna y flexible de la reutilización de código que trata de:
a) Evitar los problemas clásicos de la herencia múltiple (como la ambigüedad en los métodos).
b) Facilitar la composición de clases sin acoplamiento fuerte. 
Los traits se implementaron primero en el lenguaje Smalltalk en 2003 y de allí a otros como PHP (2012)\n\n\n";


echo"32.2 Sintaxis básica de los traits\n";
echo "La sintaxis de los traits en PHP es similar a la de las clases, con algunas diferencias clave. 
Enseguida se muestra la sintaxis detallada incluyendo niveles de acceso, tipos de datos y otros aspectos:\n\n";

echo "<?php
// Sintaxis abstracta de traits
trait nombreDelTrait {
    // Propiedades o variables del trait con visilibilidad y tipo

    // Métodos del trait con visibilidad y tipo

}
?>\n\n";


echo "33.3 Semejanzas y diferencias entre traits y clases\n";
echo "Las semejanzas entre traits y clases son las siguientes: 
a) Ambos pueden declarar: 
    1. Propiedades o variables con diferentes niveles de acceso (public, protected, private) y de tipo de dato
    2. Métodos o funciones con diferentes niveles de acceso y diferentes tipos de dato en parámetros y valores de retorno
    3. Propiedades o variables y métodos o funciones estáticos (static)
    4. Métodos o funciones abstractos (abstract)
b) Ambos sirven como unidades para organizar y encapsular código relacionado\n\n";

echo "Las diferencias radican en cuanto a su propósito: 
a) CLASE: Su propósito principal es definir la estructura y el comportamiento de los objetos (instancias de la clase). 
Es decir, define una entidad completa u objeto. 
Las clases pueden ser instanciadas para crear objetos concretos.
Las clases, en PHP, pueden extender a una sola clase (herencia simple).
b) TRAIT: Su propósito principal es la reutilización de código. Es decir, define funcionalidades específicas. 
Los traits NO pueden ser instanciados directamente.
Los traits NO pueden extender nada o heredar nada. Su funcionalidad se incorpora a las clases mediante la palabra clave use.\n\n\n";


echo"32.4 Sintaxis de los traits con la sintaxis de los métodos y propiedades o variables\n";
echo "La sintaxis de los traits en PHP es similar a la de las clases, con algunas diferencias clave. 
Enseguida se muestra la sintaxis detallada incluyendo niveles de acceso, tipos de datos y otros aspectos:\n\n";

echo "<?php
// Sintaxis abstracta de traits
trait nombreDelTrait {
    // Propiedades o variables del trait con visilibilidad y tipo
    nivelDeAcceso tipoDeDato \$nombreVariable;

    // Métodos del trait con visibilidad y tipo
    nivelDeAcceso function nombreFuncion(tipoDeDato \$parametroA, tipoDeDato \$parametroB, tipoDeDato \$parametroN): tipoDeDatoValorDeRetorno {
    // Cuerpo de la función con código a ejecutar
    return valor;
    }
}
?>\n\n\n";

echo "32.5 Ejemplo de implementación de trait en una clase\n";


trait RegistroLoginCliente { // TRAIT 1 con función con visibilidad public
    public function loginCliente(string $usuario, string $registroAcceso) { 
        // Si la función file_exists() devuelve false
        if(!file_exists($registroAcceso)){
            // La función file_put_contents() crea el archivo con contenido vacío
            file_put_contents($registroAcceso, "");
        }
        // La función file_get_contents() lee el contenido del archivo y lo guarda en una variable
        $logAcceso = file_get_contents($registroAcceso);
        // La variable $logAcceso se concatena con el nuevo registro de acceso
        $logAcceso = $logAcceso . "$usuario se loguea el " . date("Y-m-d  H:i:s\n");
        // La función file_put_contents() escribe el contenido actualizado en el archivo
        file_put_contents($registroAcceso, $logAcceso);
    }
    public function crearDocumento(){
        echo "Cliente se registra<br>";
        $this->loginCliente("Ricardo", "login.txt");
    }
}

trait EnviarEmail { // TRAIT 2 con función con visibilidad protected
    protected function enviarEmail(string $nombre) {
        echo "Se envía un email a $nombre\n";
    }
}

trait EnviarTarjetaRegalo { // TRAIT 3 con función con visibilidad private
    private const TARJETA_REGALO = 100.0;

    private function enviarTarjetaRegalo(string $nombre) {
        echo "Se envía tarjeta de regalo a $nombre con valor de " . self::TARJETA_REGALO;
    }
}

class Cliente {
    // Propiedades
    private string $usuario;
    private string $contraseña;

    // Métodos o funciones


    // Declaración del uso de traits
    use EnviarEmail, EnviarTarjetaRegalo, RegistroLoginCliente;

    // Constructor explícito
    public function __construct(string $usuario, string $contraseña){
        $this -> enviarEmail($usuario);
        $this -> enviarTarjetaRegalo($usuario);
        $this -> loginCliente($usuario, "log".$usuario."txt");
    }
}

$cliente = new Cliente("Ricardo", "contraseña");
?>