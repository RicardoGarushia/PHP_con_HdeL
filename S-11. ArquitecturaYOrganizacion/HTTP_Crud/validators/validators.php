<?php
// FUNCIONES DE VALIDACIÓN 

function curpEstablecidoYLleno(): string
{
    if (!isset($_GET['curp']) || empty(trim($_GET['curp']))) {
        http_response_code(400);
        exit("❌ Error 400: El parámetro 'curp' es requerido.");
    }
    return strtoupper(trim($_GET['curp']));
}

function curpFormatoValido(string $curp): string
{
    // 1. Limpiamos espacios y convertimos a MAYÚSCULAS
    $curp = strtoupper(trim($curp));

    // Regex ajustada al estándar oficial de RENAPO
    if (!preg_match("/^[A-Z]{4}\d{6}[A-Z]{6}[A-Z0-9]\d$/", $curp)) {
        http_response_code(400);
        exit("❌ Error 400: El formato del CURP es inválido.");
    }
    return $curp;
}

function validarExistencia(?array $usuario, string $curp): void
{
    if ($usuario === null) {
        http_response_code(404);
        exit("🔍 Error 404: El usuario con CURP '$curp' no existe.");
    }
    echo "✅ Usuario localizado.\n";
}

function validarNivelPremium(array $usuario): void
{
    if ($usuario['nivel'] !== 'premium') {
        http_response_code(403);
        exit("🚫 Error 403: Esta función es exclusiva para Usuarios Premium.\n\n");
    }
    echo "✅ Verificación de nivel Premium exitosa.\n";
}

?>