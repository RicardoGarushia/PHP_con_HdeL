<?php

header(header: "Content-Type: text/plain");

echo"\n33. POLIMORFISMO: Interfaces\n\n";

echo"32.1 ¿Qué el polimorfismo?\n";
echo"El polimorfismo se refiere a la capacidad de que un método se comporte de 
distintas formas, dependiendo del objeto que lo invoque. 
El polimorfismo se declara o implementa en una clase (o una interfaz o un trait)
y se muestra o ejecuta en los objetos de dicha clase (o interfaz o trait).\n\n";

echo"32.1.1 ¿Para qué es el polimorfismo?\n";
echo "El polimorfismo permite: 
a) Flexibilidad y extensibilidad: 
permite escribir código genérico que trabaja con “cualquier objeto que cumpla cierta interfaz”.
b) Desacoplamiento: 
el cliente (quien usa el objeto) no necesita saber la clase concreta, solo la interfaz o clase base.
c) Mantenibilidad: 
nuevos tipos pueden integrarse sin cambiar el código que los utiliza.\n\n";

echo "El polimorfismo se logra de diferentes maneras en cada uno: 
    a) Clase padre (herencia): El polimorfismo se logra a través de la sobreescritura de métodos.
    b) Interfaces: El polimorfismo se logra cuando las clases implementan los métodos definidos en la interfaz.
    c) Traits (rasgos): El polimorfismo se logra si diferentes clases utilizan el mismo trait que define un método.\n\n\n";

echo "33.2 Polimorfismo en interfaces\n";
echo "Una interface en POO define un contrato. 
Especifica un conjunto de métodos (solo la firma: nombre, parámetros y tipo de retorno) 
que cualquier clase que implemente esa interfaz debe proporcionar. 
Una interfaz en sí misma NO contiene ninguna implementación concreta de estos métodos.\n\n";

echo "En este caso, el polimorfismo se manifiesta cuando tienes múltiples clases
que implementan la misma interfaz, 
pero cada una de ellas proporciona su propia implementación específica 
para los métodos definidos en la interfaz.\n\n";

echo "Esto permite que puedas tratar objetos de diferentes clases de una manera uniforme 
a través de la interfaz común, sin necesidad de conocer su tipo concreto. 
En tiempo de ejecución, el sistema determinará qué implementación del método llamar 
basándose en el tipo real del objeto.\n\n";


// INTERFACES
// Definición de la interfaz GetInfo: La interfaz define un contrato que las clases deben cumplir
interface GetInfo
{
    // Firma del método (prototipo del método) que las clases deben implementar
    public function GetInfo(): string;
}


// CLASE IMPLEMENTADORA DE LA INTERFAZ #1 que implementa la interfaz GetInfo
class Direccion implements GetInfo
{
    private string $direccion;

    public function __construct(string $calle, string $numero, string $colonia, string $codigoPostal, string $delegacion, string $ciudad)
    {
        $this->direccion = "C. $calle #$numero, Col. $colonia, C.P. $codigoPostal, $delegacion, $ciudad";
    }
    // Implementación del método GetInfo definido en la interfaz
    public function GetInfo(): string
    {
        return "Dirección cliente: {$this->direccion}\n";
    }
}

// CLASE IMPLEMENTADORA DE LA INTERFAZ #2 que implementa la interfaz GetInfo
class CartaYuGiOh implements GetInfo
{
    private string $cartaYuGiOh;

    public function __construct(string $nombreCarta, $descripcionCarta)
    {
        $this->cartaYuGiOh = "$nombreCarta - $descripcionCarta";
    }
    // Implementación del método GetInfo definido en la interfaz
    public function GetInfo(): string
    {
        return "Carta elegida por cliente: {$this->cartaYuGiOh}\n";
    }
}

// CLASE IMPLEMENTADORA DE LA INTERFAZ #3 que implementa la interfaz GetInfo
class PaginaWeb implements GetInfo
{
    private string $url;

    public function __construct(string $urlIngresada)
    {
        $this->url = $urlIngresada;
    }
    // Implementación del método GetInfo definido en la interfaz
    public function GetInfo(): string
    {
        return "Página web del cliente: {$this->url}\n";
    }
}


// FUNCIÓN CONSUMIDORA #1: Recibe el objeto de las clases implementadoras 
// Función que acepta cualquier objeto que implemente la interfaz GetInfo
function mostrarInformacion(GetInfo $objeto): void
{
    echo "Procesando la información mediante la FUNCIÓN consumidora
    (recuerda que también puede ser mediante una CLASE consumidora
    -véase 31. Interfaces-)\n";
    echo $objeto->GetInfo();
}

$direccion = new Direccion("Cocotal", "123", "Buenavista", "09700", "Iztapalapa", "CDMX");
$carta = new CartaYuGiOh("Dragón Blanco de Ojos Azules", "Este legendario dragón es una poderosa máquina de destrucción. Virtualmente invencible, muy pocos se han enfrentado a esta asombrosa criatura y han vivido para contarlo.");
$paginaWeb = new PaginaWeb("https://hdeleon.net/");
// Modificar la variable que contiene el objeto para mostrar información del mismo usando polimorfismo
mostrarInformacion($direccion);
