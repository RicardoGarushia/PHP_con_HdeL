<?php

function responderError(int $codigo, string $mensajeDeError) {
    // Aquí es donde armas el mensaje final de forma centralizada
    $prefijo = "Ocurrió un error inesperado: ";
    
    // OPERADOR DE COALESCENCIA:    SiExisteYNoEsNULL_UsaEste ?? SiNOExisteOEsNULL_UsaEsto; 
    // OPERADOR TERNARIO:           (condición) ? valor_si_es_cierto : valor_si_es_falso;
    $mensajeFinal = DEBUG_MODE 
        ? $prefijo . $mensajeDeError 
        : $prefijo . "Informe al administrador de sistema o intente de nuevo después.";

    http_response_code($codigo);
    echo json_encode(["error" => $mensajeFinal]);
    exit;
}