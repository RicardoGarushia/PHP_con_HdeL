<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "5. TIPOS DE DATO BÁSICOS Y TYPE CASTING (CASTEO) EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "5.1. Clasificación de Tipos de Datos en PHP\n";
echo "======================================================================\n\n";

echo "De acuerdo con la documentación oficial de PHP, los _tipos de datos_ se dividen en:\n\n";

// Un array asociativo (véase 16.ArrayAsociativo.md para mayor información)
$tiposDeDatos = [
    "a) Escalares" => "bool, int, float, string.",
    "b) Compuestos" => "array (listas), object (instancias de clase).",
    "c) Especiales" => "resource (conexiones a BD o archivos externos), null (ausencia explícita de valor).",
    "d) Callbacks" => "callable (funciones que pueden llamarse/invocarse como variables)."
];

// Una estructura de control foreach (véase 17.foreach.md para mayor información)
foreach ($tiposDeDatos as $tipo => $descripcion) {
    echo "[$tipo]: $descripcion \n";
}


echo "\n\n======================================================================\n";
echo "5.2. Funciones de Inspección: `gettype()` y `var_dump()`\n";
echo "======================================================================\n\n";

$nombre = "Ricardo García López";

echo "El valor que muestra la función gettype(\$nombre) es: " . gettype($nombre) . "\n\n";  // Muestra: string
echo "El valor que muestra la función var_dump(\$nombre) es: \n\n";
var_dump($nombre);     // Muestra: string(20) "Ricardo García López"


echo "\n\n\n======================================================================\n";
echo "5.3. Declaración de Tipos en Funciones y Clases (PHP 7.4+)\n";
echo "======================================================================\n\n";

// Tipado en propiedades de clase (véase 20.ClasesYObjetos.php para mayor información)
class Persona {
    public string $nombre = "Ricardo García López";
    public int $edad = 30;
}

$personaA = new Persona();

echo "El nombre del objeto personaA es: " . $personaA->nombre . "\n";
echo "La edad del objeto personaA es: " . $personaA->edad . "\n\n";

// Tipado en parámetros y retorno de funciones (véase 13.Funciones.md para mayor información)
function sumar(int $numeroA, int $numeroB): int {   // DEFINICIÓN de una función (véase 13.Funciones.md para mayor información)
    return $numeroA + $numeroB;
}

echo "El resultado de la función sumar() es: " . $resultado = sumar(5, 6) . "\n\n"; // INVOCACIÓN de la función (véase 13.Funciones.md para mayor información)


echo "\n======================================================================\n";
echo "5.3.1 Modificadores de Declaración de Tipo (Nullable y Union Types)\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "1. Tipos Nullable (?DataType) (PHP 7.1+):\n";
echo "======================================================================\n\n";


// El parámetro $monto admite float o null; el retorno admite string o null
function formatearPrecio(?float $monto): ?string {
    if ($monto === null) {
        return null;
    }
    return "El precio formateado es: $" . number_format($monto, 2) . "\n\n";
}

echo formatearPrecio(100.50); // Muestra: $100.50
echo formatearPrecio(null);   // Muestra nada (devuelve null)


echo "\n======================================================================\n";
echo "2. Tipos de Unión (Union Types) (TipoA|TipoB) (PHP 8.0+):\n";
echo "======================================================================\n\n";



// El parámetro $id admite int o string; el retorno es ninguno o vacío
function procesarId(int|string $id): void {
    echo "Procesando ID: $id que es del tipo de dato: " . gettype($id) . "\n\n";
}

procesarID("ABCD");




echo "\n======================================================================\n";
echo "5.4.1. Casting/Malabareo de Tipo Automático (Implicit Type Juggling)\n";
echo "======================================================================\n\n";

$numeroA = "10";        // Variable con el tipo de dato: string (cadena de carácteres)
$numeroB = 3.1416;      // Variable con el tipo de dato: float (número con punto flotante/decimal)
$resultado = $numeroA + $numeroB;   // Suma aritmética de una cadena más un número con número flotante.
echo "El resultado de sumar una cadena más un número con punto flotante es: $resultado" . "; que es del tipo de dato: " . gettype($resultado) . "\n\n";


echo "\n======================================================================\n";
echo "5.4.2. Casting Manual (Explicit Casting)\n";
echo "======================================================================\n\n";

$numeroA = "10";            // Variable con el tipo de dato: string (cadena de carácteres)
echo "Primero, la variable \$numeroA posee el tipo de dato: '" . gettype($numeroA) . "'\n";
$numeroA = (int)$numeroA ;   // Variable asignada con casteo manual
echo "Después, tras un Casting Manual (Explicit Casting) y reasignación, la variable \$numeroA posee el tipo de dato: '" . gettype($numeroA) . "'\n";
$numeroB = 3.1416;          // Variable con el tipo de dato: float (número con punto flotante/decimal)
$resultado = $numeroA + $numeroB;   // Suma aritmética de una cadena más un número con número flotante.
$resultado = strval($resultado);    // Conversión manual de la variable $resultado al tipo de dato string (cadena)
echo "El resultado de la suma de 10 más 3.1416 es: $resultado; que es del tipo de dato: " . gettype($resultado) . "\n\n";
