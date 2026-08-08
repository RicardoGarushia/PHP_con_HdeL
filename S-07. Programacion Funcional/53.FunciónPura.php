<?php
header("Content-Type: text/plain");

echo "53. PROGRAMACIÓN FUNCIONAL: Función Pura \n\n";

echo "53.1 ¿QUÉ ES LA \"PROGRAMACIÓN FUNCIONAL\"?\n\n";

echo "La PROGRAMACIÓN FUNCIONAL es un PARADIGMA DE PROGRAMACIÓN que trata a la computación como 
a) LA EVALUACIÓN DE FUNCIONES MATEMÁTICAS, 
b) EVITA EL ESTADO COMPARTIDO 
c) Y LOS DATOS MUTABLES (datos que pueden cambiar después de su creación).\n\n";

echo "El foco principal de la PF es definir qué es un programa (mediante la composición de funciones), 
en lugar de describir cómo debe hacerse la tarea (que es más característico de la programación imperativa).\n\n\n\n";



echo "53.2 CONCEPTOS CLAVES DE LA PROGRAMACIÓN FUNCIONAL\n\n";

echo "a) INMUTABILIDAD DE DATOS (IMMUTABILITY): 
Los datos no pueden modificarse una vez creados. Si necesitas un cambio, creas una nueva copia con la modificación.\n\n";

echo "b) FUNCIONES DE 1° CLASE (FIRST-CLASS FUNCTIONS): 
Las funciones pueden tratarse como cualquier otra variable. 
Pueden asignarse a variables, pasarse como argumentos a otras funciones y ser devueltas por otras funciones.\n\n";

echo "c) FUNCIONES DE ORDEN SUPERIOR (HIGHER-ORDER FUNCTIONS): 
Son funciones que toman otras funciones como argumentos o devuelven una función como resultado (ejemplos comunes son map, filter y reduce).
Los datos no pueden modificarse una vez creados. Si necesitas un cambio, creas una nueva copia con la modificación.\n\n";

echo "D) AUSENCIA DE EFECTOS SECUNDARIOS (NO SIDE EFFECTS): 
Los datos no pueden modificarse una vez creados. 
Si necesitas un cambio, creas una nueva copia con la modificación.\n\n\n\n";



echo "53.3 ¿QUÉ ES UNA \"FUNCIÓN PURA\"?\n\n";

echo "Una función pura es el concepto fundamental de la Programación Funcional.
Es una función que cumple con dos características esenciales:\n\n";

echo "a) DETERMINISMO (o Referencialmente Transparente): 
Siempre produce la misma salida (el mismo resultado) si se le dan los mismos argumentos de entrada.\n\n";

echo "b) AUSENCIA DE EFECTOS SECUNDARIOS (No Side Effects): 
No causa ningún cambio observable fuera de su ámbito (scope). Lo que pasa en la función, se queda en la función. 
Ni tampoco tiene el riesgo de potencial cambio observable fuera de su ámbito (scope). Por lo que sólo recibe datos primitivos y devuelve datos primitivos.
No recibe ni devuelve objetos mutables (objetos que pueden cambiar después de su creación).
Ni maneja operaciones de entrada/salida (I/O) como leer o escribir en archivos, bases de datos o la consola.
Esto significa que: 
        b1) no modifica variables globales, 
        b2) no realiza operaciones de I/O (lectura/escritura de archivos, base de datos, consola), 
        b3) ni muta sus argumentos de entrada.\n\n";
        
echo "Si no se cumplen estas características es una función impura.\n\n";


echo "53.3.1 VENTAJAS DE LAS \"FUNCIÓNES PURAS\":\n\n";

echo "a) Son fáciles de probar (ya que solo tienes que verificar la entrada y la salida).\n\n";

echo "b) Son fáciles de razonar sobre ellas.\n\n";

echo "c) Permiten la ejecución en paralelo sin problemas de concurrencia.\n\n";

echo "d) Permiten la memoización (almacenar el resultado de la función para entradas futuras idénticas).\n\n\n\n";



echo "53.3.2 EJEMPLO DE \"FUNCIÓN PURA\" Y \"FUNCIÓN IMPURA\":\n\n";

// Clase original (mutable, para demostrar la diferencia)
class SaldoCliente{
    public $idCliente;
    public $saldoCliente = 1000.00;

    public function __construct($id){
        $this->idCliente = $id;
    }
}

// ******************************************************
// 1. FUNCIÓN PURA: Solo recibe valores, solo devuelve un valor.
// ******************************************************
/**
 * Función Pura: Calcula un nuevo saldo.
 * - Su resultado solo depende de $saldoActual y $montoPrestamo.
 * - No modifica variables globales ni realiza I/O (no hay echo).
 */
function calcularPrestamoPuro(float $saldoActual, float $montoPrestamo): float {
    // Cálculo. NO toca el objeto cliente.
    return $saldoActual + $montoPrestamo;
}

// ******************************************************
// 2. FUNCIÓN IMPURA: (Opcional) Modifica el estado del objeto.
// ******************************************************
function pedirPrestamoImpuro(SaldoCliente $cliente, float $montoPrestamo): void {
    // El efecto secundario es la mutación del objeto.
    $cliente->saldoCliente += $montoPrestamo;
}

// ******************************************************
// EJECUCIÓN DEL CÓDIGO (Aquí manejamos el I/O y el flujo de datos)
// ******************************************************

$clienteUno = new SaldoCliente("Cliente12345");
$clienteDos = new SaldoCliente("Cliente00000");
$montoPrestamo = 111.00;


echo "--- Función IMPURA: 'pedirPrestamoImpuro()' (MODIFICA el objeto) ---\n";

// Ejecución IMPURA #1: El saldo del cliente UNO cambia
echo "El saldo de $clienteUno->idCliente ANTES de la operación es: $clienteUno->saldoCliente\n";
pedirPrestamoImpuro($clienteUno, $montoPrestamo); // Mutación
echo "El saldo de $clienteUno->idCliente DESPUÉS de la operación es: $clienteUno->saldoCliente\n"; // El saldo ahora es 1111.00
echo "El saldo de $clienteUno->idCliente ANTES de la operación es: $clienteUno->saldoCliente\n";
pedirPrestamoImpuro($clienteUno, $montoPrestamo); // Mutación
echo "El saldo de $clienteUno->idCliente DESPUÉS de la operación es: $clienteUno->saldoCliente\n"; // El saldo ahora es 1111.00


echo "\n\n--- Función PURA: 'calcularPrestamoPuro()' (NO MODIFICA el objeto) ---\n";

// Ejecución PURA #1: El saldo del cliente DOS NO cambia
$saldoInicial = $clienteDos->saldoCliente;
$saldoCalculado1 = calcularPrestamoPuro($saldoInicial, $montoPrestamo); // 1000.00 + 111.00 = 1111.00

echo "El saldo de $clienteDos->idCliente ANTES de la operación es: $clienteDos->saldoCliente\n";
echo "El saldo de $clienteDos->idCliente SI PIDIERA el préstamo sería: $saldoCalculado1\n";

// Ejecución PURA #2: Siempre retorna el mismo resultado si los datos de ENTRADA son iguales.
$saldoCalculado2 = calcularPrestamoPuro($saldoInicial, $montoPrestamo); // 1000.00 + 111.00 = 1111.00

echo "El saldo de $clienteDos->idCliente DESPUÉS de la llamada de la función calcularPrestamoPuro() sigue siendo: $clienteDos->saldoCliente\n"; // ¡Sigue siendo 1000.00!

// Ejecución PURA #2: Siempre retorna el mismo resultado si los datos de ENTRADA son iguales.
$saldoCalculado2 = calcularPrestamoPuro($saldoInicial, $montoPrestamo); // 1000.00 + 111.00 = 1111.00

echo "El saldo de $clienteDos->idCliente DESPUÉS de otra invocación de la función calcularPrestamoPuro() sigue siendo: $clienteDos->saldoCliente\n"; // ¡Sigue siendo 1000.00!

// Ejecución PURA #2: Siempre retorna el mismo resultado si los datos de ENTRADA son iguales.
$saldoCalculado2 = calcularPrestamoPuro($saldoInicial, $montoPrestamo); // 1000.00 + 111.00 = 1111.00

echo "El saldo de $clienteDos->idCliente DESPUÉS de las llamadas sigue siendo: $clienteDos->saldoCliente\n\n\n\n"; // ¡Sigue siendo 1000.00!

echo "NOTA: Una función pura no debe aceptar un objeto mutable como argumento. 
¡Incluso si la función no lo modifica internamente!
La dependencia de una estructura de datos con estado la hace potencialmente impura y viola el principio de transparencia referencial ideal.\n";


?>