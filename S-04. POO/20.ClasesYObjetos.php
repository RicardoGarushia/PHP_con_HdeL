<?php
header( "Content-Type: text/plain");

echo "\n20. POO: Clases e instancias de clase (objetos)\n\n";

echo "20.0 Definición de POO en PHP:\n";
echo "El paragidma de Programación Orientada a Objetos (POO) se centra en el concepto de 
utilizar clases y objetos que interactúan entre sí para organizar el código y realizar tareas específicas.
La POO permite crear programas más modulares, reutilizables y fáciles de mantener.
La POO se basa en cuatro conceptos fundamentales: encapsulamiento, herencia, polimorfismo y abstracción.\n\n\n";

echo "20.1 Definición de una clase en PHP (Conceptos POO: ABSTRACCIÓN Y ENCAPSULACIÓN):\n";
echo "Una clase es una plantilla o modelo abstracto que define las propiedades y métodos de un objeto.
En otras palabras, una clase es un conjunto de instrucciones que describen 
cómo se debe crear un objeto y qué características y comportamientos tendrá.\n\n\n";

echo "20.1.1 Sintaxis de una clase en PHP:\n";
echo "La sintaxis básica para declarar una clase es la siguiente:\n";

echo "<?php
class NombreDeLaClase {
    // Propiedades o atributos: 

    // Métodos:

    // Constructor:

    // Destructor:

    // Métodos mágicos:
}
?>\n\n\n";

echo "20.2 Definición de un objeto en PHP\n:";
echo "Un objeto es una instancia de una clase.
En otras palabras, un objeto es una entidad creada a partir de una clase que tiene sus propias propiedades y métodos.\n\n\n";

echo "20.2.1 Sintaxis de un objeto en PHP:\n";
echo "La sintaxis básica para crear un objeto desde una clase es la siguiente: \n";
echo "<?php
class NombreDeLaClase {
    // Propiedades o atributos: 

    // Métodos:

}
// Creación de un objeto a partir de una clase
\$objetoDeLaClase = new NombreDeLaClase();
?>\n\n\n";


echo "20.3 Definición de una propiedad de clase (también llamado atributo de clase) en PHP:\n";
echo "Una propiedad de clase es una variable que pertenece a una clase y define un atributo o característica del objeto.
Las propiedades pueden ser de diferentes tipos de dato, como enteros, cadenas de texto, booleanos, arrays, etc.\n\n\n";


echo "20.4 Definición de un método en PHP:\n";
echo "Un método es una función que pertenece a una clase y define un comportamiento o acción que puede realizar el objeto.
Los métodos pueden recibir parámetros y devolver valores, al igual que las funciones comunes.\n\n\n";


echo "20.4.1 Sintaxis de un método en PHP:\n";
echo "La sintaxis básica para declarar un método dentro de una clase es la siguiente:\n";
echo "<?php 
class NombreDeLaClase {
    // Propiedades o atributos: 

    // Método con visibilidad pública
    public function nombreDelMetodo(\$parametro1, \$parametro2, \$parametroN) {
        // Código del método
        return \"Resultado del método\";
    }
}

// Creación de un objeto a partir de la clase
\$objetoDeLaClase = new NombreDeLaClase();

// Llamada a un método del objeto
\$resultado = \$objetoDeLaClase->nombreDelMetodo(\$valor1, \$valor2, \$valor3);
?>\n\n\n";

echo "20.4.1 Métodos dinámicos y métodos estáticos:\n";
echo "Los métodos dinámicos son aquellos que se llaman a través de una instancia de la clase (un objeto) utilizando el operador de objeto (->).
Los métodos estáticos, por otro lado, se llaman directamente desde la clase utilizando el operador de resolución de ámbito (::) sin necesidad de crear una instancia de la clase.\n\n\n";


echo "20.5 Niveles de visibilidad para propiedades y métodos\n";
echo "Las propiedades y los métodos pueden tener TRES niveles de visibilidad: 
    a) public: Accesibles desde cualquier parte del código. Tanto dentro como fuera de la clase. 
    Debilita la ENCAPSULACIÓN al exponer detalles internos de una clase.
    b) protected: Accesibles dentro de la clase y sus subclases. No son accesibles desde fuera de la jerarquía de clases (HERENCIA),
    ni por clases superiores. Esta visibilidad puede debilitar la ENCAPSULACIÓN al exponer detalles internos de una clase a sus subclases. 
    c) private: Accesibles solo dentro de la clase que los define. Ni las subclases ni el código externo pueden acceder a ellos.
    El nivel más restrictivo que fortalece la ENCAPSULACIÓN al ocultar detalles internos de una clase 
    y proteger la integridad de datos y la lógica interna de modificaciones no deseadas.\n\n";

echo "Aunque en principio parece que no se puede acceder a métodos y propiedades con visibilidad private de una clase,
mediante métodos públicos que accedan a estos métodos y propiedades private se puede acceder mediante subclases y código externo. 
Sin embargo, es necesario hacer la aclaración de que este acceso es INDIRECTO, controlado y definido explícitamente 
por la clase que contiene los miembros privados.
Es decir, la subclase o el código externo no pueden acceder directamente a los miembros privados; 
solo pueden hacerlo INDIRECTAMENTE mediante la interfaz pública (los métodos públicos) proporcionada por la clase original.\n\n";
    
echo "En caso de necesitar utilizar subclases, el nivel de visibilidad recomendado es \"protected\".
En este caso, el uso de \"protected\" es preferible a \"public\", 
ya que permite que las subclases accedan a las propiedades y métodos de la \"clase padre\" sin exponerlos al mundo exterior.
En caso de no utilizar subclases, el nivel de visibilidad recomendado es \"private\".
Y aunque hay situaciones donde \"public\" es necesario, 
por ejemplo, utilizar métodos públicos para acceder y modificar propiedades privadas y protegidas 
desde cualquier parte del código que tenga acceso al objeto, es importante usarlo con precaución.
La encapsulación sigue siendo una buena práctica general para proteger la integridad de los datos.
Siempre que sea posible, es preferible utilizar métodos getter y setter para controlar el acceso a las propiedades, 
incluso si tienen un nivel de visibilidad public.\n\n";

echo "En general, es más recomendable utilizar métodos públicos (getters y setters)
para acceder y modificar propiedades privadas o protegidas, 
en lugar de hacer las propiedades directamente públicas. 
Esta práctica está directamente relacionada con el principio de encapsulación en la Programación Orientada a Objetos (POO).\n\n\n";


echo "20.6 Niveles de acceso: consecuencia directa de los niveles de visibilidad para propiedades y métodos\n";
echo "La visibilidad es el mecanismo que controla cómo y desde dónde se pueden acceder a las propiedades y métodos de una clase. 
Existen dos niveles de acceso: 
a) Acceso DIRECTO. Implica utilizar el operador de objeto (->) seguido directamente del nombre de la propiedad o del método, 
SIN INTERMEDIARIOS, Y SIEMPRE Y CUANDO, EL ÁMBITO TENGA PERMISO PARA ACCEDER A ESE MIEMBRO.
b) Acceso INDIRECTO. Implica utilizar un intermediario, que generalmente es un método con visibilidad pública (public) o 
protegida (protected) de la clase o su jerarquía, para acceder o modificar un miembro al que el ÁMBITO NO TIENE ACCESO DIRECTO.\n\n";

echo "Ejemplos de Acceso Directo con base en el contexto:
a) Dentro de la misma clase (NombreDeLaClase), se puede acceder directamente a miembros public, protected y private usando 
\$this->propiedad o \$this->metodo().
b) Dentro de una clase hija (SubClase), se puede acceder directamente a miembros public y protected heredados usando 
\$this->propiedad o \$this->metodo().
c) Desde fuera de la jerarquía de clases (ámbito global), solo se puede acceder directamente a miembros public de un objeto usando 
\$objeto->propiedadPublica o \$objeto->metodoPublico().\n\n";

echo "Ejemplos de Acceso Directo con base en el nivel de visibilidad:
    a) public: Puede ser accedido desde subclases, clases padre y ámbito global.
    b) protected: Puede ser accedido desde subclases y clases padre.  
    c) private: Únicamente puede ser accedido desde clases padre únicamente.\n\n";

echo "Ejemplos de Acceso Indirecto (fuera del ámbito directo): 
a) Desde una clase hija (SubClase), para acceder a una propiedad private de la clase padre (NombreDeLaClase), 
se debe utilizar un método public o protected (getter) definido en la clase padre.
b) Desde fuera de la jerarquía de clases (ámbito global), para \"ver\" o modificar miembros protected o private de un objeto, 
se deben utilizar métodos public (getter y setter) definidos en la clase del objeto o sus ancestros.\n\n\n";

echo "20.7 Relación entre POO con clases, objetos, propiedades y métodos:\n";
echo "a) Encapsulación:
Las clases y los objetos permiten agrupar datos y funciones, ocultando los detalles de implementación interna.
Los modificadores de visibilidad controlan el acceso a las propiedades y métodos.
b) Abstracción:
Las clases permiten abstraer conceptos del mundo real y representarlos en código.
Los objetos son instancias concretas de esas abstracciones.
c) Herencia:
Las clases pueden heredar propiedades y métodos de otras clases, lo que permite la reutilización de código
y la creación de jerarquías de clases.
d) Polimorfismo:
Los objetos de diferentes clases pueden responder al mismo mensaje de manera diferente.\n\n\n";

echo "20.8 Sintaxis de una clase con propiedades y métodos en PHP:\n";
echo "La sintaxis básica para declarar una clase es la siguiente:\n";

echo "<?php
class NombreDeLaClase {
    // Propiedades o atributos: Recuerda que no se recomienda usar propiedades públicas
    public \$propiedadPublica = \"Valor público\"; // Propiedad pública    
    private \$propiedadPrivada = \"Valor privado\"; // Propiedad privada
    protected \$propiedadProtegida = \"Valor protegido\"; // Propiedad protegida

    // Métodos: 
    private function metodoPublico() {
        // Código del método público
        echo \"Ejecutando un método público\";
    }
    
    private function metodoPrivado() {
        // Código del método privado
        echo \"Ejecutando un método privado\";
    }

    protected function metodoProtegido() {
        // Código del método protegido
        echo \"Ejecutando un método protegido\";
    }

    // Métodos públicos para acceder a propiedades privadas y protegidas
    /*
    Recordar: Es más recomendable utilizar métodos públicos (getters y setters) 
    para acceder y modificar propiedades privadas o protegidas, 
    en lugar de hacer las propiedades directamente públicas.
    */
    public function getPropiedadPrivada() {
        return \$this->propiedadPrivada;
    }

    public function setPropiedadPrivada(\$valor) {
        \$this->propiedadPrivada = \$valor;
    }

    protected function getPropiedadProtegida() {
        return \$this->propiedadProtegida;
    }

    protected function setPropiedadProtegida(\$valor) {
        \$this->propiedadProtegida = \$valor;
    }

    // Métodos públicos para acceder a métodos privados y protegidos
    /*
    Utilizar métodos públicos para llamar a métodos privados y protegidos es una práctica recomendada para mejorar:
    a) la encapsulación, por ejemplo, al ocultar y proteger la lógica interna de una clase (implementación),
    b) la abstracción, simplificando la interfaz de la clase al sólo llamar los métodos públicos,
    c) la mantenibilidad, facilitando la modificación de la lógica interna de la clase sin afectar el código que utiliza y,
    d) la seguridad del código.
    */
    
    public function llamarMetodoPublico(){
        \$this->metodoPublico();
    }

    public function llamarMetodoPrivado(){
        \$this->metodoPrivado();
    }

    protected function llamarMetodoProtegido(){
        \$this->metodoProtegido();
    }
}

// Creación de un objeto a partir de la clase
\$objetoDeLaClase = new NombreDeLaClase();

// Acceso a propiedades y métodos públicos NO recomendado (aunque es posible, no es una buena práctica)
echo \"El valor de la propiedad pública es: \" . \$objetoDeLaClase->propiedadPublica . \"\\n\";
echo \"La ejecución del método público es: \" . \$objetoDeLaClase->metodoPublico() . \"\\n\";

// Acceso a propiedades y métodos privados (solo dentro de la clase)
// echo \$objetoDeLaClase->propiedadPrivada; // Error: propiedad privada
// echo \$objetoDeLaClase->metodoPrivado(); // Error: método privado

// Acceso a propiedades y métodos protegidos (solo dentro de la clase y subclases)
// echo \$objetoDeLaClase->propiedadProtegida; // Error: propiedad protegida
// echo \$objetoDeLaClase->metodoProtegido(); // Error: método protegido

// Acceso a propiedad privada
echo \"Acceso a propiedad privada mediante getter: \" . \$objetoDeLaClase->getPropiedadPrivada() . \"\\n\";
\$objetoDeLaClase->setPropiedadPrivada(\"Nuevo valor privado\");
echo \"Acceso a propiedad privada modificada: \" . \$objetoDeLaClase->getPropiedadPrivada() . \"\\n\";

// Acceso a método privado
\$objetoDeLaClase->llamarMetodoPrivado();

// Acceso a propiedad protegida desde una subclase
class SubClase extends NombreDeLaClase {
    public function accederProtegido() {
        return \"Acceso a propiedad protegida mediante getter: \" . \$this->getPropiedadProtegida() . \"\\n\";
    }
    public function modificarProtegido(\$valor) {
        \$this->setPropiedadProtegida(\$valor);
        return \"Propiedad protegida modificada\\n\";
    }
    public function llamarProtegido(){
        \$this->llamarMetodoProtegido();
    }
}
?>\n\n\n";

class NombreDeLaClase { // CLASE PADRE 
    // PROPIEDADES DE LA CLASE PADRE: Recuerda que no se recomienda usar propiedades públicas
    public $propiedadPublica = "Valor público"; // Propiedad con visibilidad pública
    private $propiedadPrivada = "Valor privado"; // Propiedad con visibilidad privada
    protected $propiedadProtegida = "Valor protegido"; // Propiedad con visibilidad protegida
    
    // MÉTODOS DE LA CLASE PADRE:
    public function metodoPublico() {   // Método con visibilidad pública
        // Código del método público
        return "Ejecutando un método público";
    }
    private function metodoPrivado() {  // Método con visibilidad privada
        // Código del método privado
        return "Ejecutando un método privado";
    }
    protected function metodoProtegido() {  // Método con visibilidad protegida
        // Código del método protegido
        return "Ejecutando un método protegido";
    }
    
    /* MÉTODOS GETTER Y SETTER CON VISIBILIDAD PÚBLICA para acceder a propiedades privadas y protegidas
    RECORDAR: Es más recomendable utilizar métodos públicos (getters y setters)
    para acceder y modificar propiedades privadas o protegidas,
    en lugar de hacer las propiedades directamente públicas.
    */
    public function getPropiedadPrivada() {
        return $this->propiedadPrivada; // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    
    public function setPropiedadPrivada($valor) {
        $this->propiedadPrivada = $valor;   // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    
    public function getPropiedadProtegida() {
        return $this->propiedadProtegida;   // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    
    public function setPropiedadProtegida($valor) {
        $this->propiedadProtegida = $valor; // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    
    /* MÉTODOS PÚBLICOS CON VISIBILIDAD PÚBLICA para acceder a métodos privados y protegidos
    Utilizar métodos públicos para llamar a métodos privados y protegidos es una práctica recomendada para mejorar:
    a) la encapsulación, por ejemplo, al ocultar y proteger la lógica interna de una clase (implementación),
    b) la abstracción, simplificando la interfaz de la clase al sólo llamar los métodos públicos,
    c) la mantenibilidad, facilitando la modificación de la lógica interna de la clase sin afectar el código que utiliza y,
    d) la seguridad del código.
    */
    public function llamarMetodoPublico(){
        $this->metodoPublico(); // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    public function llamarMetodoPrivado(){
        $this->metodoPrivado(); // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    public function llamarMetodoProtegido(){
        $this->metodoProtegido();   // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
}
// Creación de un objeto a partir de la clase
$objetoDeLaClase = new NombreDeLaClase();
    
// Acceso a propiedades y métodos públicos de la CLASE PADRE NO recomendado (aunque es posible, no es una buena práctica. Mejor utiliza métodos getter y setter)
echo "El valor de la propiedad pública es: " . $objetoDeLaClase->propiedadPublica . "\n";   // ACCESO DIRECTO dentro del contexto global por ser propiedad pública
echo "La ejecución del método público es: " . $objetoDeLaClase->metodoPublico() . "\n"; // ACCESO DIRECTO dentro del contexto global por ser propiedad pública
    
// Acceso a propiedades y métodos privados de la CLASE PADRE
// echo $objetoDeLaClase->propiedadPrivada; // Error: No es posible el acceso directo en el contexto global por ser propiedad privada
// echo $objetoDeLaClase->metodoPrivado(); // Error: No es posible el acceso directo en el contexto global por ser método privado
    
// Acceso a propiedades y métodos protegidos de la CLASE PADRE
// echo $objetoDeLaClase->propiedadProtegida; // Error: No es posible el acceso directo en el contexto global por ser propiedad protegida
// echo $objetoDeLaClase->metodoProtegido(); // Error: No es posible el acceso directo en el contexto global por ser método protegido

// ACCESO INDIRECTO a propiedad privada y posterior modificación desde la clase padre mediante FUNCIONES GETTER Y SETTER con visibilidad PÚBLICA
echo "Acceso a propiedad privada mediante getter: " . $objetoDeLaClase->getPropiedadPrivada() . "\n";
$objetoDeLaClase->setPropiedadPrivada("Nuevo valor privado");
echo "Acceso a propiedad privada modificada: " . $objetoDeLaClase->getPropiedadPrivada() . "\n";

// ACCESO INDIRECTO a propiedad protegida y posterior modificación desde la clase padre mediante FUNCIONES GETTER Y SETTER con visibilidad PÚBLICA
echo "Acceso a propiedad protegida mediante getter: " . $objetoDeLaClase->getPropiedadProtegida() . "\n";
$objetoDeLaClase->setPropiedadProtegida("Nuevo valor protegido");
echo "Acceso a propiedad protegida modificada: " . $objetoDeLaClase->getPropiedadProtegida() . "\n";

// ACCESO INDIRECTO a método privado desde la clase padre mediante FUNCIÓN DE ACCESO con visibilidad PÚBLICA
$objetoDeLaClase->llamarMetodoPrivado();
// ACCESO INDIRECTO a método protegida desde la clase padre mediante FUNCIÓN DE ACCESO con visibilidad PÚBLICA
$objetoDeLaClase->llamarMetodoProtegido();
    
// Creación de una subclase SE ABORDA EN 27. HERENCIA 
?>