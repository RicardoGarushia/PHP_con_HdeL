<?php
namespace CarpetaA;

// Definición de la clase Usuario
class Usuario {
    // Propiedades o atributos: 
    private $nombre;
    private $apellido;
    private $estado;

    // Métodos:
    public function Saludar(): string {
        return "Hola, mi nombre es " . $this->nombre . " " . $this->apellido . ". \nSoy un usuario " . ($this->estado ? "activo" : "inactivo") . ".\n";
    }
    
    // Constructor para inicializar los atributos
    public function __construct($nombreUsuario, $apellidoUsuario, $usuarioActivo) {
        $this->nombre = $nombreUsuario;
        $this->apellido = $apellidoUsuario;
        $this->estado = $usuarioActivo;
    }
}

function Similar(): string {
    return "Hola, este es un saludo desde la función Similar() de la CarpetaA.";
}   