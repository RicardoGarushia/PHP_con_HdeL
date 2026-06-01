<?php
header("Content-Type: text/plain");

echo "48. PRINCIPIOS SOLID: Single Responsibility Principle (Principio de Responsabilidad Única) \n\n";

echo "48.1 ¿QUÉ SON LOS PRINCIPIOS SOLID?\n\n";

echo "Los PRINCIPIOS SOLID son conjunto de cinco principios de diseño orientados a objetos (POO)
que tienen como objetivo hacer que los diseños de software sean más COMPRENSIBLES, FLEXIBLES, MANTENIBLES y ESCALABLES.\n\n";

echo "Fueron promovidos por Robert C. Martin (conocido como \"Uncle Bob\")
a principios de la década de 2000, basados en conceptos anteriores de diseño.
Aplicarlos ayuda a evitar lo que se conoce como \"código con olor\" (code smells)
y a desarrollar sistemas más resistentes a los cambios.\n\n\n\n";


echo "48.2 ¿CUÁLES SON LOS PRINCIPIOS SOLID?\n\n";

echo "El acrónimo SOLID se forma con la inicial de cada uno de los cinco principios:
S - 1. Single Responsibility Principle (Principio de Responsabilidad Única)
O - 2. Open/Closed Principle (Principio de Abierto/Cerrado)
L - 3. Liskov Substitution Principle (Principio de Sustitución de Liskov)
I - 4. Interface Segregation Principle (Principio de Segregación de Interfaces)
D - 5. Dependency Inversion Principle (Principio de Inversión de Dependencias)\n\n\n\n";


echo "48.2.1 Interface Segregation Principle (ISP, Principio de Segregación de Interfaces)\n\n";

echo "El Interface Segregation Principle (ISP, Principio de Segregación de Interfaces) establece que: 
    \"Ningún cliente debe ser forzado a depender de métodos que no usa.\"\n\n";

echo "Responsabilidad: Se refiere a un eje de cambio o un actor (persona, rol) que podría solicitar un cambio en el código.\n\n";

echo "Significado práctico: 
    En esencia, es mejor tener muchas interfaces pequeñas y específicas (segregadas)
    que una sola interfaz grande y \"amplia\" o \"gorda\" (monolítica).\n\n";

echo "Cuando una clase implementa una interfaz, se convierte en un \"cliente\" de esa interfaz.
Si la interfaz obliga a la clase a implementar métodos que no son relevantes para ella,
la interfaz está \"contaminada\" y viola el ISP.\n\n";

echo "Analogía: 
Piensa en un control remoto universal.
Si solo quieres encender y apagar la TV (una pequeña necesidad),
pero el control te obliga a tener y entender cientos de botones para satélite, DVD, y audio que nunca usarás, es ineficiente.
Un control remoto con solo Botones de TV (una interfaz pequeña y específica) sería mejor.\n\n\n\n";

echo "48.2.1.1 MAL EJEMPLO de Violación del Single Responsibility Principle (Principio de Responsabilidad Única)\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";


// Interfaz "Gorda" o Monolítica
interface DispositivoDeOficina
{
    public function imprimir(): void;
    public function escanear(): void;
    public function enviarFax(): void;
    public function recargarToner(): void;
}

// Clase Cliente #1: Impresora Multifuncional (usa todos los métodos)
class Multifuncional implements DispositivoDeOficina
{
    public function imprimir(): void { echo "Imprimiendo...\n"; }
    public function escanear(): void { echo "Escaneando...\n"; }
    public function enviarFax(): void { echo "Enviando fax...\n"; }
    public function recargarToner(): void { echo "Recargando toner...\n"; }
}

// Clase Cliente #2: Impresora Básica (NO usa 'escanear' ni 'enviarFax')
class ImpresoraBasica implements DispositivoDeOficina
{
    public function imprimir(): void { echo "Imprimiendo en básica...\n"; }
    
    // **VIOLACIÓN:** Esta clase es forzada a implementar métodos que no usa.
    public function escanear(): void
    {
        // El cliente es forzado a poner lógica de "no-uso" o lanzar excepciones.
        throw new Exception("¡Error! La impresora básica no puede escanear.");
    }
    
    public function enviarFax(): void
    {
        // Más lógica innecesaria.
        // El cliente está contaminado por métodos que no le pertenecen.
        throw new Exception("¡Error! La impresora básica no puede enviar fax.");
    }
    
    public function recargarToner(): void { echo "Recargando toner en básica...\n"; }
}
$impresora = new ImpresoraBasica();
$impresora->escanear(); // Esto forzaría un error, mostrando que el contrato está mal.

echo "La anterior interfaz DispositivoDeOficina viola el ISP porque es \"gorda\"
y combina responsabilidades de impresión, escaneo y fax en un solo contrato.\n\n\n\n";

echo "Problema (Razón para cambiar):
    La clase ImpresoraBasica (el cliente) se ve obligada a implementar los métodos: 
        escanear() y enviarFax()
    a pesar de que no son relevantes para su funcionalidad.
    Esto contamina la clase con código inútil o con lógica de manejo de errores que NO debería existir si el diseño fuera correcto.\n\n\n\n";

echo "Consecuencia:
Cualquier cambio en la lógica del fax (ej. nueva versión del protocolo) 
obligaría a recompilar y potencialmente modificar a todas las clases que implementan la interfaz, 
incluso las que nunca enviarán un fax.\n\n\n\n";


echo "48.2.1.2 BUEN EJEMPLO de Interface Segregation Principle (ISP, Principio de Segregación de Interfaces)\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";


// Interfaces Segregadas (Específicas al Cliente)
interface InterfazImpresora
{
    public function imprimir(): void;
    public function recargarToner(): void;
}

interface InterfazEscaner
{
    public function escanear(): void;
}

interface InterfazFax
{
    public function enviarFax(): void;
}

// Clase Cliente #1: Multifuncional (implementa todas las interfaces que usa)
class MultifuncionalISP implements InterfazImpresora, InterfazEscaner, InterfazFax
{
    public function imprimir(): void { echo "Multifuncional: Imprimiendo...\n"; }
    public function recargarToner(): void { echo "Multifuncional: Recargando toner...\n"; }
    public function escanear(): void { echo "Multifuncional: Escaneando...\n"; }
    public function enviarFax(): void { echo "Multifuncional: Enviando fax...\n"; }
}

// Clase Cliente #2: Impresora Básica (solo implementa la interfaz que usa)
class ImpresoraBasicaISP implements InterfazImpresora
{
    public function imprimir(): void { echo "Impresora Básica: Imprimiendo en básica...\n"; }
    public function recargarToner(): void { echo "Impresora Básica: Recargando toner...\n"; }
    
    // El cliente NO es forzado a tener 'escanear' o 'enviarFax'. ¡Éxito del ISP!
}

// CLASES CLIENTE DE USO:
function usarImpresora(InterfazImpresora $dispositivo) {
    $dispositivo->imprimir();
}

function usarEscaner(InterfazEscaner $dispositivo) {
    $dispositivo->escanear();
}

$impresoraBasica = new ImpresoraBasicaISP();
usarImpresora($impresoraBasica); // Funciona
usarEscaner($impresoraBasica); // Daría error en el cliente de uso, pero no forzaría a ImpresoraBasicaISP a tener código inútil.


echo "La anterior clase es un BUEN EJEMPLO que demuestra la aplicación correcta del ISP dado que:
1. CUMPLIMIENTO: 
    La clase ImpresoraBasicaISP solo implementa InterfazImpresora y no es forzada a lidiar con la lógica de escaneo o fax.
2. FLEXIBILIDAD: 
    Si la lógica del fax cambia, solo se modifica o extiende InterfazFax.
    Solo las clases que implementan esa interfaz (como MultifuncionalISP) se ven afectadas,
    dejando intactas a clases como ImpresoraBasicaISP.\n\n";

echo "CONCLUSIÓN:
Al segregar las interfaces, 
garantizas que los clientes solo dependan de los contratos (métodos) que realmente necesitan,
haciendo el código más robusto, fácil de mantener y más claro en su propósito.\n\n\n\n";




?>