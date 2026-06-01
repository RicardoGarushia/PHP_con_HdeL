<?php
header("Content-Type: text/plain");

echo "54. RECURSIVIDAD \n\n";

echo "54.1 ¿QUÉ ES LA \"RECURSIVIDAD\"?\n\n";

echo "La RECURSIVIDAD es un concepto en el que UNA FUNCIÓN SE LLAMA A SÍ MISMA DE FORMA REPETIDA HASTA RESOLVER UN PROBLEMA.\n\n";

echo "Piensa en la RECURSIVIDAD como una versión de un bucle (como un for o while), pero implementada a través de la llamada de funciones.\n\n";

echo "Se utiliza a menudo para resolver problemas que pueden dividirse en subproblemas más pequeños y autosimilares, 
como recorrer estructuras de datos jerárquicas (árboles) o calcular secuencias matemáticas.\n\n\n\n";



echo "54.2 ¿CÓMO FUNCIONA LA \"RECURSIVIDAD\"?\n\n";

echo "Una función recursiva generalmente consta de dos partes principales:\n\n";

echo "a) CASO BASE (BASE CASE): 
Es la CONDICIÓN QUE DETIENE LA RECURSIÓN. Es la condición de salida.
Es esencial para evitar llamadas infinitas y eventual desbordamiento de la pila (stack overflow).\n\n";

echo "b) LLAMADA RECURSIVA (RECURSIVE CALL): 
Es DONDE LA FUNCIÓN SE LLAMA A SÍ MISMA con un conjunto modificado de argumentos, acercándose al caso base en cada llamada.\n\n\n\n";



echo "54.3 ¿POR QUÉ ES IMPORTANTE LA \"RECURSIVIDAD\" EN LA PROGRAMACIÓN FUNCIONAL?\n\n";

echo "La RECURSIVIDAD es fundamental para la Programación Funcional (PF) porque en la PF se evita el uso de bucles imperativos (for, while, etc.) 
que requieren la mutación de variables (como un contador i++ o una variable de estado).\n\n";

echo "En otras palabras, LA RECURSIVIDAD REEMPLAZA LOS BUCLES ya que lugar de cambiar el valor de una variable en cada iteración, 
la RECURSIVIDAD resuelve el problema creando una nueva llamada a función con nuevos valores, 
manteniendo el principio de INMUTABILIDAD (véase 55.Inmutabilidad) y AUSENCIA DE EFECTOS SECUNDARIOS. \n\n\n\n";



echo "54.4 EJEMPLO DE RECURSIVIDAD\n\n";

echo "function mostrarNumero(\$numero) {
    // CASO BASE: La condición de salida, donde la función deja de llamarse.
    if (\$numero < 1) {
        echo \"¡BOOM!\\n\\n\\n\\n\";
        return;
    }
    
    echo \"La bomba explota en: \$numero...\\n\";
    
    // LLAMADA RECURSIVA: La función se llama a sí misma con un argumento más pequeño.
    // Esto asegura que, eventualmente, se alcance el caso base.
    mostrarNumero(\$numero - 1);
}

echo \"La ejecución de la función mostrarNumero con el valor inicial de 10:\\n\\n\";
mostrarNumero(10); \n\n\n\n";



function mostrarNumero($numero) {
    // CASO BASE: La condición de salida, donde la función deja de llamarse.
    if ($numero < 1) {
        echo "¡BOOM!\n\n\n\n";
        return;
    }
    
    echo "La bomba explota en: $numero...\n";
    // LLAMADA RECURSIVA: La función se llama a sí misma con un argumento más pequeño.
    // Esto asegura que, eventualmente, se alcance el caso base.
    mostrarNumero($numero - 1);
}

echo "La ejecución de la función mostrarNumero con el valor inicial de 10:\n\n";
mostrarNumero(10); 

echo "La LLAMADA RECURSIVA [ mostrarNumero(\$numero - 1) ] crea un nuevo contexto de función en la pila de llamadas (call stack) cada vez que se invoca.
Sin embargo, sin el CASO BASE [ if (\$numero < 1) ] la función continuaría hasta agotar la memoria.\n\n";


?>