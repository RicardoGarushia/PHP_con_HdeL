<?php
header( "Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "20. POO: CLASES E INSTANCIAS DE CLASE (OBJETOS)\n";
echo "======================================================================\n\n";

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
    
    /* MÉTODOS GETTER Y SETTER PÚBLICOS para ACCEDER a PROPIEDADES PRIVADAS Y PROTEGIDAS
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
    
    /* MÉTODOS PÚBLICOS para ACCEDER a MÉTODOS PRIVADOS/PROTEGIDOS
    Utilizar métodos públicos para llamar a métodos privados y protegidos es una práctica recomendada para mejorar:
    a) la encapsulación, por ejemplo, al ocultar y proteger la lógica interna de una clase (implementación),
    b) la abstracción, simplificando la interfaz de la clase al sólo llamar los métodos públicos,
    c) la mantenibilidad, facilitando la modificación de la lógica interna de la clase sin afectar el código que utiliza y,
    d) la seguridad del código.
    */
    public function llamarMetodoPublico(){
        return $this->metodoPublico(); // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    public function llamarMetodoPrivado(){
        return $this->metodoPrivado(); // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    public function llamarMetodoProtegido(){
        return $this->metodoProtegido();   // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
}

// Creación de una instancia de clase u objeto
$objetoDeLaClase = new NombreDeLaClase();

echo "--- 1. Acceso Directo a Miembros Públicos ---\n";
echo "Propiedad pública: " . $objetoDeLaClase->propiedadPublica . "\n";
echo "Método público: " . $objetoDeLaClase->metodoPublico() . "\n\n";

echo "--- 2. Acceso Indirecto a Miembros Privados mediante Getters/Setters ---\n";
echo "Getter Privado: " . $objetoDeLaClase->getPropiedadPrivada() . "\n";
$objetoDeLaClase->setPropiedadPrivada("Nuevo valor privado");
echo "Getter Privado (modificado): " . $objetoDeLaClase->getPropiedadPrivada() . "\n\n";

echo "--- 3. Acceso Indirecto a Miembros Protegidos mediante Getters/Setters ---\n";
echo "Getter Protegido: " . $objetoDeLaClase->getPropiedadProtegida() . "\n";
$objetoDeLaClase->setPropiedadProtegida("Nuevo valor protegido");
echo "Getter Protegido (modificado): " . $objetoDeLaClase->getPropiedadProtegida() . "\n\n";

echo "--- 4. Acceso Indirecto a Métodos Privados y Protegidos ---\n";
echo "Llamada a método privado: " . $objetoDeLaClase->llamarMetodoPrivado() . "\n";
echo "Llamada a método protegido: " . $objetoDeLaClase->llamarMetodoProtegido() . "\n";




class Producto {
    // PROPIEDADES (atributos)
    private $nombre; 
    private $precio;

    // METODOS (funciones de clases)
    public function getNombre() {
        return $this->nombre; // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    public function setNombre(string $valor) {
        $this->nombre = $valor;   // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    public function getPrecio() {
        return $this->precio; // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
    public function setPrecio(float $valor) {
        $this->precio = $valor;   // ACCESO DIRECTO dentro de la misma clase (ámbito permitido)
    }
}

$producto = new Producto; 

$producto -> setNombre("PC");
$producto -> setPrecio(10000);

echo "\n\nEl producto " . $producto -> getNombre() . " tiene un costo de $" . $producto -> getPrecio();
