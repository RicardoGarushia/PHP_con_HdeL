<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "10. BUCLE `FOR` EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "10.2. Ejemplos de Uso\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "A) Contador Ascendente Estándar\n";
echo "======================================================================\n\n";

// Imprime números del 1 al 5
for ($i = 1; $i <= 5; $i++) {
    echo "Iteración número: $i\n";
}


echo "\n\n======================================================================\n";
echo "B) Conteo Descendente\n";
echo "======================================================================\n\n";

// Cuenta regresiva del 5 al 1
for ($i = 5; $i >= 1; $i--) {
    echo "Cuenta regresiva: $i\n";
}


echo "\n\n======================================================================\n";
echo "C) Saltos (Incrementos/Decrementos Personalizados)\n";
echo "======================================================================\n\n";

// Imprime números pares de 0 a 10
for ($i = 0; $i <= 10; $i += 2) {
    echo "Número par: $i\n";
}


echo "\n\n======================================================================\n";
echo "10.3. Control del Bucle: _break_ y _continue_\n";
echo "======================================================================\n\n";

for ($i = 1; $i <= 20; $i++) {
    if ($i === 3) {
        continue; // Salta la iteración cuando $i es 3
    }
    if ($i === 13) {
        break; // Detiene el bucle por completo al llegar a 13
    }
    echo "Valor de \$i: $i\n";
}


echo "\n\n======================================================================\n";
echo "Actividades\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Crea un **bucle `for` que imprima únicamente los números impares del 1 al 15 (usando un incremento de \$i += 2).\n";
echo "======================================================================\n\n";



echo "\n======================================================================\n";
echo "Actividad AVANZADA:\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Crea una pantalla de \"Continue\" de videojuegos con un **bucle `for`** con cuenta regresiva de 20 al 0.
Cuando llegue el contador a 0 (contador = 0) tiene que mostrar un mensaje similar a : \"GAME OVER\".\n";

echo "======================================================================\n\n";

/* 
for ($inicialización; $condición; $decremento) {
    // Código a ejecutar en cada iteración

    if ($condicionA) {
        // Código a ejecutar si condiciónA es true
    }
}
*/
