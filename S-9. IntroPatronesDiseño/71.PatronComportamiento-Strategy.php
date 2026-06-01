<?php
header("Content-Type: text/plain");

echo "71. PATRONES DE DISEÑO: COMPORTAMIENTO - STRATEGY\n\n";

echo "71.1 ¿QUÉ ES EL PATRÓN STRATEGY?\n\n";

echo "El patrón Strategy (Estrategia) es un patrón de diseño de comportamiento
que permite definir una familia de algoritmos, encapsular cada uno de ellos
y hacerlos intercambiables.\n\n";

echo "El patrón Strategy permite que el algoritmo varíe independientemente
de los clientes que lo utilizan.\n\n\n";



echo "71.2 ESTRUCTURA DEL PATRÓN STRATEGY\n\n";

echo "El patrón Strategy consta de los siguientes componentes principales:\n";
echo "1. iStrategy (Estrategia): Una interfaz común para todos los algoritmos.
Define un método que todas las estrategias concretas deben implementar.\n";
echo "2. Concrete Strategies (Estrategias Concretas): Clases que implementan
la interfaz Strategy y proporcionan implementaciones específicas de los algoritmos.\n";
echo "3. Context (Contexto): Una clase que utiliza una instancia de Strategy
para ejecutar el algoritmo. El Contexto mantiene una referencia a una Strategy
y puede cambiarla en tiempo de ejecución.\n\n\n";



echo "71.3 CUÁNDO UTILIZAR EL PATRÓN STRATEGY\n\n";
echo "El patrón Strategy es útil en las siguientes situaciones:\n";
echo "1. Cuando se tienen múltiples algoritmos para una tarea específica
y se desea seleccionar uno en tiempo de ejecución.\n";
echo "2. Cuando se desea evitar el uso de múltiples condicionales
para seleccionar un algoritmo.\n";
echo "3. Cuando se desea encapsular algoritmos para facilitar su mantenimiento
y extensión.\n\n\n";



echo "71.4 EJEMPLO DE IMPLEMENTACIÓN EN PHP\n\n";

echo  <<<'CODE'
// Interfaz Strategy
interface iStrategy {
    public function execute(int $a, int $b): int;
}   

// Estrategía concreta: Suma
class AdditionStrategy implements Strategy {
    public function execute(int $a, int $b): int {
        return $a + $b;
    }
}

// Estrategía concreta: Resta
class SubtractionStrategy implements Strategy {
    public function execute(int $a, int $b): int {
        return $a - $b;
    }
}

class Context {
    private Strategy $strategy;

    public function __construct(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy): void {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $a, int $b): int {
        return $this->strategy->execute($a, $b);
    }
}

$context = new Context(new AdditionStrategy());
echo "\n\nResultado de la suma: " . $context->executeStrategy(10, 5) . "\n"; 

$context->setStrategy(new SubtractionStrategy());
echo "\n\nResultado de la resta: " . $context->executeStrategy(10, 5) . "\n";
CODE;

echo "\n\n\n";


echo "71.4.1 Ejecución del ejemplo\n\n";

// Interfaz Strategy
interface Strategy {
    // Firma de la función que todas las estrategias concretas deben implementar
    public function execute(int $a, int $b): int;
}   

// Estrategía concreta #1: Suma
class ConcreteStrategyAddition implements Strategy {
    // Implementación del método execute() definido en la interfaz Strategy
    public function execute(int $a, int $b): int {
        return $a + $b;
    }
}

// Estrategía concreta #2: Resta
class ConcreteStrategySubtraction implements Strategy {
    // Implementación del método execute() definido en la interfaz Strategy
    public function execute(int $a, int $b): int {
        return $a - $b;
    }
}

// Contexto
class Context {
    private Strategy $strategy;

    public function __construct(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy): void {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $a, int $b): int {
        return $this->strategy->execute($a, $b);
    }
}

// Se crea una instancia de ConcreteStrategyAddition para su reutilización futura
$estrategiaSuma = new ConcreteStrategyAddition();

// Se crea una instancia de ConcreteStrategySubstraction para su reutilización futura
$estrategiaResta = new ConcreteStrategySubtraction();

// Se crea una instancia de Context con el argumento de la estrategia de suma establecido por el constructor
echo "Creando el contexto con la estrategia de suma...\n";
$context = new Context(strategy:$estrategiaSuma);

// Se ejecuta la estrategia de suma
echo "Resultado de la suma: " . $context->executeStrategy(10, 5) . "\n\n"; // Salida: 15

// Se cambia la estrategia a resta
echo "Cambiando la estrategia a resta...\n";
$context->setStrategy(strategy: $estrategiaResta);

// Se ejecuta la estrategia de resta
echo "Resultado de la resta: " . $context->executeStrategy(10, 5) . "\n\n"; // Salida: 5

// Se cambia la estrategia a resta
echo "Cambiando la estrategia a suma...\n";
$context->setStrategy(strategy: $estrategiaSuma);

// Se ejecuta la estrategia de suma nuevamente
echo "Resultado de una nueva suma: " . $context->executeStrategy(10, 5) . "\n"; // Salida: 15



echo "\n\n\n71.5 CONCLUSIÓN\n\n";

echo "El patrón Strategy es una herramienta poderosa para gestionar
algoritmos de manera flexible y escalable. Al encapsular los algoritmos
en clases separadas, permite cambiar el comportamiento de un objeto
en tiempo de ejecución sin modificar su código.\n\n";

echo "Este patrón es especialmente útil en situaciones donde se requiere
una variedad de algoritmos o comportamientos que pueden cambiar según
el contexto o las condiciones de ejecución.\n";

echo "Al implementar el patrón Strategy, se mejora la mantenibilidad
y la extensibilidad del código, facilitando la adición de nuevas
estrategias sin afectar a las existentes.\n\n\n\n";



echo "71.6 ENTENDIENDO EL CÓDIDO DE HÉCTOR DE LEÓN\n\n";

echo "El código proporcionado por Héctor de León implementa el patrón
Strategy en PHP de manera clara y efectiva. A continuación, se desglosan
los componentes clave del código:\n\n";


// Interfaz Strategy
interface iStrategy {
    // Firma de la función que todas las estrategias concretas deben implementar
    public function get(): array;
}

// Estrategía concreta #1: Array de Nombres
class ConcreteStrategyGetArray implements iStrategy {
    // Array de datos de ejemplo
    private array $data = 
    ["Héctor", "Juan", "María", "Ana"];
    
    // Implementación del método get() definido en la interfaz iStrategy
    public function get(): array {
        return $this->data;
        // return ["Héctor", "Juan", "María", "Ana"]; // Otra forma de hacerlo
    }
}

// Estrategía concreta #2: Array de https://jsonplaceholder.typicode.com/posts
class ConcreteStrategyGetURL implements iStrategy {
    // Atributos de la clase
    private string $url;

    public function __construct($url) {
        $this->url = $url;
    }

    // Implementación del método get() definido en la interfaz iStrategy
    public function get(): array {
        // Realiza una solicitud HTTP para obtener datos JSON
        $data = file_get_contents($this->url);
        // Decodifica el JSON en un array asociativo de PHP
        $array = json_decode($data, true);
        return array_map(fn($item) => $item["title"], $array);
    }
}

// Contexto
class ContextDataPrinter {
    private iStrategy $strategy;

    public function __construct(iStrategy $strategy) {
        $this->strategy = $strategy;
    }

    // Método para imprimir los datos utilizando la estrategia proporcionada
    public function print(): void {
        // Obtiene el contenido utilizando la estrategia proporcionada
        $content = $this->strategy->get();
        // Imprime cada elemento del array
        foreach ($content as $item) {
            echo $item . "\n";
        }
    }
}

// Creación de la estrategia concreta #1 para obtener el array de nombres
$estrategiaGetArray = new ConcreteStrategyGetArray();
// Creación de la estrategia concreta #2 para obtener datos desde una URL
$estrategiaGetURL = new ConcreteStrategyGetURL(url: "https://jsonplaceholder.typicode.com/posts");

// Creación del contexto con la estrategia de obtención de nombres
$contextPrinter = new ContextDataPrinter(strategy: $estrategiaGetURL);

echo "Imprimiendo datos:\n\n";
$contextPrinter->print();



echo "\n\n\n71.5 RESUMEN FINAL\n\n";



