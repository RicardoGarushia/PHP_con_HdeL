<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "4. VARIABLES: EL CORAZÓN DEL MANEJO DE DATOS\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "4.1. Sintaxis e Inicialización de Variables en PHP\n";
echo "======================================================================\n\n";

// Ejemplos correctos:
$estado = null;                 // Inicialización explícita 'null'
$puntaje = 100;                 // Inicialización numérica
$nombre = "Ricardo García";     // Inicialización de string

// Ejemplos incorrectos (lanzan advertencias/errores):
// $123variable = 5;   // Error sintáctico: empieza con número.    [Tienes que hacer la declaración un comentario con // para poder ejecutarlo]
// $-nombre = "Juan";  // Error sintáctico: usa guion medio        [Tienes que hacer la declaración un comentario con // para poder ejecutarlo]
// $variable;          // Error sintáctico: no se ha inicializado  [Tienes que hacer la declaración un comentario con // para poder ejecutarlo]

echo "La variable \$estado tiene el valor de '$estado'\n";
echo "La variable \$puntaje tiene el valor de '$puntaje'\n";
echo "La variable \$nombre tiene el valor de '$nombre'\n\n";


echo "\n======================================================================\n";
echo "4.1.1. Convenciones de Nombrado de Variables Recomendadas\n";
echo "======================================================================\n\n";

$nombreEstudiante = "";                     // Para utilizar localmente el nombre de un estudiante.
$edadEstudiante = 0;                        // Para utilizar localmente la edad de un estudiante.
$nombrePadreEstudiante = "Nombre padre";    // Para utilizar localmente el nombre del padre de un estudiante.
$nombre_estudiante = "Ricardo Leonardo";    // Para extraer/enviar/modificar el nombre de un estudiante en una base de datos.
$edad_estudiante = 35;                      // Para extraer/enviar/modificar la edad de un estudiante en una base de datos.
$nombre_padre_estudiante = "José";          // Para extraer/enviar/modificar el nombre del padre de un estudiante en una base de datos.
$variable = "01259034597";                  // MAL EJEMPLO. Denominar una variable como "variable" no dice nada sobre el contenido de esta.

echo "La variable \$nombreEstudiante tiene el valor de '$nombreEstudiante'\n";
echo "La variable \$edadEstudiante tiene el valor de '$edadEstudiante'\n";
echo "La variable \$nombrePadreEstudiante tiene el valor de '$nombrePadreEstudiante'\n";
echo "La variable \$nombre_estudiante tiene el valor de '$nombre_estudiante'\n";
echo "La variable \$edad_estudiante tiene el valor de '$edad_estudiante'\n";
echo "La variable \$nombre_padre_estudiante tiene el valor de '$nombre_padre_estudiante'\n";
echo "La variable \$variable tiene el valor de '$variable'\n\n";

echo "\n======================================================================\n";
echo "4.2.1. TIPADO DINÁMICO (Dynamic Typing)\n";
echo "======================================================================\n\n";

$variablE = "¡Hola!"; // Comienza con el tipo de dato: string (cadena de carácteres)
echo "La variable contiene: '$variablE'; que es un tipo de dato: '" . gettype($variablE) . "'\n";
$variablE = 45;     // Cambia al tipo de dato: int (número entero)
echo "Ahora la variable contiene: '$variablE'; que es un tipo de dato: '" . gettype($variablE) . "'\n";
$variablE = true;   // Cambia al tipo de dato: boolean
echo "Enseguida la variable contiene: '$variablE'; que es un tipo de dato: '" . gettype($variablE) . "'\n";
$variablE = 3.1416; // Cambia al tipo de dato: float
echo "Después la variable contiene: '$variablE'; que es un tipo de dato: '" . gettype($variablE) . "'\n";
$variablE = null;   // Cambia al tipo de dato: null
echo "Finalmente contiene: '$variablE'; que es un tipo de dato: '" . gettype($variablE) . "'\n\n";

echo "\n======================================================================\n";
echo "4.2.2. MALABARISMO DE TIPO (Type Juggling)\n";
echo "======================================================================\n\n";

$numeroA = "10";        // Variable con el tipo de dato: string (cadena de carácteres)
$numeroB = 3.1416;      // Variable con el tipo de dato: float (número con punto flotante/decimal)
$resultado = $numeroA + $numeroB;   // Suma aritmética de una cadena más un número con número flotante.
echo "El resultado de sumar una cadena más un número con punto flotante es: $resultado; que es un tipo de dato: '" . gettype($resultado) . "'\n\n";


echo "\n======================================================================\n";
echo "4.2.3. TIPADO ESTRICTO: declare(strict_types=1);\n";
echo "======================================================================\n\n";

echo "Activa la directiva de tipado estricto. TIENE QUE SER LA PRIMERA LÍNEA DE CÓDIGO EJECUTABLE DEL ARCHIVO\n\n";
// declare(strict_types=1); // Elimina las diagonales y copia y pega donde corresponde la siguiente línea: 

echo "\n======================================================================\n";
echo "4.3. Clasificación de Variables e Introducción a los Tipos de Dato (data type)\n";
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

echo "\n\nCon respecto al ámbito de las variables:\n\n";

// Ejemplo de variable global
$asignacionPorDiscapacidadIntelectual = 3;

// DEFINICIÓN de una función (véase 13.Funciones.md para mayor información)
function ejemploDeAmbitoGlobal()
{
    // Ejemplo de variable local
    $puntoExtra = 1;
    global $asignacionPorDiscapacidadIntelectual;     // Elimina la palabra reservada global y observa que sucede
    $calificacion = $puntoExtra + $asignacionPorDiscapacidadIntelectual + 5;
    echo "Tu calificación final (si no elimistaste la palabra reservada 'global' -además, que no podrías ejecutarlo-) es: $calificacion puntos\n\n";
}

// INVOCACIÓN de una función (véase 13.Funciones.md para mayor información)
ejemploDeAmbitoGlobal();


echo "\n======================================================================\n";
echo "4.4. Funciones Guardianas: Validación de Variables\n";
echo "======================================================================\n\n";

$usuario = "";  // Ingresa un valor, deja el valor vacío "" y coloca el valor null para observar el comportamiento. También puedes cambiar el nombre de la variable.

// Estructura de control if-else (véase 6.if.md para mayor información)
if (isset($usuario)) {  // La función isset() responde la pregunta: ¿La variable existe (está establecida)?
    echo "La variable \$usuario existe y no es NULL\n";
} else {
    echo "La variable NO existe\n";
}

// Estructura de control if-else (véase 6.if.md para mayor información)
if (empty($usuario)) {// La función empty() responde la pregunta: ¿La variable tiene un valor útil (está vacía)?
    echo "La variable se considera vacía\n\n";
} else {
    echo "La variable contiene el valor: $usuario \n\n";
}