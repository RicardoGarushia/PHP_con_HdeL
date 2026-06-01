<?php
header("Content-Type: text/plain");

echo "\n24. POO: Static: Procedimientos y funciones estáticas de una clase (sin la instancia de objetos)\n\n";

echo "24.1 Definición de Static en PHP:\n\n";

echo "La palabra clave \"static\" en PHP se utiliza para definir propiedades y métodos estáticos dentro de una clase,
QUE PERTENECEN A LA CLASE EN SÍ MISMA, NO A LAS INSTANCIAS DE LA CLASE.
Esto significa que los valores o procedimientos de miembros estáticos (propiedades y métodos) 
se comparten entre todos los objetos creados dado que pertenecen a la clase en sí misma,
en lugar de ser elementos de instancias individuales (objetos) de la clase.\n\n";

echo "Esto significa que los miembros estáticos pueden ser accedidos sin necesidad de crear un objeto de la clase.
Esto es útil para definir propiedades o métodos que son comunes a todas las instancias de la clase,
como contadores, propiedades globales, configuraciones preestablecidas o funciones utilitarias.\n\n\n";


echo "24.2 Definición de una propiedad estática en PHP:\n\n";
echo "Una propiedad estática es una propiedad que pertenece a la clase en sí misma, en lugar de a una instancia específica de la clase (objeto).
Las propiedades estáticas se definen utilizando la palabra clave \"static\" y se pueden acceder sin crear un objeto de la clase.
Las propiedades estáticas son útiles para almacenar datos que son comunes a todas las instancias de la clase, 
como contadores, propiedades globales o configuraciones preestablecidas.\n\n\n";


echo "24.3 Definición de un método estático en PHP:\n\n";
echo "Un método estático es un método que pertenece a la clase en sí misma, en lugar de a una instancia específica de la clase (objeto).
Los métodos estáticos se definen utilizando la palabra clave \"static\" y se pueden llamar sin crear un objeto de la clase.
Los métodos estáticos son útiles para realizar operaciones que no dependen de los datos de una instancia específica, 
como funciones utilitarias o de ayuda.\n\n\n";


echo "24.4 Sintaxis de propiedades y métodos estáticos en PHP:\n\n";
echo "La sintaxis básica para declarar propiedades y métodos estáticos de una clase es la siguiente:\n\n";

echo "<?php
// EJEMPLO de Definición de una clase con propiedades y métodos estáticos
class NombreDeLaClase { 
    // Propiedad estática
    public static \$propiedadEstatica = \"Valor estático\"; // Propiedad estática

    // Método estático
    public static function metodoEstatico() {
        return \"Valor estático\"; // Asumiendo que quieres retornar un valor
    }
}

// NO ES NECESARIO CREAR OBJETO ALGUNO

// Accediendo a la propiedad estática mediante impresión directa
echo \"El valor de la propiedad estática, mediante impresión directa, es: \\n
\" . NombreDeLaClase::\$propiedadEstatica; // Salida: Valor estático

// Accediendo a la propiedad estática mediante almacenamiento en variable y posterior impresión
\$valorDePropiedadEstatica = NombreDeLaClase::\$propiedadEstatica;
echo \"El valor de la propiedad estática, mediante guardado previo en variable, es: \$valorDePropiedadEstatica\"; // Salida: Valor estático

// Accediendo al método estático mediante impresión directa
echo \"El valor del método estático, mediante impresión directa, es: \" . NombreDeLaClase::metodoEstatico(); // Salida: Valor retornado por el método estático

// Accediendo al método estático mediante almacenamiento en variable y posterior impresión
\$valorDeMetodoEstatico = NombreDeLaClase::metodoEstatico();
echo \"El valor del método estático, mediante guardado previo en variable, es: \$valorDeMetodoEstatico\"; // Salida: Valor retornado por el método estático
?>\n\n";


// Definición de una clase con propiedades y métodos estáticos
class NombreDeLaClase {
    // Propiedad estática
    public static $propiedadEstatica = "Valor estático"; // Propiedad estática

    // Método estático
    public static function metodoEstatico() {
        return "Valor estático"; // Asumiendo que quieres retornar un valor
    }
}

// NO ES NECESARIO CREAR OBJETO ALGUNO

// Accediendo a la propiedad estática mediante impresión directa
echo "El valor de la propiedad estática, mediante impresión directa, es: " . NombreDeLaClase::$propiedadEstatica; // Salida: Valor estático

// Accediendo a la propiedad estática mediante almacenamiento en variable y posterior impresión
$valorDePropiedadEstatica = NombreDeLaClase::$propiedadEstatica;
echo "\nEl valor de la propiedad estática, mediante guardado previo en variable, es: $valorDePropiedadEstatica"; // Salida: Valor estático

// Accediendo al método estático mediante impresión directa
echo "\nEl valor del método estático, mediante impresión directa, es: " . NombreDeLaClase::metodoEstatico(); // Salida: Valor retornado por el método estático

// Accediendo al método estático mediante almacenamiento en variable y posterior impresión
$valorDeMetodoEstatico = NombreDeLaClase::metodoEstatico();
echo "\nEl valor del método estático, mediante guardado previo en variable, es: $valorDeMetodoEstatico"; // Salida: Valor retornado por el método estático

echo "\n\n\n21.5 Ejemplo de uso de propiedades y métodos estáticos en PHP:\n\n";
echo "<?php
class ContandoInstanciasDeClase {
    // Propiedad estática para contar instancias de la clase
    public static \$contador = 0;

    // Constructor que incrementa el contador cada vez que se crea una instancia de la clase
    public function __construct() {
        self::\$contador++;
    }

    // Método estático para obtener el valor del contador
    public static function obtenerContador() {
        return self::\$contador;
    }
}

\$objeto1 = new ContandoInstanciasDeClase;
// ContandoInstanciasDeClase::resetearContador(); 
\$objeto2 = new ContandoInstanciasDeClase;
// ContandoInstanciasDeClase::resetearContador(); 
\$objeto3 = new ContandoInstanciasDeClase;
// ContandoInstanciasDeClase::resetearContador(); 

// Accediendo al método estático mediante almacenamiento en variable y posterior impresión
\$valorDeMetodoEstatico = ContandoInstanciasDeClase::obtenerContador();
echo \"Se han creado: \$valorDeMetodoEstatico instancias de clase\\n\\n\"; // Salida: Valor retornado por el método estático
?>\n\n";

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
        
        echo"Se resetea contador\n";
    }

    // Método estático que muestra el valor del contador
    public static function mostrarContador() {
        // Accediendo al método estático mediante almacenamiento en variable y posterior impresión
        $valorDeMetodoEstatico = ContandoInstanciasDeClase::obtenerContador();
        echo "Se han creado: $valorDeMetodoEstatico instancias de clase\n"; // Salida: Valor retornado por el método estático
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

?>