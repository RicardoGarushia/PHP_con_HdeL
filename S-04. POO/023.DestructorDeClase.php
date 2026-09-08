<?php
header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "23. POO: DESTRUCTORES DE OBJETOS\n";
echo "======================================================================\n\n";

// --- EJECUCIÓN DEL CÓDIGO REAL ---

class DesYConsDeClase {
    // Propiedades o atributos
    private $apellidoP;
    private $apellidoM; 
    private $nombre;
    private $edad;

    // Métodos
    public function getPropiedadesPrivadasComoArray() {
        return [
            $this->apellidoP, 
            $this->apellidoM, 
            $this->nombre, 
            $this->edad
        ];
    }

    // Constructor EXPLÍCITO
    public function __construct($apellidoPUsuario, $apellidoMUsuario, $nombreUsuario, $edadUsuario) {
        $this->apellidoP = $apellidoPUsuario;
        $this->apellidoM = $apellidoMUsuario;
        $this->nombre = $nombreUsuario;
        $this->edad = $edadUsuario;
    }

    // Destructor EXPLÍCITO
    public function __destruct() {
        echo "[DESTRUCTOR]: Se ha eliminado el objeto de la memoria.\n\n";
    }
}

// Instanciación
$objetoDeLaClase = new DesYConsDeClase("García", "López", "Ricardo", 34);

// Obtención de valores
$arrayParaVariasPropiedadesPrivadas = $objetoDeLaClase->getPropiedadesPrivadasComoArray();

// FORZAMOS LA DESTRUCCIÓN DEL OBJETO AQUÍ: 
unset($objetoDeLaClase);    // Comenta está línea de código para destruir el objeto al final

echo "--- RESULTADOS EN CONSOLA ---\n";
echo "Acceso a propiedades privadas mediante getter:\n";
print_r($arrayParaVariasPropiedadesPrivadas);

foreach ($arrayParaVariasPropiedadesPrivadas as $indice => $valor) {
    echo "El valor en la posición " . ($indice + 1) . " es: $valor\n";
}

// Nota: El destructor se disparará automáticamente justo después de la última línea sí no se forza su destrucción previamente con unset()