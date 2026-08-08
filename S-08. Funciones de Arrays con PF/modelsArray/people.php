<?php
namespace ModelsArray; 

class People {
    // Propiedades o atributos: 
    public string $name; 
    public int $age;
    public string $sex;
    // Métodos:

    // Métodos mágicos:

        // Constructor:
        public function __construct(string $nombre, int $edad, string $sexo){
            $this->name = $nombre;
            $this->age = $edad;
            $this->sex = $sexo;
        } 
        // Destructor:
}