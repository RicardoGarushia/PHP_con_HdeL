<?php
header("Content-Type: text/plain");

echo "\n======================================================================\n";
echo "6. ESTRUCTURA DE CONTROL IF, IF-ELSE Y IF-ELSEIF-ELSE EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "6.3. Evaluación con Operadores Lógicos (&& y ||)\n";
echo "======================================================================\n\n";

$edad = 18;

if ($edad >= 18 && $edad < 65) {                                // if (condicionA AND condicionB) {
    echo "Eres un ser humano adulto en edad laboral.\n\n";      // Código si condicionA AND condicionB son (ambas) true
} else if (($edad >= 0 && $edad < 18) || ($edad > 65)) {        // } else if ((condicionC) OR (condicionD)) {
    echo "Eres un ser humano que no está en edad laboral.\n\n"; // Código si condicionC OR condicionD es true
} else {                                                        // } else {
    echo "¿Qué edad es esa?\n\n";                               // Código si todas las condiciones son false
}                                                               // }


echo "\n======================================================================\n";
echo "Actividades\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Estructura de control que evalúa la variable \$edad y muestra la división pertinente a la edad\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Estructura de control que evalúa dos o más variables\n";
echo "======================================================================\n\n";

