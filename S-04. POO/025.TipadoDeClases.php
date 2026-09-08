<?php
declare(strict_types=1); // Directiva de tipado estricto obligatoria en la primera línea

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "25. DECLARACIÓN DE TIPO DE DATO EN FUNCIONES Y PROPIEDADES DE CLASES\n";
echo "======================================================================\n\n";

// --- EJECUCIÓN DEL CÓDIGO REAL ---

class Persona {
    // Propiedades o atributos con tipo de dato explícito
    private string $nombre;
    private int $edad;
    private float $monto;
    
    // Constructor con parámetros de tipo explícito
    public function __construct(string $nombreCliente, int $edadCliente, float $montoCliente) {
        $this->nombre = $nombreCliente;
        $this->edad = $edadCliente;
        $this->monto = $montoCliente;
    }

    // Destructor explícito
    public function __destruct() {
        echo "\n[DESTRUCTOR]: Objeto de la clase Persona eliminado de la memoria (REPASO de 023.).\n";
    }

    // Método con declaración de tipo de retorno (array)
    public function obtenerDatosCliente(): array {
        return [
            $this->nombre,
            $this->edad,
            $this->monto
        ];
    }
}

// 1. Instanciación correcta: Todos los tipos coinciden exactamente
$objetoPersona = new Persona("Ricardo", 34, 10000.65);

// 2. Instanciaciones incorrectas (Arrojan TypeError al estar activo strict_types=1):
// $objetoPersona2 = new Persona(1234, "21", "2566");
// $objetoPersona3 = new Persona("1234", 21.54, 2566);

// Obtención e impresión de datos
$datosCliente = $objetoPersona->obtenerDatosCliente();

echo "--- DATOS DEL CLIENTE REGISTRADO ---\n";
foreach ($datosCliente as $indice => $valor) {
    echo "Dato " . ($indice + 1) . ": $valor\n";
}