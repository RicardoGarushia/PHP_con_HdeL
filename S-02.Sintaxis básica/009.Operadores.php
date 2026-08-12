<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "9. OPERADORES EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "9.2.1 Operador Condicional Ternario (`?  :`)\n";
echo "======================================================================\n\n";

$edad = 20; // Modifica el valor de la edad para ver otro funcionamiento.

// Si $edad >= 18 es true devuelve "Adulto", de lo contrario "Niño"
$etapa = ($edad >= 18) ? "Adulto" : "Niño";

echo "Por tu edad de $edad años eres $etapa \n\n";


echo "\n======================================================================\n";
echo "9.2.2 Operador \"Short Ternary\" (`?:`)\n";
echo "======================================================================\n\n";

$nombreRegistrado = ""; // Modifica el valor. En PHP, son valores 'falsy': 0, "0", 0.0, "", [], NULL.

// Si $nombreRegistrado se evalúa como false, se asigna "Invitado" a la variable $nombreUsuario.
// Si $nombreRegistrado se evalúa como true, se asigna el valor de $nombreRegistrado a $nombreUsuario
$nombreUsuario = $nombreRegistrado ?: "Invitado";    // Modifica el nombre de la variable para que sea variable NO definida

echo "El nombre registrado es '$nombreRegistrado' por lo que tu nombre de usuario es: '$nombreUsuario'\n\n";

// CUIDADO: Si la variable no está definida:
// echo $variableNoExiste ?: "Default";
// Genera: Warning: Undefined variable $variableNoExiste

echo "\n======================================================================\n";
echo "9.2.3 Operador de Coalescencia Nula (`??`)\n";
echo "======================================================================\n\n";

$nombreRegistrado = ""; // Modifica el valor. En PHP, son valores 'falsy': 0, "0", 0.0, "", [], NULL.

$nombreUsuario = $nombreRegistrado ?? "Invitado";

echo "El nombre registrado es '$nombreRegistrado' por lo que tu nombre de usuario es: '$nombreUsuario'\n\n";

// Ejemplo 2: Variable no definida o nula
$avatar = $_GET['avatar'] ?? "default.png";
echo "El valor de \$_GET['avatar'] es: $avatar \n\n"; // Resultado: "default.png" (No genera Warning si $_GET['avatar'] no existe)


echo "\n======================================================================\n";
echo "9.2.4 Asignación de Coalescencia Nula (??=) (PHP 7.4+)\n";
echo "======================================================================\n\n";

$nombreRegistrado = ""; // Modifica el valor.

$nombreRegistrado ??= "Invitado";   // Equivale a escribir: $nombreRegistrado = $nombreRegistrado ?? "Invitado";

echo "El nombre final del usuario es: '$nombreRegistrado'\n\n";

echo "Otro ejemplo, porque ya fue mucho nombre...\n";

$puerto = 8080;     // Modifica el valor del puerto
$puerto ??= 3000;   // Como $puerto ya existe y no es null, se conserva 8080.

echo "Se usará el puerto: $puerto \n\n"; // Resultado: 8080


echo "\n======================================================================\n";
echo "9.4. Operadores destacados\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "9.4.1 Operador Nave Espacial (`<=>`) [PHP 7+]\n";
echo "======================================================================\n\n";

echo "a) Operador Nave Espacial (<=>) [PHP 7+]:\n";
echo "   - Al evaluar (1 <=> 2) se devuelve el valor: " . (1 <=> 2) . " (Devuelve -1 si el de la izquierda es menor)\n";
echo "   - Al evaluar (2 <=> 2) se devuelve el valor: " . (2 <=> 2) . " (Devuelve 0 si son iguales)\n";
echo "   - Al evaluar (3 <=> 2) se devuelve el valor: " . (3 <=> 2) . " (Devuelve 1 si el de la izquierda es mayor)\n\n";


echo "\n======================================================================\n";
echo "Actividades\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "Tus propios usos de Operadores (Ejemplos libres)\n";
echo "======================================================================\n\n";

