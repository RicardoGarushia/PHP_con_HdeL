<?php
header("Content-Type: text/plain");

echo "\n6. ESTRUCTURA IF, ESTRUCTURA IF-ELSE Y ESTRUCTURA IF-ELSEIF-ELSE\n\n";
echo "La estructura IF (Si...entonces...) es una de las estructuras de control más utilizadas en programación.
Permite ejecutar un bloque de código solo si se cumple una condición específica.
Si la condición es verdadera, se ejecuta el bloque de código dentro del IF.\n\n";

echo "La estructura IF-ELSE es una extensión de la estructura IF.
Permite ejecutar un bloque de código si la condición es verdadera (IF) y otro bloque de código si la condición es falsa (ELSE).\n\n";

echo "Finalmente, la estructura IF-ELSEIF-ELSE permite evaluar múltiples condiciones.
Si la primera condición es falsa, se evalúa la siguiente condición (ELSEIF) y así sucesivamente.\n\n";

echo "La sintaxis básica de la estructura IF es la siguiente:\n\n";
echo "<?php
// Sintaxis básica de la estructura IF
if (condición) {
    // Código a ejecutar si la condición es verdadera
}
?>\n\n";

echo "La sintaxis básica de la estructura IF-ELSE es la siguiente:\n\n";
echo "<?php
if (condición) {
    // Código a ejecutar si la condición es verdadera
}
else {
    // Código a ejecutar si la condición es falsa
}
?>\n\n";

echo "La sintaxis básica de la estructura IF-ELSEIF-...-ELSEIF-ELSE es la siguiente:\n\n";
echo "<?php
if (condiciónA) {
    // Código a ejecutar si la condición A es verdadera
}
elseif (condiciónB) {
    // Código a ejecutar si la condición B es verdadera
}
elseif (condición...) {
    // Código a ejecutar si la condición ... es verdadera
}
elseif (condiciónN) {
    // Código a ejecutar si la condición N es verdadera
}
else {
    // Código a ejecutar si todas las condiciones son falsas
}
?>\n\n";

echo "Ejemplo de IF-ELSEIF-ELSEIF-ELSE con OPERADOR AND (&&) y OR (||)\n\n";
echo "\n\nVamos a crear un ejemplo de IF-ELSEIF-...-ELSEIF-ELSE con la variable \$edad y OPERADOR AND (&&).\n\n";

echo "<?php
// Ejemplo de IF-ELSEIF-...-ELSEIF-ELSE con la variable \$edad y OPERADOR AND (&&)
\$edad = 18;    // Cambia este valor para probar diferentes condiciones

if(\$edad >= 0 && \$edad <= 14) {
    echo \"Eres un escuincle.\";
} elseif(\$edad >= 15 && \$edad < 18) {
    echo \"Eres un adolescente.\";
} elseif(\$edad >= 18 && \$edad < 65) {
    echo \"Eres un adulto.\";
} elseif(\$edad >= 65) {
    echo \"Eres un anciano.\";
} else {
    echo \"Edad no válida.\";
}
?>\n\n";

// Ejemplo de IF-ELSEIF-...-ELSEIF-ELSE con la variable \$edad y OPERADOR AND (&&)
$edad = 18;     // Cambia este valor para probar diferentes condiciones

if($edad >= 0 && $edad < 15) {
    echo "Eres un escuincle.";
} elseif($edad >= 15 && $edad < 18) {
    echo "Eres un adolescente.";
} elseif($edad >= 18 && $edad < 65) {
    echo "Eres un adulto.";
} elseif($edad >= 65) {
    echo "Eres un anciano.";
} else {
    echo "Edad no válida.";
}

?>