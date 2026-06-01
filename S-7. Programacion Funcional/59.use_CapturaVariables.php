<?php
header("Content-Type: text/plain");

echo "59. USE: CAPTURA DE VARIABLES EXTERNAS\n\n";

echo "59.1 ¿QUÉ ES LA PALABRA RESERVADA \"USE\"?\n\n";

echo "La palabra reservada USE en el contexto de las funciones anónimas (closures) en PHP
es una sintaxis que permite ÚNICAMENTE A funciones anónimas CAPTURAR VARIABLES del ÁMBITO PADRE (el scope donde fue definida) para usarlas internamente.\n\n";

echo "En esencia, la cláusula USE crea un Cierre (Closure), 
que es una función que \"recuerda\" el valor o la referencia a las variables de su entorno, 
incluso después de que la ejecución del entorno padre haya terminado.\n\n";

echo "Entonces, USE captura la variable por valor de manera predeterminada (hace una copia del valor en el momento de la definición), 
lo cual es lo ideal para la inmutabilidad en PF.\n\n\n\n";



echo "59.2 ¿QUÉ RELACIÓN TIENE CON LA PROGRAMACIÓN FUNCIONAL?\n\n";

echo "La cláusula es el mecanismo de PHP para crear Closures (Cierres), que son un pilar de la Programación Funcional (PF).
Un \"closure\" permite que una función recuerde y acceda a las variables de su contexto de definición, lo cual es la definición misma de un closure.\n\n";

echo "Además, las Funciones de Orden Superior que devuelven funciones dependen de USE para inyectar datos de configuración o contexto dentro de la función devuelta.\n\n";

echo "Finalmente, fomenta la Inmutabilidad al capturar por valor (comportamiento por defecto) 
ya que el valor capturado no puede ser modificado desde dentro del closure para afectar al ámbito padre.\n\n\n\n";



echo "59.3 ¿POR QUÉ UTILIZAR \"USE\" Y NO MEJOR PASAR ÚNICAMENTE LA VARIABLE COMO ARGUMENTO?\n\n";

echo "La diferencia fundamental es que USE se usa para Configuración o Contexto Fijo, mientras que los argumentos se usan para Datos Variables de Ejecución.\n\n";

echo "Usar USE permite crear una Función Especializada (o función parcialmente aplicada), separando la Configuración de la función de la Ejecución de la misma:
    1. Configuración del Contexto (con USE): 
        La variable capturada con USE se vuelve un dato fijo para esa función. 
        El USE es la etapa donde se le da a la función su \"instrucción de fondo\". 
        El resultado es una función que requiere menos argumentos en cada llamada o ya tiene el argumento configurado.
    2. Datos de Ejecución (con Argumentos):
        El (los) argumento(s) es (son) la(s) entrada(s) que varía(n) cada vez que la función es invocada.\n\n";

echo "Esta separación permite que las funciones especializadas (closures) se ajusten perfectamente a las firmas que esperan las Funciones de Orden Superior genéricas, como array_map() (que generalmente solo espera una función con un argumento).\n\n\n\n";


echo "59.4 EJEMPLO DE \"ARROW FUNCTION\" (FUNCIÓN FLECHA)\n\n";

echo <<<EJEMPLO_USE_CLOSURE
\$IVA = 0.16;
\$obtenerIVA = 0.21; // Esta variable no se usa en el ejemplo, pero se mantiene.

// Función de Orden Superior que devuelve una función para calcular el precio final con IVA y descuento
function precioFinalProducto(float \$precioAntesImpuestos) : callable {   
    // Usamos global para que la función vea el \$IVA del ámbito principal.
    global \$IVA;
    
    // El closure devuelto usa 'use' para capturar \$IVA y \$precioAntesImpuestos por VALOR (configuración fija).
    return function(float \$descuento) use (\$precioAntesImpuestos, \$IVA): float {
        // Fórmula: Precio * (1 + IVA) - Descuento
        return (\$precioAntesImpuestos * (1 + \$IVA)) - \$descuento;
    };
};

// 1. CREACIÓN DE FUNCIÓN ESPECIALIZADA: Fija el precio (100.00) y el IVA (0.16)
// El closure captura IVA = 0.16 en este momento.
\$precioProducto = precioFinalProducto(100.00); 

// 2. APLICAR DESCUENTO: Ahora \$precioProducto solo necesita el descuento
\$precioFinalSinCupon = \$precioProducto(0.00); 
\$precioFinalCupon = \$precioProducto(5.00); // Aplicamos un descuento de 5.00

echo "IVA configurado: " . (\$IVA * 100) . "%\\n";
echo "Precio Producto A (sin descuento): $" . number_format(\$precioFinalSinCupon, 2) . "\\n";
echo "Precio Producto A (con cupón de \\\$5): $" . number_format(\$precioFinalCupon, 2) . "\\n";

// 3. Si se cambia el IVA, no afecta a la función creada:
\$IVA = 0.20; // Lo cambiamos en el ámbito global (la copia del closure NO se actualiza).
\$precioFinalSinCuponNuevo = \$precioProducto(0.00);
echo "Nuevo IVA global (20%), pero la función A sigue usando el IVA de 16%: $" . number_format(\$precioFinalSinCuponNuevo, 2) . "\\n\\n\\n\\n";
// Salida: (100 * 1.16) = 116.00
EJEMPLO_USE_CLOSURE;


$IVA = 0.16;
$obtenerIVA = 0.21;

// Función de Orden Superior que devuelve una función para calcular el precio final con IVA y descuento
function precioFinalProducto(float $precioAntesImpuestos) : callable {   // USE captura la variable $IVA del ámbito padre
    global $IVA;
    return function(float $descuento) use ($precioAntesImpuestos, $IVA): float {
        return ($precioAntesImpuestos * (1 + $IVA)) - $descuento;
    };
};

// 1. CREACIÓN DE FUNCIÓN ESPECIALIZADA: Fija el precio (100.00) y el IVA (0.16)
$precioProducto = precioFinalProducto(100.00); 

// 2. APLICAR DESCUENTO: Ahora $precioProducto solo necesita el descuento
$precioFinalSinCupon = $precioProducto(0.00); 
$precioFinalCupon = $precioProducto(5.00); // Aplicamos un descuento de 5.00

echo "IVA configurado: " . ($IVA * 100) . "%\n";
echo "Precio Producto A (sin descuento): $" . number_format($precioFinalSinCupon, 2) . "\n";
echo "Precio Producto A (con cupón de \$5): $" . number_format($precioFinalCupon, 2) . "\n";

// 3. Si se cambia el IVA, no afecta a la función creada:
$IVA = 0.20; // Lo cambiamos en el ámbito global
$precioFinalSinCuponNuevo = $precioProducto(0.00);
echo "Nuevo IVA global (20%), pero la función A sigue usando: $" . number_format($precioFinalSinCuponNuevo, 2) . "\n\n\n\n";

/* SALIDA ESPERADA:
IVA configurado: 16%
Precio Producto A (sin descuento): $116.00
Precio Producto A (con cupón de $5): $111.00
Nuevo IVA global (20%), pero la función A sigue usando el IVA de 16%: $116.00
*/

echo "59.5 CONCLUSIÓN\n\n";

echo "En Programación Funcional, se prefiere la captura por valor (es decir, \"use (\$IVA)\") para mantener la pureza y la inmutabilidad, 
ya que garantiza que el contexto de la función ANÓNIMA no cambie inesperadamente después de su creación.\n\n";

echo "Las funciones con nombre existen en el ámbito global o de clase y no tienen un ámbito padre inmediato del cual \"capturar\" variables locales. 
Su acceso a variables externas debe hacerse a través de variables globales (global \$variable;) o superglobales.\n\n";