<?php

header("Content-Type: text/plain");

echo"\n33. POLIMORFISMO: Sobreescritura de métodos\n\n";

echo"32.1 ¿Qué el polimorfismo?\n";
echo"El polimorfismo se refiere a la capacidad que tienen los objetos 
de comportarse de diferentes maneras o de tomar muchas formas, 
dependiendo del contexto en el que se utilizan durante el tiempo de ejecución. 
El polimorfismo se manifiesta principalmente en la forma en que 
los métodos se implementan en las clases de dichos objetos. En resumen, 
las clases implementan el polimorfismo en los métodos 
y los objetos muestran dicho comportamiento polimórfico.\n\n";

echo "El polimorfismo se apoya en una interfaz común que las diferentes clases comparten. 
Esta interfaz común define un conjunto de métodos que todas las clases deben implementar
(actuando como un contrato) y permite tratar los objetos de las diferentes de manera uniforme.
La interfaz común puede ser una clase padre (herencia), una interfaz o incluso un trait (rasgo).\n\n";

echo "El polimorfismo se logra de diferentes maneras en cada uno: 
    a) Clase padre (herencia): El polimorfismo se logra a través de la sobreescritura de métodos.
    b) Interfaces: El polimorfismo se logra cuando las clases implementan los métodos definidos en la interfaz.
    c) Traits (rasgos): El polimorfismo se logra si diferentes clases utilizan el mismo trait que define un método.\n\n";

echo "Por tanto, la clave del polimorfismo radica en que, 
aunque comparten una interfaz (y por lo tanto, las mismas firmas de métodos -nombre y parámetros de entrada-), 
cada clase implementa esos métodos de una manera que sea específica a su propia naturaleza, 
permitiendo el comportamiento polimórfico de sus objetos.\n\n";

echo"El polimorfismo hace que el código sea más flexible y reutilizable.
Puedes escribir código que funcione con una variedad de objetos 
sin necesidad de conocer sus tipos exactos en tiempo de compilación.\n\n\n";


echo"33.2 ¿Qué es la sobreescritura de métodos?\n";

echo"La sobrescritura de métodos es un concepto fundamental en la POO que ocurre cuando 
una subclase (una clase que hereda de otra clase, llamada superclase o clase padre) 
proporciona una nueva implementación para un método que ya está definido en su superclase.
En esencia, la subclase \"reemplaza\" o, mejor dicho, \"sobreescribe\"
el comportamiento heredado del método de la superclase
para adaptarlo a sus propias necesidades o a su naturaleza más específica.\n\n";

echo "La sobreescritura de métodos se da bajo las condiciones siguientes: 
a) Herencia: Una clase debe heredar (extender) de otra clase (superclase) para poder sobrescribir sus métodos.
b) Misma firma: Es decir, mismo nombre, mismos parámetros/argumentos (tipo y orden) y mismo tipo de retorno.
c) Visibilidad del método sobrescrito en la subclase debe ser igual o más accesible que en la superclase 
(por ejemplo, un método protegido en la superclase puede ser público o protegido en la subclase, 
pero no privado).\n\n";

echo "Si alguna de las condiciones anteriores no se cumple, no es sobreescritura de métodos.\n\n";

echo "33.3 Ejemplo práctico de sobreescritura de métodos\n";
echo "<?php
abstract class AreaFormaGeometrica {
    // Propiedades o atributos protegidos de la CLASE PADRE a ser heredados (y utilizados) por la CLASE HIJA
    protected float \$area;
    
    // Método protegido que puede ser utilizado por las clases hijas
    public function calcularArea(float \$base, float \$altura):float
    {
        return (\$base * \$altura);
    }
}

class Triangulo extends FormaGeometrica {
    // Sobreescribiendo el método calcularArea de la clase padre AreaFormaGeometrica
    public function calcularArea(float \$base, float \$altura):float    // Volver en comentario para ejecutar método de clase padre
    {   // Volver en comentario para ejecutar método de clase padre
        return (\$base * \$altura) / 2; // Volver en comentario para ejecutar método de clase padre
    }   // Volver en comentario para ejecutar método de clase padre
}

\$miTriangulo = new Triangulo();    // Instanciando la clase Triangulo
echo \"El área del triángulo es: \" . \$miTriangulo->calcularArea(5, 10) . \"\\n\\n\";
?>";

abstract class AreaFormaGeometrica
{
    // Propiedades o atributos protegidos de la CLASE PADRE a ser heredados (y utilizados) por la CLASE HIJA
    protected float $area;

    // Método protegido que puede ser utilizado por las clases hijas
    public function calcularArea(float $base, float $altura): float
    {
        return ($base * $altura);
    }
}

class Triangulo extends AreaFormaGeometrica
{
    // Sobreescribiendo el método calcularArea de la clase padre AreaFormaGeometrica
    public function calcularArea(float $base, float $altura): float // Volver en comentario para ejecutar método de clase padre
    {   // Volver en comentario para ejecutar método de clase padre
        return ($base * $altura) / 2;   // Volver en comentario para ejecutar método de clase padre
    }   // Volver en comentario para ejecutar método de clase padre
}

$miTriangulo = new Triangulo(); // Instanciando la clase Triangulo
echo "\n\nEl área del triángulo es: " . $miTriangulo->calcularArea(5, 10) ;
