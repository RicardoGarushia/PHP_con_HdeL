<?php

header( "Content-Type: text/plain");

echo "\n28. ENCAPSULAMIENTO\n\n";

echo "28.1 DEFINE ENCAPSULAMIENTO\n";
echo "El encapsulamiento es un concepto fundamental en la programación orientada a objetos (POO) que se refiere a 
la práctica de agrupar los datos (atributos o propiedades) y los métodos (funciones o comportamientos) 
que operan sobre esos datos dentro de una sola unidad, llamada clase.\n\n";

echo "Además de la agrupación, el encapsulamiento también implica el concepto de ocultamiento de la información (information hiding). 
Esto significa restringir el acceso directo a los datos internos de un objeto y permitir que se interactúe con ellos 
solo a través de los métodos públicos definidos por la clase.\n\n\n";

echo "28.2 OBJETIVOS DEL ENCAPSULAMIENTO\n";
echo "En esencia, el encapsulamiento tiene dos objetivos principales:
a) Agrupar y organizar el código: Reúne los datos y la lógica relacionada, 
lo que facilita la comprensión y el mantenimiento del código. 
Una clase se convierte en una cápsula autocontenida que representa 
una entidad del mundo real con sus propias características y acciones.

b) Proteger la integridad de los datos: Al ocultar los detalles de la implementación interna 
y permitir el acceso a los datos solo a través de métodos controlados (getters y setters), 
se previene la modificación accidental o no autorizada de los datos, 
lo que podría llevar a estados inconsistentes o errores en el programa.\n\n\n";

echo "28.3 BENEFICIOS DEL ENCAPSULAMIENTO\n";
echo "a) Modularidad: Las clases encapsuladas son unidades independientes que pueden ser desarrolladas, probadas y reutilizadas por separado.
b) Ocultamiento de la complejidad: Los usuarios de una clase no necesitan conocer los detalles internos de su implementación. 
Solo necesitan conocer la interfaz pública.
c) Control de acceso: Permite definir qué partes de un objeto son accesibles desde fuera de la clase, protegiendo los datos sensibles.
d) Flexibilidad y mantenibilidad: Los detalles de la implementación interna de una clase pueden modificarse sin afectar el código que utiliza la clase, siempre y cuando la interfaz pública se mantenga igual.
e) Reusabilidad: Las clases encapsuladas pueden ser utilizadas en diferentes partes de un programa o en diferentes programas.\n\n\n";

echo "28.4 EJEMPLO DE ENCAPSULAMIENTO\n";
echo "<?php
class Persona
{
    private string \$curp;
    private string \$nombre;
    private string \$apellidoP;
    private string \$apellidoM;
    private float \$estatura;
    private float \$peso;
    private float \$IMC;

    public function __construct(\$curpCliente, \$nombreCliente, \$apellidoPCliente, \$apellidoMCliente, \$estaturaCliente, \$pesoCliente)
    {
        \$this -> curp = \$curpCliente;
        \$this -> nombre = \$nombreCliente;
        \$this -> apellidoP = \$apellidoPCliente;
        \$this -> apellidoM = \$apellidoMCliente;
        \$this -> estatura = \$estaturaCliente;
        \$this -> peso = \$pesoCliente;
        \$this -> IMC = \$pesoCliente / (\$estaturaCliente * \$estaturaCliente);
    }

    public function getNombreCompleto()
    {
        return [
            \$this-> apellidoP,
            \$this-> apellidoM,
            \$this-> nombre
        ];
    }
    public function getIMC()
    {
        return \$this -> IMC;
    }
}

\$cliente = new Persona(\"GALR901123HDF\", \"Ricardo\", \"García\", \"López\", 1.71, 84.5);

\$arrayCliente = \$cliente->getNombreCompleto();
echo \"El cliente: \";
foreach (\$arrayCliente as \$indice => \$valor) {
    echo \"\$valor \";
}
echo \"\ntiene un IMC de: \" . \$cliente->getIMC();
?>\n\n\n";

class Persona
{
    private string $curp;
    private string $nombre;
    private string $apellidoP;
    private string $apellidoM;
    private float $estatura;
    private float $peso;
    private float $IMC;

    public function __construct($curpCliente, $nombreCliente, $apellidoPCliente, $apellidoMCliente, $estaturaCliente, $pesoCliente)
    {
        $this -> curp = $curpCliente;
        $this -> nombre = $nombreCliente;
        $this -> apellidoP = $apellidoPCliente;
        $this -> apellidoM = $apellidoMCliente;
        $this -> estatura = $estaturaCliente;
        $this -> peso = $pesoCliente;
        $this -> IMC = $pesoCliente / ($estaturaCliente * $estaturaCliente);
    }

    public function getNombreCompleto()
    {
        return [
            $this-> apellidoP,
            $this-> apellidoM,
            $this-> nombre
        ];
    }
    public function getIMC()
    {
        return $this -> IMC;
    }
}

$cliente = new Persona("GALR901123HDF", "Ricardo", "García", "López", 1.71, 84.5);

$arrayCliente = $cliente->getNombreCompleto();
echo "El cliente: ";
foreach ($arrayCliente as $indice => $valor) {
    echo "$valor ";
}
echo "\nTiene un IMC de: " . $cliente->getIMC();

echo "\n\n\n28.5 REPASO de tipos de visibilidad y niveles de acceso (visto en 20.POO y 27.Herencia):\n";
echo "La visibilidad es el mecanismo que controla cómo y desde dónde se pueden acceder a las propiedades y métodos de una clase. 
Las propiedades y los métodos pueden tener TRES niveles de visibilidad: 
    A) public: Accesibles desde cualquier parte del código. Tanto dentro como fuera de la clase. 
    Debilita la ENCAPSULACIÓN al exponer detalles internos de una clase.
    B) protected: Accesibles dentro de la clase y sus subclases. No son accesibles desde fuera de la jerarquía de clases (HERENCIA),
    ni por clases superiores. Esta visibilidad puede debilitar la ENCAPSULACIÓN al exponer detalles internos de una clase a sus subclases. 
    C) private: Accesibles solo dentro de la clase que los define. Ni las subclases ni el código externo pueden acceder a ellos.
    El nivel más restrictivo que fortalece la ENCAPSULACIÓN al ocultar detalles internos de una clase 
    y proteger la integridad de datos y la lógica interna de modificaciones no deseadas.\n\n";

echo"Los niveles de acceso son consecuencia directa de los niveles de visibilidad para propiedades y métodos. 
Existen dos niveles de acceso: 
A) Acceso DIRECTO. Implica utilizar el operador de objeto (->) seguido directamente del nombre de la propiedad o del método, 
SIN INTERMEDIARIOS, Y SIEMPRE Y CUANDO, EL ÁMBITO TENGA PERMISO PARA ACCEDER A ESE MIEMBRO. Recordar los permisos: 
    a) public: Puede ser accedido desde subclases, clases padre y ámbito global.
    b) protected: Puede ser accedido desde subclases y clases padre.  
    c) private: Únicamente puede ser accedido desde clases padre únicamente. 
B) Acceso INDIRECTO. Implica utilizar un intermediario, que generalmente es un método con visibilidad pública (public) o 
protegida (protected) de la clase o su jerarquía, para acceder o modificar un miembro al que el ÁMBITO NO TIENE ACCESO DIRECTO.\n\n\n";


echo "28.6 DIFERENCIA ENTRE:
OPERADOR DE ACCESO A MIEMBROS DE UN OBJETO (->)
Y 
OPERADOR DE ASIGNACIÓN (=)\n";
echo "a) El Operador de Acceso (->) se utiliza para acceder a los miembros (propiedades y métodos) de un objeto.
Se utiliza después del nombre de la variable que contiene el objeto y antes del nombre del miembro al que se quiere acceder.
b) El Operador de Asignación (=) se utiliza para asignar un valor a una variable.
En el contexto de objetos, se utiliza para asignar un objeto a una variable o 
para asignar un valor a una propiedad (atributo) de un objeto directamente 
(si la propiedad no es privada y se permite el acceso directo).";
