<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "13. FUNCIONES EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "13.2. Combinaciones de Parámetros y Retorno\n";
echo "======================================================================\n\n";

// A) Sin parámetros y sin retorno
function saludar1(): void {
    echo "¡Hola desde saludar1() [Sin parámetros, Sin retorno]!\n";
}
saludar1();

// B) Sin parámetros y con retorno
function saludar2(): string {
    return "¡Hola desde saludar2() [Sin parámetros, Con retorno]!\n";
}
echo saludar2();

// C) Con parámetros y sin retorno
function saludar3(string $nombre, string $apellido): void {
    echo "¡Hola, $nombre $apellido desde saludar3() [Con parámetros, Sin retorno]!\n";
}
saludar3("Ricardo", "García");

// D) Con parámetros y con retorno
function saludar4(string $nombre, string $apellido): string {
    return "¡Hola, $nombre $apellido desde saludar4() [Con parámetros, Con retorno]!\n";
}
echo saludar4("Ricardo", "García");


echo "\n\n======================================================================\n";
echo "13.3. Parámetros Opcionales\n";
echo "======================================================================\n\n";

function saludar5(string $nombre = "Invitado"): string {
    return "Hola, $nombre! [Parámetro Opcional]\n";
}

echo saludar5();        // Utiliza valor por defecto
echo saludar5("Juan");  // Sobrescribe el valor por defecto


echo "\n\n======================================================================\n";
echo "13.4. Retorno Nullable (?Tipo)\n";
echo "======================================================================\n\n";

function saludar6(?string $nombre): ?string {
    return $nombre ? "Hola, $nombre!\n" : null;
}

$resNull = saludar6(null);
echo "Resultado con null: " . ($resNull === null ? "VALOR NULO DETECTADO\n" : $resNull);    // Operador condicional ternario (véase 009.Operadores.md)

$resNombre = saludar6("Ricardo");
echo "Resultado con valor: " . ($resNombre === null ? "VALOR NULO DETECTADO\n" : $resNombre);   // Operador condicional ternario (véase 009.Operadores.md)


echo "\n\n======================================================================\n";
echo "Actividades\n";
echo "======================================================================\n\n";

echo "\n======================================================================\n";
echo "Crea una función esPar(int \$numero): string que devuelva true si es par.\n";
echo "======================================================================\n\n";

// Tu solución aquí:
$numero = 3; 
function esPar(int $numero): string {
    $resto = $numero % 2;  
    if ($resto === 0) {
        return "Cierto";
    }
    else {
        return "Falso";
    }
}

echo "Es " . esPar($numero) . " que el número $numero es PAR.\n\n";

for ($i = 1; $i <=50; $i++) {
    echo "Es " . esPar($i) . " que el número $i es PAR.\n";
}