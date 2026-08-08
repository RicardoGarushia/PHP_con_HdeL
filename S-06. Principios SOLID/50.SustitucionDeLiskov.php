<?php
header("Content-Type: text/plain");

echo "50. PRINCIPIOS SOLID: Liskov Substitution Principle (Principio de Sustitución de Liskov) \n\n";

echo "50.1 ¿QUÉ SON LOS PRINCIPIOS SOLID?\n\n";

echo "Los PRINCIPIOS SOLID son conjunto de cinco principios de diseño orientados a objetos (POO)
que tienen como objetivo hacer que los diseños de software sean más COMPRENSIBLES, FLEXIBLES, MANTENIBLES y ESCALABLES.\n\n";

echo "Fueron promovidos por Robert C. Martin (conocido como \"Uncle Bob\")
a principios de la década de 2000, basados en conceptos anteriores de diseño.
Aplicarlos ayuda a evitar lo que se conoce como \"código con olor\" (code smells)
y a desarrollar sistemas más resistentes a los cambios.\n\n\n\n";


echo "50.2 ¿CUÁLES SON LOS PRINCIPIOS SOLID?\n\n";

echo "El acrónimo SOLID se forma con la inicial de cada uno de los cinco principios:
S - 1. Single Responsibility Principle (Principio de Responsabilidad Única)
O - 2. Open/Closed Principle (Principio de Abierto/Cerrado)
L - 3. Liskov Substitution Principle (Principio de Sustitución de Liskov)
I - 4. Interface Segregation Principle (Principio de Segregación de Interfaces)
D - 5. Dependency Inversion Principle (Principio de Inversión de Dependencias)\n\n\n\n";


echo "50.2.1 Open/Closed Principle (Principio de Abierto/Cerrado)\n\n";

echo "El Principio de Sustitución de Liskov (LSP), formulado por Barbara Liskov, establece que:
    \"Si S es un subtipo de T...
    Entonces los objetos del tipo T pueden ser reemplazados por objetos del tipo S, 
    sin alterar las propiedades deseables del programa.\"\n\n";

echo "Significado práctico: 
    En términos más simples, 
    una clase derivada (hija) debe ser completamente sustituible por su clase base (padre)
    sin que el código cliente (el código que usa esas clases) sepa o le importe que está usando la clase derivada.\n\n";

echo "  Si tu código funciona con la clase base, 
    también debe funcionar perfectamente con cualquier clase hija
    sin generar comportamientos inesperados o romper la lógica.\n\n";

echo "Violaciones Comunes del LSP:
    a) Una subclase lanza excepciones que la clase base no lanza y que el código cliente no espera.
    b) Una subclase redefine un método de la clase base de una manera que restringe el comportamiento del método
    (ej. un método de la clase base recibe cualquier array, pero la subclase solo acepta arrays de dos elementos).\n\n\n\n";


echo "49.2.1.1 MAL EJEMPLO de Violación del Liskov Substitution Principle (Principio de Sustitución de Liskov)\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";

// Clase padre/base
class Rectangulo
{
    protected $ancho;
    protected $alto;

    public function __construct(int $ancho, int $alto)
    {
        $this->ancho = $ancho;
        $this->alto = $alto;
    }

    public function setAncho(int $ancho): void {
        $this->ancho = $ancho;
    }

    public function setAlto(int $alto): void {
        $this->alto = $alto;
    }

    public function area(): int
    {
        return $this->ancho * $this->alto;
    }
}

// Subclase que VIOLA el LSP
class Cuadrado extends Rectangulo
{
    // El problema ocurre al SOBREESCRIBIR los setters.
    // Un cuadrado DEBE tener el mismo ancho y alto.
    public function setAncho(int $lado): void
    {
        $this->ancho = $lado;
        $this->alto = $lado; // ¡Comportamiento forzado!
    }

    public function setAlto(int $lado): void
    {
        $this->ancho = $lado; // ¡Comportamiento forzado!
        $this->alto = $lado;
    }
}

// CÓDIGO CLIENTE (Función que usa la clase Rectangulo/Base)
function probarArea(Rectangulo $forma)
{
    // El cliente asume que al hacer setAncho, el alto NO cambia.
    $forma->setAncho(5);
    $forma->setAlto(10);
    // El cliente espera un área de 5 * 10 = 50.
    echo "El área esperada es 50. El área real es: " . $forma->area() . "\n";
}

// Ejecución con la clase base (Rectangulo)
$rectangulo = new Rectangulo(2, 3);
echo "--- Probando Rectangulo (Clase Base) ---\n";
probarArea($rectangulo); // Salida: 50. ¡Correcto!

// Ejecución con la subclase (Cuadrado)
$cuadrado = new Cuadrado(2, 2);
echo "--- Probando Cuadrado (Subclase) ---\n";
// Cuando el código llama a setAlto(10), el setAncho(5) se borra, ya que setAlto en Cuadrado iguala ancho y alto.
probarArea($cuadrado); // Salida: 100. ¡Incorrecto! La subclase ha roto la asunción del código cliente.


echo "La anterior clase viola el LSP por las siguientes razones: 
a) RAZÓN PARA LA VIOLACIÓN:
    La clase Cuadrado fuerza una restricción sobre la clase Rectangulo: modifica el ancho cuando se modifica el alto, y viceversa.
b) Rotura del LSP:
    El código cliente (probarArea) fue escrito para trabajar con un Rectangulo (la clase base),
    asumiendo que setAncho y setAlto son operaciones independientes.
        Al pasar un Cuadrado (el subtipo), esta asunción se rompe, y el resultado del área es inesperado.
Conclusión:
    Un Cuadrado no es un sustituto seguro de un Rectangulo en este contexto,
    lo que significa que el modelo de herencia es incorrecto para esta funcionalidad.\n\n\n\n";


echo "48.2.1.2 BUEN EJEMPLO del Liskov Substitution Principle (Principio de Sustitución de Liskov)\n\n";

echo "Para respetar el LSP:
las clases deben heredar de una abstracción que defina un contrato de comportamiento que todas las subclases puedan cumplir sin restricciones.
En lugar de usar la herencia concreta de Rectangulo,
usamos una interfaz (o alguna clase base abstracta) que solo define el contrato de calcular el área
(¡similar a la solución del OCP! Véase 48.ResponsabilidadUnica.php).";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";

// INTERFACES
// 1. AreaFormaLSP. Definición de la interfaz para calcular el área de una X forma.
interface AreaFormaLSP
{
    public function area(): float;
}

// CLASES
// CLASE IMPLEMENTADORA DE LA INTERFAZ #1: Para la figura del Rectángulo.
class RectanguloLSP implements AreaFormaLSP
{
    // Propiedades/Atributos de la clase RectanguloLSP
    protected $ancho;
    protected $alto;

    // MÉTODOS:
    // MÉTODOS 1. GETTERS Y SETTERS
    // No hay setters que puedan causar un comportamiento inesperado.

    // MÉTODOS 2. FUNCIONES INSTANCIADAS
    // Método #2.1: Calcular área
    public function area(): float
    {
        return $this->ancho * $this->alto;
    }

    // MÉTODOS MÁGICOS
    public function __construct(float $ancho, float $alto)
    {
        $this->ancho = $ancho;
        $this->alto = $alto;
    }
}

// CLASE IMPLEMENTADORA DE LA INTERFAZ #2: Para la figura del Cuadrado.
class CuadradoLSP implements AreaFormaLSP
{
    protected $lado;

    public function __construct(float $lado)
    {
        $this->lado = $lado;
    }

    public function area(): float
    {
        return $this->lado * $this->lado;
    }
}

// CÓDIGO CLIENTE (Función que usa la Interfaz/Contrato)
// CLASE CONSUMIDORA #1: Recibe el objeto de las clases implementadoras 
function probarAreaLSP(AreaFormaLSP $forma)
{
    // El cliente solo sabe que puede llamar a 'area()'.
    // No intenta manipular ancho y alto, evitando la rotura del comportamiento.
    echo "El área real es: " . $forma->area() . "\n";
}

// Ejecución con RectanguloLSP
$rectanguloLSP = new RectanguloLSP(5, 10);
echo "--- Probando Rectangulo (Clase Segura) ---\n";
probarAreaLSP($rectanguloLSP); // Salida: 50.

// Ejecución con CuadradoLSP
$cuadradoLSP = new CuadradoLSP(5);
echo "--- Probando Cuadrado (Clase Segura) ---\n";
probarAreaLSP($cuadradoLSP); // Salida: 25.


echo "El código anterior demuestra que para adherirse al LSP:
1. Cumplimiento del LSP:
    Ambas clases (RectanguloLSP y CuadradoLSP) implementan el mismo contrato (AreaFormaLSP)
    sin modificar el comportamiento esperado de area().
2. Seguridad: 
    El código cliente (probarAreaLSP) solo interactúa con la abstracción (FormaLSP).
    No intenta realizar operaciones que son exclusivas o problemáticas para alguna de las implementaciones (como modificar independientemente el ancho y el alto).\n\n";

echo "Conclusión: 
    El LSP nos fuerza a diseñar el sistema pensando en comportamiento (a través de interfaces)
    y no solo en datos (a través de herencia de clases concretas).\n\n";
?>

