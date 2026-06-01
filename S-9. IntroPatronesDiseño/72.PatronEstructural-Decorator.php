<?php
header("Content-Type: text/plain");

echo "72. PATRONES DE DISEÑO: ESTRUCTURAL - DECORATOR\n\n";

echo "72.1 ¿QUÉ ES EL PATRÓN DECORATOR?\n\n";

echo "El patrón Decorator (Decorador) es un patrón de diseño estructural
que permite agregar funcionalidades a objetos individuales de manera dinámica,
sin afectar a otros objetos de la misma clase.\n\n";

echo "El patrón Decorator se basa en la composición en lugar de la herencia,
lo que permite extender el comportamiento de un objeto sin modificar su código.\n\n\n";



echo "72.2 ESTRUCTURA DEL PATRÓN DECORATOR\n\n";

echo "El patrón Decorator consta de los siguientes componentes principales:\n";
echo "1. iComponent (Componente): Una interfaz común para los objetos que pueden
ser decorados.\n";
echo "2. Concrete Component (Componente Concreto): Una clase que implementa
la interfaz Component y representa el objeto original que será decorado.\n";
echo "3. Decorator (Decorador): Una clase abstracta que implementa la interfaz
Component y contiene una referencia a un objeto Component. Actúa como una
envoltura para el objeto original.\n";
echo "4. Concrete Decorators (Decoradores Concretos): Clases que exti
ienden la clase Decorator y agregan funcionalidades adicionales al objeto
Component.\n\n\n";



echo "72.3 CUÁNDO UTILIZAR EL PATRÓN DECORATOR\n\n";
echo "El patrón Decorator es útil en las siguientes situaciones:\n";
echo "1. Cuando se desea agregar responsabilidades a objetos individuales
sin afectar a otros objetos de la misma clase.\n";
echo "2. Cuando se necesita extender el comportamiento de un objeto
de manera flexible y dinámica.\n";
echo "3. Cuando se desea evitar la creación de muchas subclases
para agregar nuevas funcionalidades.\n";



echo "72.4 EJEMPLO DE IMPLEMENTACIÓN EN PHP\n\n";

echo  <<<'CODE'
// Interfaz Componente
interface Component {
    public function operation(): string;
}

// Componente Concreto
class ConcreteComponent implements Component {
    public function operation(): string {
        return "Componente Concreto";
    }
}

// Decorador Abstracto
abstract class Decorator implements Component {
    protected Component $component;

    public function __construct(Component $component) {
        $this->component = $component;
    }

    public function operation(): string {
        return $this->component->operation();
    }
}

// Decorador Concreto A
class ConcreteDecoratorA extends Decorator {
    public function operation(): string {
        return "Decorador A(" . parent::operation() . ")";
    }
}

// Decorador Concreto B
class ConcreteDecoratorB extends Decorator {
    public function operation(): string {
        return "Decorador B(" . parent::operation() . ")";
    }
}

// Uso del patrón Decorator
$component = new ConcreteComponent();
echo "Componente Original: " . $component->operation() . "\n";
$decoratedA = new ConcreteDecoratorA($component);
echo "Después de aplicar Decorador A: " . $decoratedA->operation() .
    "\n";

$decoratedB = new ConcreteDecoratorB($decoratedA);
echo "Después de aplicar Decorador B: " . $decoratedB->operation() .
    "\n";
CODE;

echo "\n\n\n";

echo "71.3.1 Ejecución del ejemplo\n\n";
// Interfaz Componente
interface Component {
    public function operation(): string;
}

// Componente Concreto
class ConcreteComponent implements Component {
    public function operation(): string {
        return "Componente Concreto";
    }
}

// Decorador Abstracto
abstract class Decorator implements Component {
    protected Component $component;

    public function __construct(Component $component) {
        $this->component = $component;
    }

    public function operation(): string {
        return $this->component->operation();
    }
}

// Decorador Concreto A
class ConcreteDecoratorA extends Decorator {
    public function operation(): string {
        return "Decorador A(" . parent::operation() . ")";
    }
}

// Decorador Concreto B
class ConcreteDecoratorB extends Decorator {
    public function operation(): string {
        return "Decorador B(" . parent::operation() . ")";
    }
}
// Uso del patrón Decorator
$component = new ConcreteComponent();
echo "Componente Original: " . $component->operation() . "\n";
$decoratedA = new ConcreteDecoratorA($component);
echo "Después de aplicar Decorador A: " . $decoratedA->operation() .
    "\n";
$decoratedB = new ConcreteDecoratorB($decoratedA);
echo "Después de aplicar Decorador B: " . $decoratedB->operation() .
    "\n";



echo "\n\n\n72.5 RETO DE GEMINI\n\n";

// Interfaz Componente
interface Componente {
    public function operation(): float;
}

// Componente Concreto
class ComponenteConcreto implements Componente {
    public function operation(): float {
        return 10.0;
    }
}

// Decorador Abstracto
abstract class Decorador implements Componente {
    protected Componente $component;
    
    public function __construct(Componente $component) {
        $this->component = $component;
    }
    
    public function operation(): float {
        return $this->component->operation();
    }
}

// Decorador Concreto A
class DecoradorConcretoA extends Decorador {
    public function operation(): float {
        return parent::operation() + 2.0;
    }
}

// Decorador Concreto B
class DecoradorConcretoB extends Decorador {
    public function operation(): float {
        $precioConEnvio = parent::operation();
        return $precioConEnvio - (parent::operation() * .1);
    }
}

// Uso del patrón Decorator aplicando primero el DecoradorConcretoA (costo de envío) y luego el DecoradorConcretoB (descuento)
$component1 = new ComponenteConcreto(); // Se crea un primer componente original
echo "Precio Original: " . $component1->operation() . "\n";

$decoratedA1 = new DecoradorConcretoA($component1); // Aplicar Costo de Envío primero
echo "Después de aplicar Costo de Envío de $2 (DecoradorConcreto A): " . $decoratedA1->operation() . "\n";

$decoratedB1 = new DecoradorConcretoB($decoratedA1); // Luego Descuento
echo "Después de aplicar Descuento del 10% (DecoradorConcreto B): " . $decoratedB1->operation() . "\n\n\n";


// Uso del patrón Decorator en otro orden, aplicando primero el DecoradorConcretoB (descuento) y luego el DecoradorConcretoA (costo de envío)
echo "También es posible aplicar los decoradores en otro orden:\n";

$component2 = new ComponenteConcreto(); // Se crea un segundo componente original
echo "Precio Original: " . $component2->operation() . "\n";

$decoratedB2 = new DecoradorConcretoB($component2);     // Aplicar Descuento primero
echo "Después de aplicar Descuento del 10% (DecoradorConcreto B): " . $decoratedB2->operation() . "\n";

$decoratedA2 = new DecoradorConcretoA($decoratedB2);    // Luego Costo de Envío
echo "Después de aplicar Costo de Envío de $2 (DecoradorConcreto A): " . $decoratedA2->operation() . "\n\n\n\n";



echo "72.6 ENTENDIENDO EL CÓDIDO DE HÉCTOR DE LEÓN\n\n";

echo "El código proporcionado por Héctor de León implementa el patrón
Decorator en PHP de manera clara y efectiva al brindar:
a) un componente concreto llamado presupuesto
b) un decorador abstracto
c) dos decoradores concretos que agregan funcionalidades específicas
al presupuesto original. 
A continuación, se desglosan los componentes clave del código:\n\n";

// Interfaz BudgetInterface
interface BudgetInterface {
    public function cost(): float;
}

// Componente Concreto
class BasicBudget implements BudgetInterface {
    // Atributos de la clase
    private int $hours;
    private float $hourlyRate;
    
    // Constructor
    public function __construct(int $hours, float $hourlyRate) {
        $this->hours = $hours;
        $this->hourlyRate = $hourlyRate;
    }

    public function cost(): float {
        return $this->hours * $this->hourlyRate;
    }
}

// Decorador Abstracto
abstract class BudgetDecorator implements BudgetInterface {
    protected BudgetInterface $budget;

    public function __construct(BudgetInterface $budget) {
        $this->budget = $budget;
    }

    // Es un puente que delega la llamada al objeto decorado
    public function cost(): float {
        return $this->budget->cost();
    }
}


// Decorador Concreto A
class ForeignBudgetDecorator extends BudgetDecorator {
    const EXCHANGE_RATE = 1.5;
    
    public function cost(): float {
        // Agrega un 50% al costo original para presupuestos extranjeros
        return parent::cost() * self::EXCHANGE_RATE;
    }
}

// Decorador Concreto B
class FrequentCustomerBudgetDecorator extends BudgetDecorator {
    const DISCOUNT = 0.9;
    
    public function cost(): float {
        // Aplica un descuento del 10% para clientes frecuentes
        return parent::cost() * self::DISCOUNT;
    }
}

$basicBudget = new BasicBudget(3, 1500.0);
echo "Costo del presupuesto básico para 3 horas con un costo de $1500 la hora: $" . $basicBudget->cost() . "\n";

$foreignBudget = new ForeignBudgetDecorator($basicBudget);
echo "Costo del mismo presupuesto para cliente extranjero: $ " . $foreignBudget->cost() . "\n";

$frequentCustomerBudget = new FrequentCustomerBudgetDecorator($basicBudget);
echo "Costo del mismo presupuesto para cliente frecuente: $ " . $frequentCustomerBudget->cost() . "\n\n\n\n";


echo "72.7 RESUMEN FINAL\n\n";

echo "El patrón Decorator es una herramienta poderosa para agregar
funcionalidades a objetos de manera flexible y dinámica. 
EL OBJETO ORIGINAL PERMANECE INALTERADO. 
SE CREA UN NUEVO OBJETO PARA CADA DECORADOR (FUNCIONALIDAD) ADICIONAL.\n\n"; 

echo "El patrón Decorator permite mantener el código limpio y adherirse al principio de abierto/cerrado,
facilitando la extensión del comportamiento sin modificar el código existente.\n
Este patrón es especialmente útil cuando se desea agregar responsabilidades
a objetos individuales sin afectar a otros objetos de la misma clase.\n\n";

echo "Al utilizar el patrón Decorator, se mejora la mantenibilidad
y la extensibilidad del código, permitiendo combinar múltiples decoradores
de manera transparente y reutilizable.\n\n";