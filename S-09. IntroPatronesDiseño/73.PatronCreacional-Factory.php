<?php
header("Content-Type: text/plain");

echo "73. PATRONES DE DISEÑO: CREACIONAL - FACTORY METHOD\n\n";

echo "73.1 ¿QUÉ ES EL PATRÓN FACTORY METHOD?\n\n";

echo "El patrón Factory Method es un patrón de diseño creacional
que proporciona una interfaz para crear objetos en una superclase,
pero permite a las subclases alterar el tipo de objetos que se crearán.\n\n";

echo "El patrón Factory Method permite la creación de objetos
sin especificar exactamente qué clase de objeto será creado,
lo que facilita la extensión y mantenimiento del código.\n\n\n";



echo "73.2 ESTRUCTURA DEL PATRÓN FACTORY METHOD\n\n";

echo "El patrón Factory Method consta de los siguientes componentes principales:\n";
echo "1. Creator (Creador): Una clase (normalmente abstracta) que declara el factory method, 
que devuelve un objeto de tipo Product.\n
NOTA 1. El Creator puede también proporcionar una implementación por defecto del factory method que devuelva un producto predeterminado.\n
NOTA 2. contiene la lógica de negocio (factory method) para crear objetos.\n";
echo "2. Concrete Creator (Creador Concreto): Subclases que sobrescriben (override) el factory method para cambiar el tipo de producto resultante.\n";
echo "3. Product Interface (Interfaz de Producto): Una interfaz o clase base que define el contrato de lo que la fábrica construye.\n";
echo "4. Concrete Products (Productos Concretos): Clases que implementan la interfaz Product.\n\n\n";



echo "73.3 ¿CUANDO UTILIZAR EL PATRÓN FACTORY METHOD?\n\n";
echo "El patrón Factory Method es útil en las siguientes situaciones:\n";
echo "a) Cuando una clase no puede anticipar la clase de objetos que debe crear.\n";
echo "b) Cuando una clase quiere que sus subclases especifiquen los objetos que crean.\n";
echo "c) Cuando quieres delegar la responsabilidad de creación a una de varias subclases auxiliares
y quieres localizar el conocimiento de qué subclase es la correcta.\n";
echo "d) Cuando quieres cumplir con el Principio de Abierto/Cerrado (Open/Closed Principle):
Puedes introducir nuevos tipos de productos en el programa 
SIN descomponer el código cliente existente.
Solo creas un nuevo Concrete Product y un nuevo Concrete Creator.";





echo "73.2 ESTRUCTURA DEL PATRÓN FACTORY METHOD\n\n";

echo "A continuación, se presenta un ejemplo del patrón Factory Method en PHP:\n\n";
// Creator (Creador)
abstract class Creator {
    // Función abstracta Factory Method que debe ser implementado por los Concrete Creators
    abstract public function factoryMethod(): Product;

    // Función que utiliza el producto creado por el factory method
    public function someOperation(): string {
        // Lógica de negocio que depende del producto creado por el factory method
        // 1. La clase abstracta Creator no se puede implementar, así que $this se refiere al hijo que hereda de esta clase abstracta Creator.
        // 2. No sólo eso, al no poderse implementar la clase abstracta Creator, esa función factoryMethod() se refiere al factoryMethod() sobreescrito por la clase hija.
        // 3. Una vez que este código se almacena en la variable $product (que en sí, es un objeto), se invoca la función operation() de dicho objeto.
        // Por lo tanto, el código del Creator (Creador) puede trabajar con cualquier clase de producto que devuelva el factory method, sin importar su clase concreta.
        $product = $this->factoryMethod();
        return "Creator: El mismo código del creador ha trabajado con " . $product->operation();
    }
}

// Concrete Creator 1 (Creador Concreto 1)
class ConcreteCreator1 extends Creator {
    // Implementación del factory method para crear un ConcreteProduct1
    public function factoryMethod(): Product {
        return new ConcreteProduct1();
    }
}

// Concrete Creator 2 (Creador Concreto 2)
class ConcreteCreator2 extends Creator {
    // Implementación del factory method para crear un ConcreteProduct2
    public function factoryMethod(): Product {
        return new ConcreteProduct2();
    }
}

// Product Interface (Interfaz de Producto)
interface Product {
    public function operation(): string;
}

// Concrete Products (Productos Concretos)
class ConcreteProduct1 implements Product {
    public function operation(): string {
        return "{Resultado de ConcreteProduct1}";
    }
}
class ConcreteProduct2 implements Product {
    public function operation(): string {
        return "{Resultado de ConcreteProduct2}";
    }
}

// Código cliente que utiliza el Creator para obtener objetos Product
function clientCode(Creator $creator) { // Aunque solicita un Creator, los hijos de Creator (ConcreteCreator1 y ConcreteCreator2) pueden ser utilizados, ya que ambos implementan el factory method.
    echo "Cliente: No conozco la clase del creador, pero aún así puedo usar su código.\n" . $creator->someOperation();  // Ejecución de someOperation() de la clase Creator, pero se ejecuta el factoryMethod() de las clases hijas (ConcreteCreator1 y ConcreteCreator2) que crean los objetos (ConcreteProduct1 y ConcreteProduct2) que implementan la interfaz Product.
}



echo "73.2.1 EJECUCIÓN DEL EJEMPLO\n\n";

echo "Ejecutando con ConcreteCreator1:\n";
clientCode(new ConcreteCreator1());

echo "\n\nEjecutando con ConcreteCreator2:\n";
clientCode(new ConcreteCreator2());



echo "73.2.2 EXPLICACIÓN MÍA\n\n";
echo "La función clientCode solicita un objeto de tipo Creator que se almacenará en \$creator.
Pero Creator es de tipo abstract, por lo que:
a) No se puede instanciar un objeto de tipo Creator, 
b) pero si se puede instanciar sus hijos que heredan el tipo Creator de la clase padre.
Por tanto, el objeto que se pasará serán los hijos de la clase abstracta Creator,
que son del tipo solicitado Creator.
Ahora, una vez pasado CUALQUIER objeto de una clase hija, 
se solicita que se ejecute someOperation() del objeto almacenado en \$creator (\$creator->someOperation()). 
Sin embargo, someOperation() no está implementado en ninguna clase hija,
así que se ejecuta de la clase padre abstracta Creator.
Entonces, la función someOperation() ejecuta factoryMethod() y lo almacena en \$product.
En este punto, NO se ejecuta el factoryMethod() de la clase padre Creator (es abstracta, no se puede ejecutar),
sino los factoryMethod() de las clases hijas
que implica la creación (constructor) de ConcreteProduct1() y ConcreteProduct2()
que implementa la interfaz Product. 
Una vez almacenado en \$product, se solicita al objeto que implementa la interfaz Product que ejecute su método operation().
La función operation() devuelve una cadena.
Finalmente la función someOperation() devuelve la cadena concatenada.\n\n";



echo "\n\n\n73.5 RESUMEN FINAL\n\n";

echo "El patrón Factory Method:
Es un patrón de diseño creacional que proporciona una interfaz para crear objetos en una superclase, 
pero permite a las subclases alterar el tipo de objetos que se crearán."; 

echo "El Factory Method permite que el código sea extensible pero no modificable: 
si quiero un nuevo producto, solo añado clases nuevas; no toco las que ya funcionan.";

echo "\n\n\n73.6 EJERCICIO\n\n";
echo "Crea un sistema de notificaciones que pueda enviar mensajes a través de diferentes canales (email, SMS, push notifications) utilizando el patrón Factory Method.\n";



