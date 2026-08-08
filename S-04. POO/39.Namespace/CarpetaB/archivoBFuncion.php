<?php
namespace CarpetaB;

// Definición de una función para evaluar si una persona es mayor de edad
function EvaluarAdulto($edad): string
{
    if ($edad > 18) {
        return "Eres mayor de edad.\n";
    } else {
        return "Eres menor de edad.\n";
    }
}
function Similar(): string {
    return "Hola, este es un saludo desde la función Similar() de la CarpetaB.";
}   