<?php 

header( "Content-Type: text/plain");

echo "\n27. POO: HERENCIA\n\n";

echo "27.1 Definición de HERENCIA:\n";
echo "La herencia es una característica de la POO en la que una subclase (o clase hija) puede REUTILIZAR código (propiedades y métodos) ya existente 
y EXTENDER ese código con nuevo funcionamiento siempre y cuando tenga visibilidad protected o public. En el caso de la visibilidad private, 
se necesitará acceso indirecto, generalmente mediante una función getter o setter para propiedades y otro método público para métodos.\n\n\n";

echo "27.2 Repaso de tipos de visibilidad y niveles de acceso (visto en 20.POO):\n";
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
    en lugar de hacer las propiedades directamente públicas. */
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
    d) la seguridad del código. */
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

class SubClase extends NombreDeLaClase {
    // NUEVA PROPIEDAD AÑADIDA A LA SUBCLASE
    public $propiedadSubclase = "Valor de la subclase";
    // NUEVO MÉTODO AÑADIDO A LA SUBCLASE
    public function metodoSubclase() {
        return "Ejecutando un método propio de la subclase.\n";
    }
    // EXTENSIÓN DEL MÉTODO PROTEGIDO HEREDADO (SOBREESCRITURA Y EXTENSIÓN)
    protected function metodoProtegido() {
        // LLAMADA AL MÉTODO PROTEGIDO DE LA CLASE PADRE
        $padreResultado = parent::metodoProtegido();
        // AÑADIR FUNCIONALIDAD ADICIONAL A LA SUBCLASE
        return $padreResultado . " - (Extendido por la subclase)\n";
    }

    // MÉTODO PÚBLICO PARA ACCEDER AL MÉTODO PROTEGIDO EXTENDIDO
    public function obtenerMetodoProtegidoExtendidoDeLaClaseHija() {    // FUNCIÓN EJECUTADA CON EXTENSIÓN DESDE LA CLASE HIJA
        return $this->metodoProtegido(); // Acceso permitido porque estamos dentro de la SubClase
    }

    public function accederPropiedadProtegidaIndirectamente(){    // 
        return "Acceso INDIRECTO a propiedad protegida de la CLASE PADRE desde subclase: " . $this->propiedadProtegida . "\n"; // ACCESO DIRECTO dentro de la misma subclase (ámbito permitido)
    }
    public function llamarMetodoProtegidoDelaClasePadreIndirectamente() {   // FUNCIÓN EJECUTADA SIN EXTENSIÓN DESDE LA CLASE PADRE
        return parent::metodoProtegido() . "\n"; // ACCESO DIRECTO dentro de la misma subclase (ámbito permitido)
    }
    /*public function accederPropiedadPrivadaDirectamente(){
        return "Acceso directo a propiedad privada desde subclase: " . $this->propiedadPrivada . "\n";  // Error: No es posible el acceso directo dentro de la subclase por ser propiedad privada
    }
    public function llamarMetodoPrivadoDirectamente() {
        return "Llamada directa a método privado desde subclase: " . $this->metodoPrivado() . "\n"; // Error: No es posible el acceso directo dentro de la subclase por ser propiedad privada
    }*/
}

// Creación de un objeto a partir de la SUBclase
$subObjeto = new SubClase();

// Acceso a propiedades y métodos públicos de la CLASE PADRE NO recomendado (aunque es posible, no es una buena práctica. Mejor utiliza métodos getter y setter)
echo "El valor de la propiedad pública es: " . $subObjeto->propiedadPublica . "\n";   // ACCESO DIRECTO dentro del contexto global por ser propiedad pública
echo "La ejecución del método público es: " . $subObjeto->metodoPublico() . "\n"; // ACCESO DIRECTO dentro del contexto global por ser propiedad pública
    
// Acceso a propiedades y métodos privados de la CLASE PADRE
// echo $subObjeto->propiedadPrivada; // Error: No es posible el acceso directo en el contexto global por ser propiedad privada
// echo $subObjeto->metodoPrivado(); // Error: No es posible el acceso directo en el contexto global por ser método privado
    
// Acceso a propiedades y métodos protegidos de la CLASE PADRE
// echo $subObjeto->propiedadProtegida; // Error: No es posible el acceso directo en el contexto global por ser propiedad protegida
// echo $subObjeto->metodoProtegido(); // Error: No es posible el acceso directo en el contexto global por ser método protegido

// Acceso a propiedades y métodos privados de la CLASE HIJA O SUBCLASE
echo "Valor de una propiedad propia de la subclase: " . $subObjeto->propiedadSubclase . "\n";   // Acceso a la nueva propiedad de la subclase
echo $subObjeto->metodoSubclase();  // Llamada al nuevo método de la subclase

// LLAMADA AL MÉTODO PROTEGIDO DE LA CLASE PADRE POR LA CLASE HIJA Y EN SU VERSIÓN EXTENDIDA POR LA CLASE HIJA DESDE LA CLASE HIJA
// Llamada al método protegido extendido desde la subclase (indirectamente a través de un método público)
echo "Llamada al método protegido de la clase padre desde la subclase: " . $subObjeto->llamarMetodoProtegidoDelaClasePadreIndirectamente();
// Llamada al método protegido extendido desde la subclase (indirectamente a través de un método público)
echo "Llamada al método protegido extendido por la clase subhija desde la subclase: " . $subObjeto->obtenerMetodoProtegidoExtendidoDeLaClaseHija();


// ACCESO INDIRECTO a propiedad privada y posterior modificación desde la subclase (o clase hija) mediante FUNCIONES GETTER Y SETTER con visibilidad PÚBLICA
echo "Acceso a propiedad privada mediante getter desde subclase: " . $subObjeto->getPropiedadPrivada() . "\n";
echo $subObjeto->setPropiedadPrivada("Nuevo valor privado\n");
echo "Acceso a propiedad privada modificada desde subclase: " . $subObjeto->getPropiedadPrivada() . "\n";

// ACCESO INDIRECTO a propiedad protegida y posterior modificación desde la clase padre mediante FUNCIONES GETTER Y SETTER con visibilidad PÚBLICA
echo "Acceso a propiedad protegida mediante getter desde subclase: " . $subObjeto->getPropiedadProtegida() . "\n";
echo $subObjeto->setPropiedadProtegida("Nuevo valor protegido\n");
echo "Acceso a propiedad protegida modificada desde subclase: " . $subObjeto->getPropiedadProtegida() . "\n";

// ACCESO INDIRECTO a método privado desde la clase padre mediante FUNCIÓN DE ACCESO con visibilidad PÚBLICA
$subObjeto->llamarMetodoPrivado();
// ACCESO INDIRECTO a método protegida desde la clase padre mediante FUNCIÓN DE ACCESO con visibilidad PÚBLICA
$subObjeto->llamarMetodoProtegido();

echo $subObjeto->accederPropiedadProtegidaIndirectamente();
echo $subObjeto->llamarMetodoProtegidoDelaClasePadreIndirectamente();
// echo $subObjeto->accederPropiedadPrivadaDirectamente();  // IMPOSIBLE acceso directo a propiedades privadas desde subclase
// echo $subObjeto->llamarMetodoPrivadoDirectamente();  // IMPOSIBLE acceso directo a propiedades privadas desde subclase


?>