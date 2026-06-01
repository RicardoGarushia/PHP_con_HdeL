<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "4. VARIABLES: EL CORAZÓN DEL MANEJO DE DATOS\n";
echo "======================================================================\n\n";

echo "Una VARIABLE es un identificador que apunta a un espacio de memoria RAM.
A diferencia de otros lenguajes, en PHP las variables tiene un 'TIPADO DINÁMICO', 
lo que significa que el tipo de dato que pueden almacenar puede cambiar sin restricciones.\n\n";

echo "NO es necesario declarar el tipo de datos de una variable antes de usarla. 
PHP determina automáticamente el tipo de datos según el valor asignado.\n\n";



echo "\n======================================================================\n";
echo "4.1. SINTAXIS PARA LA INICIALIZACIÓN DE VARIABLES\n";
echo "======================================================================\n\n";

echo "Para inicializar una variable en PHP se siguen las siguientes convenciones:\n"; 
echo "1. El prefijo '$' es obligatorio.\n";
echo "2. Debe comenzar con una letra o un guión bajo (_), pero NUNCA con un número.\n";
echo "3. PHP es sensible a mayúsculas y minúsculas (case-sensitive) en los nombres de las variables, lo que significa que: 
        \$variable, 
        \$Variable, 
        \$vAriable,
        \$vaRiable, y demás combinaciones,  
        son variables diferentes.\n";
echo "4. No se permiten espacios ni caracteres especiales en los nombres de las variables, excepto el guión bajo (_).\n";
echo "5. Agrega un valor, dado que toda variable en PHP debe ser inicializada con un valor antes de ser utilizada.
En PHP, NO existe la 'declaración sin valor' como en C++ o Java.\n\n";

echo "Por ejemplo, si escribes:\n\n"; 

echo <<<'EOD'
<?php
// Ejemplos Correctos:
$estado = null;     // Inicialización explícita 'null'\n";
$puntaje = 0;       // Inicialización numérica\n\n";
$nombre = "";       // Inicialización de string\n\n";

// Ejemplos Incorrectos:
$apellido;          // Error: Undefined variable\n";
$edad;              // Error: Undefined variable\n";
?>
EOD;


echo "\n\n\n======================================================================\n";
echo "4.1.1. CONVENCIONALISMOS PARA EL NOMBRADO DE VARIABLES\n";
echo "======================================================================\n\n";

echo "Aunque PHP no impone reglas estrictas sobre el estilo de nombrado de las variables,
es recomendable seguir ciertas convenciones para mejorar la legibilidad y mantenibilidad del código:\n"; 
echo "1. Estilos recomendados:\n";
echo "   - camelCase: Usado mayormente para variables y métodos.\n";
echo "   - snake_case: Muy común en nombres de columnas de bases de datos.\n\n";
echo "2. Usa nombres descriptivos para las variables, que indiquen claramente su propósito o el tipo de datos que almacenan.\n\n";
echo "3. Evita usar nombres de variables que puedan confundirse con palabras reservadas de PHP o funciones predefinidas.\n\n";



echo "\n======================================================================\n";
echo "4.2. TIPADO DINÁMICO EN PHP\n";
echo "======================================================================\n\n";

echo "Como se mostró en '4.1. SINTAXIS PARA LA INICIALIZACIÓN DE VARIABLES', 
PHP es un lenguaje de programación con 'TIPADO DINÁMICO', 
dado que no requiere declarar el tipo de datos de una variable antes de usarla.\n\n";

echo "Esto significa que el tipo de dato de una variable se determina automáticamente en tiempo de ejecución, 
lo que significa que las variables pueden contener diferentes tipos de datos a lo largo de su vida útil.\n\n";



echo "\n======================================================================\n";
echo "4.2.1. EJEMPLO DE TIPADO DINÁMICO\n";
echo "======================================================================\n\n";

echo "\nEn el siguiente ejemplo, 
se inicializan variables con diferentes tipos de datos y luego se les asignan nuevos valores de tipos de datos distintos,
sin ningún problema para su ejecución en PHP:\n\n";

echo <<<'EOD'
<?php
// Se declaran las siguientes variables
$numero = 10;
$nombre = "Juanito";
$decimal = -30.123549;
$booleano = true;

// Impresión de variables con texto adicional
echo "Primera impresión de variables:
La variable \$numero tiene el valor de $numero
La variable \$nombre tiene el valor de $nombre
La variable \$decimal tiene el valor de $decimal
La variable \$booleano tiene el valor de $booleano\n\n";

// Asignación de nuevos valores con diferente tipo de dato: PHP tiene tipado dinámico
$numero = "Ana";
$nombre = false;
$decimal = -124;
$booleano = 5+6;

// Impresión de variables con texto adicional
echo "Segunda impresión de variables:
La variable \$numero AHORA tiene el valor de $numero
La variable \$nombre AHORA tiene el valor de $nombre
La variable \$decimal AHORA tiene el valor de $decimal
La variable \$booleano AHORA tiene el valor de $booleano\n\n";
?>
EOD;

echo "En resumen, el TIPADO DINÁMICO de PHP permite que una misma variable pueda almacenar diferentes tipos de datos a lo largo de la ejecución del programa,
lo que puede ser útil en ciertos casos, pero también requiere precaución para evitar errores relacionados con el tipo de datos
y asegurar que las variables se utilicen de manera coherente a lo largo del programa.\n\n";



echo "\n======================================================================\n";
echo "4.2.2. TIPADO DINÁMICO Y EL 'TYPE JUGGLING'\n";
echo "======================================================================\n\n";

echo "PHP realiza algo llamado 'Casting Automático'. Si sumas un string y un entero, por ejemplo:\n\n";
echo <<<'EOD'
<?php
$resultado = '5' + 10; // Resultado: 15 (Entero)\n";
echo "El resultado es $resultado porque PHP convierte automáticamente el string '5' a un número entero (int) antes de realizar la suma.";
?>
EOD;

echo "\n\nEsto es peligroso en el backend (por ejemplo, procesando pagos).\n\n";



echo "\n======================================================================\n";
echo "4.3. TIPADO ESTRICTO: declare(strict_types=1);\n";
echo "======================================================================\n\n";

echo "Aunque para algunos el 'TIPADO DINAMICO' de PHP lo consideran útil, 
para este autor implica errores inesperados e innecesarios si no se tiene cuidado, 
por ejemplo, esperar un número y recibir un texto.\n\n"; 

echo "Por eso, las versiones modernas de PHP (a partir de 7.0 y especialmente 8.0+) 
han introducido declaraciones de tipo (int \$variableNumero, string \$variableTexto), 
que actúan como una \"caja\" opcional para protegerte de esa flexibilidad excesiva. 
Mi recomendación es usar el TIPADO ESTRICTO\n\n";

echo <<<'EOD'
<?php
declare(strict_types=1);    // Esta instrucción debe ser SIEMPRE la primera línea del archivo, justo después de <?php, o no funcionará.
?>
EOD;

echo "\n\nAl habilitar el TIPADO ESTRICTO, PHP lanzará un error de tipo (TypeError) si intentas asignar un valor de un tipo diferente al declarado,
lo que puede ayudar a detectar errores de tipo más temprano en el desarrollo y mejorar la calidad del código al hacer que los tipos de datos sean explícitos y consistentes en todo el programa.\n\n"; 



echo "\n======================================================================\n";
echo "4.4. CLASIFICACIÓN DE VARIABLES\n";
echo "======================================================================\n\n";


echo "======================================================================\n";
echo "4.4.1 DE ACUERDO AL TIPO DE DATO QUE PUEDEN ALMACENAR\n";
echo "======================================================================\n\n";

$tipos = [
    "a) Escalares" => "bool, int, float, string.",
    "b) Compuestos" => "array (listas), object (clases e instancias).",
    "c) Especiales" => "resource (conexiones a BD o archivos externos), null.",
    "d) Callbacks"  => "callable (funciones que pueden ser llamadas como variables)."
];

foreach ($tipos as $tipo => $desc) {
    echo "[$tipo]: $desc\n";
}

echo "\n======================================================================\n";
echo "4.4.2 DE ACUERDO AL ÁMBITO (SCOPE) Y MEMORIA\n";
echo "======================================================================\n\n";

echo "1. Locales: Viven y mueren dentro de una función. {Véase 13.Funciones.php para más detalles}\n";
echo "2. Globales: Existen fuera de las funciones. 
Para usarlas dentro de una, se requiere la palabra reservada 'global \$var;'.\n";
echo "3. Superglobales: Arrays automáticos (\$_GET, \$_POST, \$_SESSION) 
   que PHP llena por nosotros con datos del cliente. {Véase 78.VariablesSUPERGlobales.php}\n\n";


echo "\n======================================================================\n";
echo "13.7. FUNCIONES GUARDIANES DE VARIABLES: VALIDACIÓN Y DEFENSA\n";
echo "======================================================================\n\n";

echo "{Véase 13.Funciones.php antes de leer el siguiente apartado}\n\n";

echo "En el desarrollo backend, nunca debemos asumir que una variable existe o que contiene el valor que esperamos. 
Si intentamos acceder a una variable que no ha sido definida, 
PHP lanzará un 'Notice: Undefined variable', lo cual es una mala práctica.\n\n";

echo "Para defendernos de esto, PHP nos ofrece funciones 'Guardianas':\n\n";

echo "1. isset(\$variable): Verifica si la variable existe y NO es NULL.\n";
echo "   Es la forma más segura de comprobar si una variable ha sido inicializada.\n\n";

echo "2. empty(\$variable): Verifica si la variable está 'vacía'.\n";
echo "   Una variable se considera vacía si es: NULL, un string vacío (''), 0, false, o un array vacío.\n\n";

echo "Ejemplo de uso en un entorno defensivo:\n\n";

echo <<<'EOD'
<?php
$usuario = ""; 

// ¿La variable existe?
if (isset($usuario)) {
    echo "La variable está definida (existe).\n";
}

// ¿La variable tiene un valor útil?
if (empty($usuario)) {
    echo "La variable existe, pero está vacía (cuidado con esto).\n";
}
?>
EOD;

echo "\n\nIMPORTANTE: La diferencia clave es que la función 'isset()' devuelve el booleano 'true' incluso si la variable 
contiene un string vacío o un 0, porque representan 'existencia'. 
Por su lado, la función 'empty()' avisa si el valor no tiene utilidad práctica para nuestra lógica.\n\n";

echo "RECOMENDACIÓN: Utiliza 'isset()' antes de realizar cualquier operación con variables 
provenientes de formularios o fuentes externas (como \$_GET o \$_POST) para evitar errores. {Véase Sección 10.Solicitudes HTTP para ver su utilidad}\n\n";