<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "27. POO: Herencia\n";
echo "======================================================================\n\n";

class Humano  // Clase padre (SUPERCLASE)
{
    // 1. Propiedades (atributos) de la clase
    protected string $especie = "Homo sapiens";

    // 2. Métodos (funciones) de la clase
    public function hablar(): string
    {
        return "\"Sonidos genéricos\"\n\n";
    }

    // 3. Getters y setter (Acceso a propiedad protegida por clases hijas)
    public function obtenerEspecie(): string
    {
        return $this->especie;
    }
}

class Mexicano extends Humano // Clase hija (SUBCLASE)
{
    // 1. Propiedades (atributos) de la clase
    protected string $pais = "México";

    // 2. Métodos (funciones) de la clase
    // A. SOBREESCRITURA del método (Se reemplaza por completo el método hablar() de la clase padre)
    public function hablar(): string
    {
        return "\n¡Que tranza wey! Yo hablo español.";
    }

    // 3. Getters y setter (Acceso a propiedad protegida por clases hijas)
    public function obtenerPais(): string
    {
        return $this->pais;
    }
}

class MexicoAmericano extends Mexicano // Clase nieta (SUB-SUBCLASE)
{
    // 1. Propiedades (atributos) de la clase: NO HAY

    // 2. Métodos (funciones) de la clase: NO HAY
    // B. EXTENSIÓN de Método (Conserva la lógica del padre y agrega más)
    public function hablar(): string
    {
        return parent::hablar() . ".. and English, too! ";
    }

    // 3. Getters y setter (Acceso a propiedad protegida por clases hijas): NO HAY
}

$mexicano1 = new Mexicano();
echo $mexicano1->hablar();  // Salida: "¡Que tranza wey! Yo hablo español"
echo " Yo nací en " . $mexicano1->obtenerPais() . " y soy " . $mexicano1->obtenerEspecie() . "\n\n";

$mexicano2 = new MexicoAmericano();
echo $mexicano2->hablar();  // Salida: "¡Que tranza wey! Yo hablo español... and English, too!"
echo " Yo nací en " . $mexicano2->obtenerPais() . " y soy " . $mexicano2->obtenerEspecie() . "\n\n";
