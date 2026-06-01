<?php
header("Content-Type: text/plain");

echo "55. INMUTABILIDAD \n\n";

echo "55.1 ¿QUÉ ES LA \"INMUTABILIDAD\"?\n\n";

echo "La INMUTABILIDAD es el principio de que un objeto o valor no puede ser modificado después de haber sido creado. 
Una vez que se le asigna un valor a una variable o propiedad, ese valor permanece fijo durante toda la vida útil de ese dato.\n\n";

echo "Si necesitas cambiar un dato inmutable, en lugar de modificarlo directamente (mutación), creas una nueva copia del objeto o valor con el cambio deseado.\n\n\n\n";



echo "55.2 ¿QUÉ RELACIÓN TIENE LA \"INMUTABILIDAD\" CON LA PROGRAMACIÓN FUNCIONAL?\n\n";

echo "La INMUTABILIDAD es uno de los pilares de la Programación Funcional (PF). 
Es el mecanismo clave que permite garantizar la pureza de las funciones y la ausencia de efectos secundarios.\n\n";

echo "Principios de PF      Relación con Inmutabilidad\n";

echo "a) Pureza             Si los datos de entrada son inmutables, la función no puede mutarlos, 
                        lo que elimina una fuente principal de efectos secundarios y garantiza el determinismo.\n\n";  

echo "b) Estado             Evitar el estado compartido (variables globales) y la mutabilidad garantiza que las funciones que operan en paralelo
Compartido              no se pisen o modifiquen datos de manera inesperada.\n\n";

echo "c) Transparencia      Un dato inmutable siempre representa el mismo valor. 
Referencial             Esto significa que puedes reemplazar la llamada a una función con su resultado 
                        sin cambiar el comportamiento del programa, lo cual es vital para el razonamiento lógico y la optimización del código.\n\n\n\n";



echo "55.3 EJEMPLO DE INMUTABILIDAD\n\n";

echo "Aunque PHP por defecto es un lenguaje mutable (orientado a la POO tradicional), 
podemos aplicar el patrón de inmutabilidad al diseñar nuestras clases.\n\n";

echo "El patrón clave es: 
En lugar de modificar el objeto actual, EL MÉTODO DEVUELVE UNA NUEVA INSTANCIA CON EL CAMBIO.\n\n";


class ConfiguracionPantalla{
    // PROPIEDADES O ATRIBUTOS: 
    private readonly int $brillo;   // Se utiliza readonly para evitar mutaciones (Disponible desde PHP 8.1+) y reforzar la inmutabilidad.
    private readonly int $contraste;    // Se utiliza readonly para evitar mutaciones (Disponible desde PHP 8.1+) y reforzar la inmutabilidad.
    private readonly int $nitidez;  // Se utiliza readonly para evitar mutaciones (Disponible desde PHP 8.1+) y reforzar la inmutabilidad.

    // GETTERS Y SETTERS:
    // a) Getters:
    public function getBrillo(): int{
        return $this->brillo;
    }
    public function getContraste(): int{
        return $this->contraste;
    }
    public function getNitidez(): int{
        return $this->nitidez;
    }
    // b) Setters


    // MÉTODOS:
    // El patrón clave es: 
    // En lugar de modificar el objeto actual, EL MÉTODO DEVUELVE UNA NUEVA INSTANCIA CON EL CAMBIO.
    public function configuracionPersonalizada ($cambioBrillo, $cambioContraste, $cambioNitidez): ConfiguracionPantalla{
        $configuracionPersonalizada = new ConfiguracionPantalla($this->brillo + $cambioBrillo, $this->contraste + $cambioContraste, $this->nitidez + $cambioNitidez);
        return $configuracionPersonalizada;
    }

    // a) Métodos mágicos:

    // a1) Constructor:
    public function __construct(int $brilloPreestablecido, int $contrastePreestablecido, int $nitidezPreestablecida){
        $this->brillo = $brilloPreestablecido;
        $this->contraste = $contrastePreestablecido;
        $this->nitidez = $nitidezPreestablecida;
    }
    // a2) Destructor:
}

$configuracionPantallaPredeterminada = new ConfiguracionPantalla(50, 50, 50); // Configuración predeterminada

echo "El brillo preestablecido de la pantalla es: " . $configuracionPantallaPredeterminada->getBrillo() . "\n";         // 50
echo "El contraste preestablecido de la pantalla es: " . $configuracionPantallaPredeterminada->getContraste() . "\n";   // 50
echo "La nitidez preestablecido de la pantalla es: " . $configuracionPantallaPredeterminada->getNitidez() . "\n\n";     // 50  

    // El patrón clave es: 
    // En lugar de modificar el objeto actual $ubicaciónCasa, EL MÉTODO DEVUELVE UNA NUEVA INSTANCIA $nuevaUbicacionCasa CON EL CAMBIO.
$configuracionPersonalizadaUsuario = $configuracionPantallaPredeterminada->configuracionPersonalizada(30, 20, 10);  // Nueva configuración de la pantalla

echo "El brillo de la pantalla seleccionado por el usuario es: " . $configuracionPersonalizadaUsuario->getBrillo() . "\n";          // 80
echo "El contraste de la pantalla seleccionado por el usuario es: " . $configuracionPersonalizadaUsuario->getContraste() . "\n";    // 70
echo "La nitidez de la pantalla seleccionado por el usuario es: " . $configuracionPersonalizadaUsuario->getNitidez() . "\n\n";      // 60  

echo "El brillo preestablecido de la pantalla es: " . $configuracionPantallaPredeterminada->getBrillo() . "\n";         // 50
echo "El contraste preestablecido de la pantalla es: " . $configuracionPantallaPredeterminada->getContraste() . "\n";   // 50
echo "La nitidez preestablecido de la pantalla es: " . $configuracionPantallaPredeterminada->getNitidez() . "\n\n";     // 50  


