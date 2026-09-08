<?php
header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "24. POO: MIEMBROS ESTÁTICOS (static)\n";
echo "======================================================================\n\n";

// --- EJECUCIÓN DEL CÓDIGO REAL ---

class NombreDeLaClase {
    // Propiedad estática
    public static $propiedadEstatica = "Valor estático";

    // Método estático
    public static function metodoEstatico() {
        return "Valor estático";
    }
}

// NO ES NECESARIO CREAR OBJETO ALGUNO

// Accediendo a la propiedad estática mediante impresión directa
echo "El valor de la propiedad estática, mediante impresión directa, es: " . NombreDeLaClase::$propiedadEstatica;

// Accediendo a la propiedad estática mediante almacenamiento en variable y posterior impresión
$valorDePropiedadEstatica = NombreDeLaClase::$propiedadEstatica;
echo "\nEl valor de la propiedad estática, mediante guardado previo en variable, es: $valorDePropiedadEstatica";

// Accediendo al método estático mediante impresión directa
echo "\nEl valor del método estático, mediante impresión directa, es: " . NombreDeLaClase::metodoEstatico();

// Accediendo al método estático mediante almacenamiento en variable y posterior impresión
$valorDeMetodoEstatico = NombreDeLaClase::metodoEstatico();
echo "\nEl valor del método estático, mediante guardado previo en variable, es: $valorDeMetodoEstatico";

echo "\n\n\n25.5 Ejemplo de uso de propiedades y métodos estáticos en PHP:\n\n";

class ContandoInstanciasDeClase {
    // Propiedad estática para contar instancias de la clase
    private static $contador = 0;

    // Constructor que incrementa el contador cada vez que se crea una instancia de la clase
    public function __construct() {
        self::$contador++;
    }

    // Método estático para obtener el valor del contador
    public static function obtenerContador() {
        return self::$contador;
    }

    // Método estático que resetea el valor del contador
    public static function resetearContador() {
        self::$contador = 0;
        echo "Se resetea contador\n";
    }

    // Método estático que muestra el valor del contador
    public static function mostrarContador() {
        $valorDeMetodoEstatico = ContandoInstanciasDeClase::obtenerContador();
        echo "Se han creado: $valorDeMetodoEstatico instancias de clase\n";
    }
}

$objeto1 = new ContandoInstanciasDeClase;
// ContandoInstanciasDeClase::mostrarContador();
// ContandoInstanciasDeClase::resetearContador();

$objeto2 = new ContandoInstanciasDeClase;
ContandoInstanciasDeClase::mostrarContador();
ContandoInstanciasDeClase::resetearContador();

$objeto3 = new ContandoInstanciasDeClase;
// ContandoInstanciasDeClase::mostrarContador();
// ContandoInstanciasDeClase::resetearContador();

ContandoInstanciasDeClase::mostrarContador();