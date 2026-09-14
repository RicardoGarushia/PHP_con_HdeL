<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "29. POO: Getters y Setters\n";
echo "======================================================================\n\n";

class Pedido
{
    private int $idPedido = 0;
    private string $fechaHoraPedido;
    private array $productos;
    private float $total;
    private static int $cantidadPedidos = 0;

    public function __construct(array $productos)
    {
        $idPedido = ++self::$cantidadPedidos;  // Operador pre-incremento. Primero se suma +1 a la variable y después se asigna.

        $this->setIdPedido($idPedido);
        $this->setFechaHoraActual();
        $this->setProductos($productos);
        $this->setTotal();
    }

    // --- GETTERS (Accesores) ---

    public function getIdPedido(): int
    {
        return $this->idPedido;
    }

    public function getFechaHoraPedido(): string
    {
        return $this->fechaHoraPedido;
    }

    public function getProductos(): array
    {
        return $this->productos;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public static function getCantidadPedidos(): int
    {
        return self::$cantidadPedidos;
    }

    // --- SETTERS (Mutadores con Validación) ---

    public function setIdPedido(int $idPedido): void
    {
        if ($idPedido < 0) {
            throw new InvalidArgumentException("El ID del pedido debe ser un entero positivo.");
        }
        $this->idPedido = $idPedido;
    }

    public function setProductos(array $productos): void
    {
        if (empty($productos)) {
            throw new InvalidArgumentException("Un pedido debe contener al menos un producto.");
        }
        $this->productos = $productos;
    }

    public function setTotal(): void
    {
        $total = 0;

        // Véase 017.Estructura-foreach.md para entender esta parte 
        foreach ($this->productos as $producto => $cantidad) {
            $precio = match ($producto) {
                "refrescos" => 25,
                "papas" => 35,
                "hamburguesas" => 60,
                default => throw new InvalidArgumentException("El producto '{$producto}' no es válido.")
            };
            $total += $precio * $cantidad; // Es lo mismo que: $total = $total + $precio * $cantidad;
        }

        if ($total <= 0) {
            throw new InvalidArgumentException("El total del pedido debe ser mayor a cero.");
        }

        $this->total = $total;
    }

    private function setFechaHoraActual(): void
    {
        $ahora = new DateTime();
        $this->fechaHoraPedido = $ahora->format('d/m/Y H:i:s');
    }


    /*
    public function agregarCantidadDeProducto(string $nombreProducto, int $cantidad): void
    {
        if ($cantidad <= 0) {
            throw new InvalidArgumentException("La cantidad a agregar debe ser un entero positivo.");
        }

        // Asigna el valor actual (o 0 si no existe) y le suma la nueva cantidad
        $this->productos[$nombreProducto] = ($this->productos[$nombreProducto] ?? 0) + $cantidad;

        $this->setTotal();
    } 

    public function sustituirCantidadDeProducto(string $nombreProducto, int $cantidad): void
    {
        if ($cantidad <= 0) {
            throw new InvalidArgumentException("La cantidad a agregar debe ser un entero positivo.");
        }
        
        // Asignación directa: reemplaza si existe o lo crea si no existe
        $this->productos[$nombreProducto] = $cantidad;
        
        // Actualizar el costo final.
        $this->setTotal();
    }
    */
}

// --- EJECUCIÓN ---
$pedido1 = new Pedido(["hamburguesas" => 2, "papas" => 4, "refrescos" => 4]);
echo "\nPedido #{$pedido1->getIdPedido()} registrado el {$pedido1->getFechaHoraPedido()} por $" . number_format($pedido1->getTotal(), 2) . "\n";
echo "Contiene: \n";
$productos = $pedido1->getProductos();

foreach ($productos as $clave => $valor) {
    echo "$clave: $valor\n";
}

$pedido2 = new Pedido(["hamburguesas" => 2, "papas" => 2]);
echo "\nPedido #{$pedido2->getIdPedido()} registrado el {$pedido2->getFechaHoraPedido()} por $" . number_format($pedido2->getTotal(), 2) . "\n";
echo "Contiene: \n";
$productos = $pedido2->getProductos();

foreach ($productos as $clave => $valor) {
    echo "$clave: $valor\n";
}


/*
$pedido1->agregarCantidadDeProducto("hamburguesas", 10);
echo "\nEl pedido #{$pedido1->getIdPedido()} registrado el {$pedido1->getFechaHoraPedido()} por $" . number_format($pedido1->getTotal(), 2) . "\n";
echo "Ahora contiene: \n";
$productos = $pedido1->getProductos();

foreach ($productos as $clave => $valor) {
    echo "$clave: $valor\n";
}

$pedido1->sustituirCantidadDeProducto("hamburguesas", 10);
echo "\nEl pedido #{$pedido1->getIdPedido()} registrado el {$pedido1->getFechaHoraPedido()} por $" . number_format($pedido1->getTotal(), 2) . "\n";
echo "Ahora contiene: \n";
$productos = $pedido1->getProductos();

foreach ($productos as $clave => $valor) {
    echo "$clave: $valor\n";
}
*/

echo "\nTotal de pedidos creados: " . Pedido::getCantidadPedidos() . "\n";
