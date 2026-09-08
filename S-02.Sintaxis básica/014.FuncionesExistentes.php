<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "14. FUNCIONES PREEXISTENTES (NATIVAS) EN PHP\n";
echo "======================================================================\n\n";

// ----------------------------------------------------------------------
// 1. Funciones de Cadena (Strings)
// ----------------------------------------------------------------------
echo "======================================================================\n";
echo "1. FUNCIONES DE CADENA\n";
echo "======================================================================\n\n";

$texto = "  Hola Mundo PHP  ";
echo "Texto original: '$texto'\n";
echo "strlen(): " . strlen($texto) . " caracteres\n";
echo "strtoupper(): " . strtoupper($texto) . "\n";
echo "strtolower(): " . strtolower($texto) . "\n";
echo "trim(): '" . trim($texto) . "'\n";
echo "substr(): " . substr(trim($texto), 0, 4) . "\n";
echo "strpos(): Posición de 'Mundo' en el índice " . strpos($texto, "Mundo") . "\n\n";

// ----------------------------------------------------------------------
// 2. Funciones Matemáticas
// ----------------------------------------------------------------------
echo "======================================================================\n";
echo "2. FUNCIONES MATEMÁTICAS\n";
echo "======================================================================\n\n";

$numeroNegativo = -15.75;
echo "Número base: $numeroNegativo\n";
echo "abs(): " . abs($numeroNegativo) . "\n";
echo "round(): " . round($numeroNegativo) . "\n";
echo "ceil(): " . ceil($numeroNegativo) . "\n";
echo "floor(): " . floor($numeroNegativo) . "\n";
echo "rand(1, 100): " . rand(1, 100) . "\n";
echo "sqrt(16): " . sqrt(16) . "\n";
echo "pow(2, 3): " . pow(2, 3) . "\n\n";

// ----------------------------------------------------------------------
// 3. Funciones de Fecha y Hora
// ----------------------------------------------------------------------
echo "======================================================================\n";
echo "3. FUNCIONES DE FECHA Y HORA\n";
echo "======================================================================\n\n";

$timestampActual = time();
echo "time() (Timestamp Unix actual): $timestampActual\n";
echo "date('Y-m-d H:i:s'): " . date("Y-m-d H:i:s", $timestampActual) . "\n";
echo "strtotime('+1 week'): " . date("Y-m-d", strtotime("+1 week")) . "\n\n";

// ----------------------------------------------------------------------
// 4. Funciones del Sistema de Archivos (Filesystem)
// ----------------------------------------------------------------------
echo "======================================================================\n";
echo "4. FUNCIONES DE MANEJO DE ARCHIVOS (NOMBRES CORRECTOS)\n";
echo "======================================================================\n\n";

echo "- fopen(\$archivo, \$modo): Abre un archivo.\n";
echo "- fclose(\$puntero): Cierra un archivo abierto.\n";
echo "- fread(\$puntero, \$longitud): Lee contenido.\n";
echo "- fwrite(\$puntero, \$contenido): Escribe contenido.\n";
echo "- copy(\$origen, \$destino): Copia un archivo (NO fcopy).\n";
echo "- unlink(\$archivo): Elimina un archivo (NO fdelete).\n";
echo "- rename(\$antiguo, \$nuevo): Renombra/mueve un archivo (NO frename).\n";