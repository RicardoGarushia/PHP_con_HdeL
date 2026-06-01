<?php

header( "Content-Type: text/plain");

echo "\n30. CLASES ABSTRACTAS\n";
echo "En Programación Orientada a Objetos (POO), las clases abstractas son clases que no pueden ser instanciadas directamente. 
Su propósito principal es servir como plantillas o planos para otras clases (conocidas como clases concretas) que heredarán de ellas.
Es decir, las clases abstractas están diseñadas para ser extendidas por otras clases. 
Proporcionan una estructura base y definen ciertos métodos que las clases hijas deben implementar, 
asegurando así un cierto comportamiento en la jerarquía de clases\n\n.";

echo "Enseguida se muestrán las características clave de las clases abstractas en PHP:
a) Declaración: Se definen utilizando la palabra clave \"abstract\" antes de la palabra clave class.\n\n";

echo"<?php
abstract class MiClaseAbstracta {
    // ... propiedades y métodos ...
}
?>\n\n\n";

echo "b) No se pueden instanciar: No es posible crear objetos directamente de una clase abstracta. 
Intentar hacerlo resultará en un error.\n\n";

echo"<?php
abstract class MiClaseAbstracta {
    // ... propiedades y métodos ...
}

// Esto generará un error
// \$objeto = new MiClaseAbstracta();
?>\n\n\n";

echo "c) Pueden contener métodos abstractos y concretos:
Métodos abstractos: Son métodos declarados en la clase abstracta pero sin implementación. 
Se definen utilizando la palabra clave abstract antes de la palabra clave function. 
Las clases abstractas están diseñadas para ser extendidas por otras clases. 
Proporcionan una estructura base y definen ciertos métodos que las clases hijas deben implementar, 
asegurando así un cierto comportamiento en la jerarquía de clases.
Las clases concretas que heredan de la clase abstracta TIENEN QUE implementar estos métodos abstractos.
Métodos concretos: Son métodos que tienen una implementación completa dentro de la clase abstracta. 
Las clases hijas pueden heredar y utilizar estos métodos tal cual, o pueden sobreescribirlos (definir su propia implementación).\n\n";

echo"<?php
abstract class MiClaseAbstracta {
    // ... propiedades y métodos ...

    // Método abstracto
    abstract public function miMetodoAbstracto(\$parametro);

    // Método concreto
    public function miMetodoConcreto(\$parametro);
}

// Esto generará un error
// \$objeto = new MiClaseAbstracta();
?>\n\n\n";

echo "30.1 EJEMPLO DE CLASES ABSTRACTAS\n";
echo"<?php
abstract class FormaGeométrica
{
    // Propiedades o atributos de CLASE PADRE
    protected string \$nombre;
    protected string \$color;

    // Métodos ABSTRACTOS que TENDRÁN QUE ser implementado por clases hijas
    abstract public function calcularPerimetro();   // En caso de no implementarse en clases hijas mostrará ERROR
    abstract public function calcularArea();    // En caso de no implementarse en clases hijas mostrará ERROR

    // Método concreto que todas las formas comparten
    public function mostrarInformacion()
    {
        return \"\\nNombre de la figura: \" . \$this->nombre .
        \"\\nColor de la figura: \" . \$this->color .
        \"\\nPerímetro: \" . \$this->calcularPerimetro() .
        \"\\nÁrea: \" . \$this->calcularArea();
    }
    // Constructor
    public function __construct(string \$nombreForma, string \$colorForma)
    {
        \$this->nombre = \$nombreForma;
        \$this->color = \$colorForma;
    }
    // Métodos GETTERS y SETTERS
    public function getColor()
    {
        return \$this->color;
    }
    public function setColor(\$color)
    {
        \$this->color = \$color;
    }
    public function getNombre()
    {
        return \$this->nombre;
    }
    public function setNombre(\$nombre)
    {
        \$this->nombre = \$nombre;
    }
}

class Rectangulo extends FormaGeométrica
{
    // Propiedades o atributos de CLASE HIJA
    private const NOMBRE = \"Rectángulo\";
    private float \$base;
    private float \$altura;

    // Métodos que TIENEN QUE IMPLEMENTARSE por petición de la clase Padre
    public function calcularArea()  // ERROR: En caso de no implementarse
    {
        return \$this->base * \$this->altura;
    }
    public function calcularPerimetro()  // ERROR: En caso de no implementarse
    {
        return (\$this->base * 2) + (\$this->altura * 2);
    }

    // Constructor OVERRIDE

    public function __construct(string \$colorForma, float \$baseIngresada, float \$alturaIngresada)
    {
        parent::__construct(self::NOMBRE, \$colorForma);
        \$this->base = \$baseIngresada;
        \$this->altura = \$alturaIngresada;
    }
}

class Circulo extends FormaGeométrica
{
    // Propiedades o atributos de CLASE HIJA
    private const NOMBRE = \"Círculo\";
    private \$radio;

    // Constructor OVERRIDE

    public function __construct(string \$colorForma, float \$radioIngresado)
    {
        parent::__construct(self::NOMBRE, \$colorForma);
        \$this->radio = \$radioIngresado;
    }

    // Métodos que TIENEN QUE IMPLEMENTARSE por petición de la clase Padre
    public function calcularArea()  // ERROR: En caso de no implementarse
    {
        return pi() * pow(\$this->radio, 2);
    }
    public function calcularPerimetro()  // ERROR: En caso de no implementarse
    {
        return 2 * pi() * \$this->radio;
    }
}

// No se puede instanciar la clase abstracta FormaGeométrica por ser una clase abstracta
// \$forma = new FormaGeométrica(\"rectángulo\", \"rojo\"); // Esto daría un error

\$rectangulo = new Rectangulo(\"azul\", 5, 10);
\$circulo = new Circulo(\"verde\", 7);

echo \$rectangulo->mostrarInformacion() . \"\\n\"; // Color: azul, Perímetro: 30, Área: 50
echo \$circulo->mostrarInformacion() . \"\\n\";   // Color: verde, Perímetro: 43.982297150257, Área: 153.93804002589
?>\n\n\n";

abstract class FormaGeométrica
{
    // Propiedades o atributos de CLASE PADRE
    protected string $nombre;
    protected string $color;

    // Métodos ABSTRACTOS que TENDRÁN QUE ser implementado por clases hijas
    abstract public function calcularPerimetro();   // En caso de no implementarse en clases hijas mostrará ERROR
    abstract public function calcularArea();    // En caso de no implementarse en clases hijas mostrará ERROR

    // Método concreto que todas las formas comparten
    public function mostrarInformacion()
    {
        return "\nNombre de la figura: " . $this->nombre .
        "\nColor de la figura: " . $this->color .
        "\nPerímetro: " . $this->calcularPerimetro() .
        "\nÁrea: " . $this->calcularArea();
    }
    // Constructor
    public function __construct(string $nombreForma, string $colorForma)
    {
        $this->nombre = $nombreForma;
        $this->color = $colorForma;
    }
    // Métodos GETTERS y SETTERS
    public function getColor()
    {
        return $this->color;
    }
    public function setColor($color)
    {
        $this->color = $color;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}

class Rectangulo extends FormaGeométrica
{
    // Propiedades o atributos de CLASE HIJA
    private const NOMBRE = "Rectángulo";
    private float $base;
    private float $altura;

    // Métodos que TIENEN QUE IMPLEMENTARSE por petición de la clase Padre
    public function calcularArea()  // ERROR: En caso de no implementarse
    {
        return $this->base * $this->altura;
    }
    public function calcularPerimetro()  // ERROR: En caso de no implementarse
    {
        return ($this->base * 2) + ($this->altura * 2);
    }

    // Constructor OVERRIDE

    public function __construct(string $colorForma, float $baseIngresada, float $alturaIngresada)
    {
        parent::__construct(self::NOMBRE, $colorForma);
        $this->base = $baseIngresada;
        $this->altura = $alturaIngresada;
    }
}

class Circulo extends FormaGeométrica
{
    // Propiedades o atributos de CLASE HIJA
    private const NOMBRE = "Círculo";
    private $radio;

    // Constructor OVERRIDE

    public function __construct(string $colorForma, float $radioIngresado)
    {
        parent::__construct(self::NOMBRE, $colorForma);
        $this->radio = $radioIngresado;
    }

    // Métodos que TIENEN QUE IMPLEMENTARSE por petición de la clase Padre
    public function calcularArea()  // ERROR: En caso de no implementarse
    {
        return pi() * pow($this->radio, 2);
    }
    public function calcularPerimetro()  // ERROR: En caso de no implementarse
    {
        return 2 * pi() * $this->radio;
    }
}

// No se puede instanciar la clase abstracta FormaGeométrica por ser una clase abstracta
// $forma = new FormaGeométrica("rectángulo", "rojo"); // Esto daría un error

$rectangulo = new Rectangulo("azul", 5, 10);
$circulo = new Circulo("verde", 7);

echo $rectangulo->mostrarInformacion() . "\n"; // Color: azul, Perímetro: 30, Área: 50
echo $circulo->mostrarInformacion() . "\n";   // Color: verde, Perímetro: 43.982297150257, Área: 153.93804002589
