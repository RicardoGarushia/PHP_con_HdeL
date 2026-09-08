<?php
header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "22. POO: Constructores Explícitos y Promoción de Propiedades (PHP 8.0+)\n";
echo "======================================================================\n\n";

// --- EJECUCIÓN DEL CÓDIGO REAL ---

class PersonaSintaxisTradicional {
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

    // Constructor EXPLÍCITO (Método Mágico)
    public function __construct($apellidoPUsuario, $apellidoMUsuario, $nombreUsuario, $edadUsuario) {
        $this->apellidoP = $apellidoPUsuario;
        $this->apellidoM = $apellidoMUsuario;
        $this->nombre = $nombreUsuario;
        $this->edad = $edadUsuario;
    }
}

// Creación de un objeto pasando los argumentos al constructor
$objetoDeLaClase = new PersonaSintaxisTradicional("García", "López", "Ricardo", 34);

// Obtención de valores
$arrayParaVariasPropiedadesPrivadas = $objetoDeLaClase->getPropiedadesPrivadasComoArray();

echo "--- RESULTADOS EN CONSOLA ---\n";
echo "Acceso a propiedades privadas mediante getter:\n";
print_r($arrayParaVariasPropiedadesPrivadas);

foreach ($arrayParaVariasPropiedadesPrivadas as $indice => $valor) {
    echo "El valor en la posición " . ($indice + 1) . " es: $valor\n";
}



// PHP 8.0+: Declaración, propiedad y asignación en una sola línea
class PersonaSintaxisPromocionada {
    // Al colocar 'private' antes del tipo/variable en el constructor,
    // PHP define la propiedad y realiza el $this->propiedad = $valor en automático.
    public function __construct(
        private string $apellidoP,
        private string $apellidoM,
        private string $nombre,
        private int $edad
    ) {
        // El cuerpo del constructor puede incluir lógica extra si se requiere
    }

    public function getPropiedadesPrivadasComoArray(): array {
        return [
            $this->apellidoP, 
            $this->apellidoM, 
            $this->nombre, 
            $this->edad
        ];
    }
}

// Instanciación del objeto exacto a las lecciones anteriores
$objetoPromocionado = new PersonaSintaxisPromocionada("García", "López", "Ricardo", 34);

// Obtención de valores
$arrayParaVariasPropiedadesPrivadas = $objetoPromocionado->getPropiedadesPrivadasComoArray();

echo "--- RESULTADOS EN CONSOLA ---\n";
echo "Acceso a propiedades privadas inicializadas vía Constructor Promotion:\n";
print_r($arrayParaVariasPropiedadesPrivadas);

foreach ($arrayParaVariasPropiedadesPrivadas as $indice => $valor) {
    echo "El valor en la posición " . ($indice + 1) . " es: $valor\n";
}