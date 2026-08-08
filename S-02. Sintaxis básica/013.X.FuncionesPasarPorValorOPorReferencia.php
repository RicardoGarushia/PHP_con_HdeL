<?php
header("Content-Type: text/plain");

echo "\n13. FUNCIONES: PASAR POR VALOR O PASAR POR REFERENCIA\n\n";

echo "13.1 INTRODUCCIÓN\n\n";

echo "Antes de comenzar con el tema de pasar por valor o por referencia, 
es importante entender cómo funciona el motor de PHP 
en relación con las funciones y los parámetros que se les pasan.\n\n"; 

echo "Cuando se invoca una función en PHP,
el motor de PHP crea un nuevo ámbito (scope) de ejecución para esa función.
Dentro de ese ámbito, se crean VARIABLES LOCALES para los parámetros que se le pasan a la función.
Estas VARIABLES LOCALES son independientes de las VARIABLES GLOBALES fuera de la función, 
lo que significa que cualquier cambio que se haga a estas VARIABLES LOCALES dentro de la función
NO afectará a las VARIABLES GLOBALES fuera de la función, 
a menos que se retorne (return) el nuevo valor para reasignarlo a una variable (véase 13.Funciones.php)
o se use el PASO POR REFERENCIA (DE MEMORIA).\n\n\n\n"; 



echo "13.2 PASAR POR VALOR Y PASAR POR REFERENCIA\n\n";

echo "En el anterior contexto, 
    a) PASAR POR VALOR significa que se pasa una COPIA DEL VALOR de la variable al parámetro de la función.
        Esto significa que cualquier cambio que se haga al parámetro dentro de la función 
        NO AFECTARÁ AL VALOR ORIGINAL FUERA DE LA FUNCIÓN, 
        ya que el parámetro es una copia independiente del valor original.
    b) PASAR POR REFERENCIA significa que se pasa la REFERENCIA (DE MEMORIA) de la variable al parámetro de la función.
        Esto significa que cualquier cambio que se haga al parámetro dentro de la función 
        SI AFECTARÁ AL VALOR ORIGINAL FUERA DE LA FUNCIÓN, 
        ya que el parámetro es una referencia al mismísimo lugar en memoria donde se encuentra la variable original.
        Para pasar por referencia, se utiliza el operador de referencia (&) que pasa la dirección de memoria de la variable. 
        El operador de referencia (&) se coloca justo antes del nombre del parámetro en la declaración de la función.\n\n";

echo "En resumen, la diferencia entre PASAR POR VALOR y PASAR POR REFERENCIA radica en: 
cómo se manejan los parámetros dentro de las funciones y cómo afectan a las variables originales fuera de la función.
PASAR POR VALOR crea una copia independiente del valor,
lo que significa que los cambios realizados al parámetro dentro de la función NO afectarán a la variable original fuera de la función,
mientras que PASAR POR REFERENCIA permite que el parámetro y la variable original compartan el mismo valor en memoria, 
lo que significa que los cambios realizados al parámetro dentro de la función también afectarán a la variable original fuera de la función.\n\n\n";


echo "13.2.1 EJEMPLO DE PASAR POR VALOR Y PASAR POR REFERENCIA\n\n";

echo "En el siguiente ejemplo, se muestra cómo funciona el PASAR POR VALOR y el PASAR POR REFERENCIA en PHP."; 

echo "<?php
\$valor = 10;    // Inicialización de la variable \$valor con el valor 10

function sumar10PorValor(\$a) {  // Función que recibe un parámetro \$a POR VALOR y le suma 10
    \$a = \$a + 10;   // Suma 10 al valor de \$a y lo asigna a \$a.  
}

echo \"El valor original es: \$valor\\n\"; // Imprime el valor original
sumar10PorValor(\$valor); // Llamada por valor (copia)

echo \"Después de llamar a la función sumar10PorValor() sin pasar por referencia, el valor sigue siendo: \$valor\\n\"; 

function sumar10PorReferencia(&\$a) {  // Función que recibe un parámetro \$a POR REFERENCIA (&)
    \$a += 10;     // Suma 10 directamente a la memoria de la variable original
}

echo \"El valor original es: \$valor\\n\"; 
sumar10PorReferencia(\$valor); // Llamada por referencia (acceso directo)

echo \"Después de llamar a la función sumar10PorReferencia() pasando por referencia, el valor ahora es: \$valor\\n\\n\";
?>\n\n";

echo "13.2.1.1 EJECUCIÓN\n\n";

$valor = 10;    // Inicialización de la variable $valor con el valor 10
function sumar10PorValor($a) {  // Función que recibe un parámetro $a POR VALOR y le suma 10
    $a=$a+10;   // Suma 10 al valor de $a y lo asigna a $a.  
}
echo "El valor original es: $valor\n"; // Imprime el valor original de la variable $valor
sumar10PorValor($valor); // Llamada a la función sumar10PorValor() pasando la variable $valor por valor (sin referencia)
echo "Después de llamar a la función sumar10PorValor() sin pasar por referencia, el valor sigue siendo: $valor\n"; // Imprime el valor de la variable $valor después de llamar a la función, mostrando que no ha cambiado debido a que se pasó por valor (sin referencia)

function sumar10PorReferencia(&$a) {  // Función que recibe un parámetro $a POR REFERENCIA (con el operador &) y le suma 10
    $a+=10;     // Lo mismo que $a=$a+10, pero con la sintaxis de asignación de suma (+=) para sumar 10 al valor de $a y asignarlo a $a.
}

echo "El valor original es: $valor\n"; // Imprime el valor original de la variable $valor
sumar10PorReferencia($valor); // Llamada a la función sumar10PorReferencia() pasando la variable $valor por referencia (con el operador &)
echo "Después de llamar a la función sumar10PorReferencia() pasando por referencia, el valor ahora es: $valor\n\n"; // Imprime el valor de la variable $valor después de llamar a la función, mostrando que ha cambiado debido a que se pasó por referencia (con el operador &)

echo "En este ejemplo, se puede observar claramente la diferencia entre PASAR POR VALOR y PASAR POR REFERENCIA:
- En la función sumar10PorValor(), el parámetro \$a es una copia del valor original de \$valor, 
por lo que cualquier cambio a \$a dentro de la función no afecta a \$valor fuera de la función.
- En la función sumar10PorReferencia(), el parámetro \$a es una referencia al valor original de \$valor, 
por lo que cualquier cambio a \$a dentro de la función sí afecta a \$valor fuera de la función, ya que ambos comparten el mismo valor en memoria.\n\n";