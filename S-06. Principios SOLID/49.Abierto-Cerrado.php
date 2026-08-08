<?php
header("Content-Type: text/plain");

echo "49. PRINCIPIOS SOLID: Open/Closed Principle (Principio Abierto/Cerrado) \n\n";

echo "49.1 ¿QUÉ SON LOS PRINCIPIOS SOLID?\n\n";

echo "Los PRINCIPIOS SOLID son conjunto de cinco principios de diseño orientados a objetos (POO)
que tienen como objetivo hacer que los diseños de software sean más COMPRENSIBLES, FLEXIBLES, MANTENIBLES y ESCALABLES.\n\n";

echo "Fueron promovidos por Robert C. Martin (conocido como \"Uncle Bob\")
a principios de la década de 2000, basados en conceptos anteriores de diseño.
Aplicarlos ayuda a evitar lo que se conoce como \"código con olor\" (code smells)
y a desarrollar sistemas más resistentes a los cambios.\n\n\n\n";


echo "49.2 ¿CUÁLES SON LOS PRINCIPIOS SOLID?\n\n";

echo "El acrónimo SOLID se forma con la inicial de cada uno de los cinco principios:
S - 1. Single Responsibility Principle (Principio de Responsabilidad Única)
O - 2. Open/Closed Principle (Principio de Abierto/Cerrado)
L - 3. Liskov Substitution Principle (Principio de Sustitución de Liskov)
I - 4. Interface Segregation Principle (Principio de Segregación de Interfaces)
D - 5. Dependency Inversion Principle (Principio de Inversión de Dependencias)\n\n\n\n";


echo "49.2.1 Open/Closed Principle (Principio de Abierto/Cerrado)\n\n";

echo "El Open/Closed Principle (OCP) establece que las entidades de software (clases, módulos, funciones, etc.) deben estar:
a) Abiertas a la extensión (Open for extension).
b) Cerradas a la modificación (Closed for modification).\n\n";

echo "Significado práctico:
    En esencia, el OCP significa que deberías poder agregar nueva funcionalidad (extensión) a un sistema
    sin tener que modificar el código existente y probado (modificación).\n\n";

echo "Esto se logra típicamente mediante el uso de abstracciones como Interfaces o Clases Abstractas.
El código que depende de una abstracción no necesita modificarse cuando se introduce una nueva implementación de esa abstracción.\n\n";

echo "Analogía: Piensa en un tomacorriente (la abstracción).
Está cerrado a la modificación (no tienes que cablearlo de nuevo para cada dispositivo),
pero está abierto a la extensión (puedes conectar un nuevo cargador o aparato sin modificar el tomacorriente).\n\n\n\n";


echo "49.2.1.1 MAL EJEMPLO de Violación del Open/Closed Principle (Principio de Abierto/Cerrado)\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";


class CalculadoraDeAreaTotal
{
    // Método que no respeta el OCP
    public function calcularAreaTotal(array $formas): float
    {
        $areaTotal = 0;

        foreach ($formas as $forma) {
            // ¡La violación está aquí!
            // Esta lógica DEBE modificarse cada vez que se agregue una nueva forma.
            if ($forma instanceof Circulo) {
                $areaTotal += (M_PI * $forma->radio * $forma->radio);
            } elseif ($forma instanceof Rectangulo) {
                $areaTotal += ($forma->ancho * $forma->alto);
            }
            // ¡SI SE AGREGAN MÁS FORMAS TENGO QUE ABRIR Y MODIFICAR ESTA CLASE!
        }
        return $areaTotal;
    }
}

class Circulo
{
    public $radio;
    public function __construct($radio) { $this->radio = $radio; }
}

class Rectangulo
{
    public $ancho;
    public $alto;
    public function __construct($anchoIngresado, $altoIngresado) { 
        $this->ancho = $anchoIngresado;
        $this->alto = $altoIngresado;
    }
}

$formas = [
    new Circulo(5),
    new Rectangulo(4, 6)
];

$calculadora = new CalculadoraDeAreaTotal();
echo "Área total (MAL EJEMPLO): " . $calculadora->calcularAreaTotal($formas) . "\n\n\n\n";


echo "La anterior clase viola el OCP por las siguientes razones: 
a) RAZÓN PARA EL CAMBIO:
    El método calcularAreaTotal() depende directamente de las implementaciones concretas (Circulo, Rectangulo)
    y usa un bloque condicional (if/elseif/instanceof) para determinar la lógica de cálculo.
b) VIOLACIÓN:
    Si se introduce una nueva forma geométrica (ej. Triangulo o Cuadrado),
    el desarrollador debe modificar la clase CalculadoraDeArea y agregar otra condición elseif.
c) PROBLEMA:
    La clase CalculadoraDeArea no está cerrada a la modificación.
    Cada nueva extensión (nueva forma) requiere un cambio en el núcleo de la lógica.\n\n";




echo "48.2.1.2 BUEN EJEMPLO de Single Responsibility Principle (Principio de Responsabilidad Única)\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";

// INTERFACES
// 1. CalcularArea. Definición de la interfaz para calcular el área de una X forma.
interface CalcularArea
{
    public function area(): float;
}

// CLASES
// CLASE IMPLEMENTADORA DE LA INTERFAZ #1: Para la figura del círculo.
class CirculoOCP implements CalcularArea
{
    public $radio;
    public function __construct($radio) { $this->radio = $radio; }

    public function area(): float
    {
        return M_PI * $this->radio * $this->radio;
    }
}
// CLASE IMPLEMENTADORA DE LA INTERFAZ #2: Para la figura del rectángulo.
class RectanguloOCP implements CalcularArea
{
    public $ancho;
    public $alto;
    public function __construct($ancho, $alto) { $this->ancho = $ancho; $this->alto = $alto; }

    public function area(): float
    {
        return $this->ancho * $this->alto;
    }
}

// *EXTENSIONES SIN MODIFICACIÓN:* Se añade una nueva forma, pero NO se toca la clase CalculadoraDeAreaOCP.
// CLASE IMPLEMENTADORA DE LA INTERFAZ #3: Para la figura del círculo.
/* class TrianguloOCP implements CalcularAreaForma
{
    public $base;
    public $altura;
    public function __construct($base, $altura) { $this->base = $base; $this->altura = $altura; }

    public function area(): float
    {
        return ($this->base * $this->altura) / 2;
    }
} */


// 3. CLASE CERRADA A LA MODIFICACIÓN: Depende de la ABSTRACCIÓN (Forma).
class CalculadoraDeAreaTotalOCP
{
    // El método ahora acepta un array de la ABSTRACCIÓN 'Forma'.
    public function calcularAreaTotal(array $formas): float
    {
        $areaTotal = 0;

        foreach ($formas as $forma) {
            // Ya no hay IF/ELSEIF/SWITCH. Simplemente se llama al método 'area()'.
            // Esta clase NUNCA necesitará ser modificada.
            $areaTotal += $forma->area();
        }
        return $areaTotal;
    }
}

// USO:
// Definición de arreglo
$formasOCP = [
    new CirculoOCP(5),
    new RectanguloOCP(4, 6),
    // new TrianguloOCP(10, 5) // ¡Agregamos una nueva forma sin modificar CalculadoraDeAreaOCP!
];

$calculadoraOCP = new CalculadoraDeAreaTotalOCP();
echo "Área total (BUEN EJEMPLO): " . $calculadoraOCP->calcularAreaTotal($formasOCP) . "\n\n";

echo "El código anterio demuestra que para adherirse al OCP, se
separa la abstracción (la necesidad de calcular un área) de la implementación (cómo se calcula el área para cada forma).
1. Abierto a la extensión: 
    Si quieres agregar una nueva forma (como TrianguloOCP),
    simplemente creas una nueva clase que implemente la interfaz Forma.
2. Cerrado a la modificación:
    La clase CalculadoraDeAreaOCP nunca necesita ser modificada. Su método calcularAreaTotal solo sabe que debe llamar al método area() de la interfaz Forma, sin importarle cómo se implementa ese cálculo.\n\n";

echo "Al depender de la abstracción (Interface Forma) en lugar de las implementaciones concretas,
has creado un sistema que es flexible y estable, el objetivo principal del OCP (y de la POO en general).\n\n";
?>