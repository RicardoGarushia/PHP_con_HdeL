<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "28. POO: Encapsulamiento\n";
echo "======================================================================\n\n";

echo "28.1 DEFINE ENCAPSULAMIENTO\n";
echo "El encapsulamiento es un concepto fundamental en POO que agrupa datos (propiedades)\n";
echo "y métodos en una clase, restringiendo el acceso directo mediante la ocultación de información.\n\n";

echo "28.2 OBJETIVOS DEL ENCAPSULAMIENTO\n";
echo "a) Agrupar y organizar el código en una entidad autocontenida.\n";
echo "b) Proteger la integridad de los datos evitando modificaciones no autorizadas.\n\n";

echo "28.3 BENEFICIOS DEL ENCAPSULAMIENTO\n";
echo "Modularidad, Ocultamiento de la complejidad, Control de acceso, Flexibilidad y Reusabilidad.\n\n";

echo "28.4 EJEMPLO PRÁCTICO EN EJECUCIÓN\n";

class Persona
{
    private string $curp;
    private string $nombre;
    private string $apellidoP;
    private string $apellidoM;
    private float $estatura;
    private float $peso;
    private float $IMC;

    public function __construct(
        string $curpCliente,
        string $nombreCliente,
        string $apellidoPCliente,
        string $apellidoMCliente,
        float $estaturaCliente,
        float $pesoCliente
    ) {
        $this->curp = $curpCliente;
        $this->nombre = $nombreCliente;
        $this->apellidoP = $apellidoPCliente;
        $this->apellidoM = $apellidoMCliente;
        $this->estatura = $estaturaCliente;
        $this->peso = $pesoCliente;
        $this->IMC = $pesoCliente / ($estaturaCliente * $estaturaCliente);
    }

    public function getNombreCompleto(): array
    {
        return [
            $this->apellidoP,
            $this->apellidoM,
            $this->nombre
        ];
    }

    public function getIMC(): float
    {
        return $this->IMC;
    }
}

$cliente = new Persona("GALR901123HDF", "Ricardo", "García", "López", 1.71, 84.5);

$arrayCliente = $cliente->getNombreCompleto();
echo "El cliente: ";
foreach ($arrayCliente as $valor) {
    echo "$valor ";
}
echo "\nTiene un IMC de: " . number_format($cliente->getIMC(), 2) . "\n\n";