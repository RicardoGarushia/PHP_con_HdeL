<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "13.X. PASAR POR VALOR VS. PASAR POR REFERENCIA EN PHP\n";
echo "======================================================================\n\n";


echo "\n======================================================================\n";
echo "13.X.3. Sintaxis y Tipado Estricto\n";
echo "======================================================================\n\n";

$valorA = 10;
$valorB = 10;

// Paso por valor
function sumar10PorValor(int $valorA): void {
    $valorA += 10; // Modifica la copia local
}

// Paso por referencia
function sumar10PorReferencia(int &$valorB): void {
    $valorB += 10; // Modifica la dirección de memoria original
}

echo "\nValor inicial de \$valorA = $valorA \n\n";
echo "\nValor inicial de \$valorB = $valorB \n\n";
sumar10PorValor($valorA);
echo "Tras llamar a sumar10PorValor(), \$valorA sigue siendo = $valorA\n\n";

sumar10PorReferencia($valorB);
echo "Tras llamar a sumar10PorReferencia(), \$valorB ahora es = $valorB\n\n";