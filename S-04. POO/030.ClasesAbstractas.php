<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "30. POO: Clases Abstractas\n";
echo "======================================================================\n\n";

abstract class FormaGeometrica  // Clase padre ABSTRACTA (Superclase)
{
    // 1. Atributos (propiedades) de la clase padre Abstracta
    protected string $nombre;
    protected string $color;

    // Métodos (funciones) de la clase padre Abstracta

    // Método mágico: Constructor
    public function __construct(string $nombreForma, string $colorForma)
    {
        $this->nombre = $nombreForma;
        $this->color = $colorForma;
    }

    // Métodos Abstractos de la clase padre Abstracta que tendrán que ser implementados por clases hijas
    abstract public function calcularPerimetro(): float;
    abstract public function calcularArea(): float;

    // Método concreto GETTER que todas las formas comparten
    public function mostrarInformacion(): string
    {
        return "Nombre: {$this->nombre} | Color: {$this->color} | Perímetro: " .
            number_format($this->calcularPerimetro(), 2) .
            " | Área: " . number_format($this->calcularArea(), 2);
    }
}

class TrianguloEquilatero extends FormaGeometrica   // Clase hija (Subclase) #1
{
    // 1. Atributos (propiedades) de la clase padre hija (concreta)
    private float $lado;

    // 2. Métodos (funciones) de la clase padre Abstracta
    // 2.1 Método mágico: Constructor EXTENDIDO (Conserva la lógica del padre y agrega más)
    public function __construct(string $color, float $lado)
    {
        parent::__construct("Triángulo Equilátero", $color);    // Se establece de una vez el parametró constante requerido por la clase padre ABSTRACTA
        $this->lado = $lado;
    }

    // 2.2 Métodos implementados sólicitados por la clase padre abstracta
    public function calcularArea(): float
    {
        return (sqrt(3) / 4) * pow($this->lado, 2); // Fórmula con sólo la longitud de uno de sus lados
    }

    public function calcularPerimetro(): float
    {
        return $this->lado * 3;
    }

    // Método concreto GETTER que todas las formas comparten EXTENDIDO
    public function mostrarInformacion(): string
    {
        return parent::mostrarInformacion() . " | Datos: lado con $this->lado de longitud.";
    }
}

class Rectangulo extends FormaGeometrica   // Clase hija (Subclase) #2
{
    // 1. Atributos (propiedades) de la clase padre hija (concreta)
    private float $base;
    private float $altura;

    // 2. Métodos (funciones) de la clase padre Abstracta
    // 2.1 Método mágico: Constructor EXTENDIDO (Conserva la lógica del padre y agrega más)
    public function __construct(string $color, float $base, float $altura)
    {
        parent::__construct("Rectángulo", $color);  // Se establece de una vez el parametró constante requerido por la clase padre ABSTRACTA
        $this->base = $base;
        $this->altura = $altura;
    }

    // 2.2 Métodos implementados sólicitados por la clase padre abstracta
    public function calcularArea(): float
    {
        return $this->base * $this->altura; // base x altura
    }

    public function calcularPerimetro(): float
    {
        return ($this->base * 2) + ($this->altura * 2);
    }

    // Método concreto GETTER que todas las formas comparten EXTENDIDO
    public function mostrarInformacion(): string
    {
        return parent::mostrarInformacion() . " | Datos: base con $this->base de longitud y altura de $this->altura .";
    }
}

class Circulo extends FormaGeometrica   // Clase hija (Subclase) #3
{
    // 1. Atributos (propiedades) de la clase padre hija (concreta)
    private float $radio;

    // 2. Métodos (funciones) de la clase padre Abstracta
    // 2.1 Método mágico: Constructor EXTENDIDO (Conserva la lógica del padre y agrega más)
    public function __construct(string $color, float $radio)
    {
        parent::__construct("Círculo", $color);  // Se establece de una vez el parametró constante requerido por la clase padre ABSTRACTA
        $this->radio = $radio;
    }

    // 2.2 Métodos implementados sólicitados por la clase padre abstracta
    public function calcularArea(): float
    {
        return pi() * pow($this->radio, 2);
    }

    public function calcularPerimetro(): float
    {
        return 2 * pi() * $this->radio;
    }

    // Método concreto GETTER que todas las formas comparten EXTENDIDO
    public function mostrarInformacion(): string
    {
        return parent::mostrarInformacion() . " | Datos: radio de $this->radio.";
    }
}

// Implementación
$triangulo = new TrianguloEquilatero("Amarillo", 6.0);
echo $triangulo->mostrarInformacion() . "\n";
$rectangulo = new Rectangulo("Rojo", 9.0, 10);
echo $rectangulo->mostrarInformacion() . "\n";
$circulo = new Circulo("Azul", 7);
echo $circulo->mostrarInformacion() . "\n";
