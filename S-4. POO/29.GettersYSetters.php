<?php
// Variables globales
$fechaHoraObjecto = new DateTime();
$fechaHoraCadena = $fechaHoraObjecto->format('d/m/Y H:i');
$totalPedidos = 0;

class pedido    // CLASE PADRE
{
    // PROPIEDADES DE LA CLASE PADRE: Recuerda que no se recomienda usar propiedades públicas
    private int $IdPedido;
    private string $fechaHoraPedido;
    private array $productos;
    private float $total;
    private static int $cantidadPedidos = 0;    // Inicialización de la cantidad de pedidos

    // MÉTODOS DE LA CLASE PADRE:


    // MÉTODOS GETTER Y SETTER
    public function getIdPedido(): int
    {
        return $this->IdPedido;
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
    
    // MÉTODOS PÚBLICOS PARA ACCEDER A MÉTODOS PRIVADOS


    // Constructor EXPLÍCITO: Se define como un método con la palabra reservada __construct
    public function __construct(int $IdPedido, $fechaHoraCadena, array $productos, float $total)
    {
        $this->IdPedido = $IdPedido;
        $this->fechaHoraPedido = $fechaHoraCadena;
        $this->productos = $productos;
        $this->total = $total;
        self::$cantidadPedidos++;
    }

    // Destructor EXPLÍCITO: Se define como un método con la palabra reservada __destruct
    public function __destruct()
    {

    }
}

// Ejemplo de uso
$pedido1 = new pedido(0, $fechaHoraCadena, ["hamburguesa" => 1, "papas" => 1, "refresco" => 1], 75.0);
$totalPedidos += $pedido1->getTotal();
sleep(90);  // La función sleep(int $seconds) retrasa la ejecución del programa durante el número entero de segundos ingresados a la función
$pedido2 = new pedido(1, $fechaHoraCadena, ["hamburguesa" => 2, "papas" => 2], 100.0);
$totalPedidos += $pedido2->getTotal();
sleep(60);  // La función sleep(int $seconds) retrasa la ejecución del programa durante el número entero de segundos ingresados a la función
$pedido3 = new pedido(2, $fechaHoraCadena, ["hamburguesa" => 2, "papas" => 2, "refresco" => 1], 150.0);
$totalPedidos += $pedido3->getTotal();

echo "Se ha realizado " . self::$cantidadPedidos . " pedidos.";
echo "El total del ticket es de " . $totalPedidos;
