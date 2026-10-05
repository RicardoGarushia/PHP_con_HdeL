<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "34. POO: Polimorfismo basado en Interfaces\n";
echo "======================================================================\n\n";

/* --- INTERFAZ (El Contrato) ---
    * Define la firma obligatoria que cualquier entidad facturable o consultable debe cumplir.
*/
interface GetInfo
{
    public function getInfo(): string;
}

/* --- CLASES IMPLEMENTADORAS ---
    * Comparten campos de datos base ($nombre y $precioBase), pero procesan su salida de forma diferente.
*/

// Clase 1: Producto Físico (agrega gasto de envío)
class ProductoFisico implements GetInfo
{
    private string $nombre;
    private float $precioBase;
    private float $costoEnvio;

    public function __construct(string $nombre, float $precioBase, float $costoEnvio) {
        $this->nombre = $nombre;
        $this->precioBase = $precioBase;
        $this->costoEnvio = $costoEnvio;
    }

    public function getInfo(): string {
        $total = $this->precioBase + $this->costoEnvio;

        return "Producto Físico: {$this->nombre} | Base: $" . number_format($this->precioBase, 2) .
               " | Envío: $" . number_format($this->costoEnvio, 2) .
               " | Total: $" . number_format($total, 2) . "\n";
    }
}

// Clase 2: Producto Digital (aplica descuento)
class ProductoDigital implements GetInfo
{
    private string $nombre;
    private float $precioBase;
    private float $descuento;

    public function __construct(string $nombre, float $precioBase, float $descuento) {
        $this->nombre = $nombre;
        $this->precioBase = $precioBase;
        $this->descuento = $descuento;
    }

    public function getInfo(): string {
        $porcentajeDescuento = $this->precioBase * $this->descuento;
        $total = $this->precioBase - $porcentajeDescuento;

        return "Producto Digital: {$this->nombre} | Base: $" . number_format($this->precioBase, 2) .
               " | Descuento (" . ($this->descuento * 100) . "%): -$" . number_format($porcentajeDescuento, 2) .
               " | Total: $" . number_format($total, 2) . "\n";
    }
}

// Clase #3: Servicio de Suscripción (Multiplica la cuota base por la cantidad de meses)
class ServicioSuscripcion implements GetInfo
{
    private string $nombre;
    private float $precioBase;
    private int $meses;

    public function __construct(string $nombre, float $precioBase, int $meses)
    {
        $this->nombre = $nombre;
        $this->precioBase = $precioBase;
        $this->meses = $meses;
    }

    public function getInfo(): string
    {
        $total = $this->precioBase * $this->meses;

        return "Suscripción: {$this->nombre} | Cuota Mensual: $" . number_format($this->precioBase, 2) .
               " | Periodo: {$this->meses} mes(es)" .
               " | Total Plan: $" . number_format($total, 2) . "\n";
    }
}

/* --- FUNCIÓN CONSUMIDORA (Comportamiento Polimórfico): mostrarInformacion ---
     * Acepta cualquier objeto que implemente GetInfo.
     * No necesita saber si es físico, digital o suscripción; solo invoca el método del contrato.
*/
function mostrarInformacion(GetInfo $objeto): void
{
    echo "[DETALLE DE COMPRA]:\n";
    echo $objeto->getInfo() . "\n";
}

// --- EJECUCIÓN: Demostración polimórfica---
mostrarInformacion(new ProductoFisico("Teclado Mecánico RGB", 1200.00, 150.00));
mostrarInformacion(new ProductoDigital("Curso Completo de PHP 8", 800.00, 0.15));
mostrarInformacion(new ServicioSuscripcion("Hosting VPS Premium", 350.00, 12));

/** Recuerda que también puedes almacenar objetos en $variables y sólo pasar la $varible en la función consumidora
$teclado     = new ProductoFisico("Teclado Mecánico RGB", 1200.00, 150.00);
$cursoOnline = new ProductoDigital("Curso Completo de PHP 8", 800.00, 0.15);
$servidor    = new ServicioSuscripcion("Hosting VPS Premium", 350.00, 12);

// Demostración polimórfica
mostrarInformacion($teclado);
mostrarInformacion($cursoOnline);
mostrarInformacion($servidor);
*/


// ACTIVIDAD: Agrega una cuarta clase llamada `ProductoOferta` que reciba un precio base y un cupón de descuento de monto fijo.
// La clase ProductoOferta utiliza la Promoción de Propiedades en el Constructor (Constructor Property Promotion) {véase 21.3.2. Sintaxis Promocionada (PHP 8.0+)} 
// reduciendo la declaración e inicialización de $nombre, $precioBase y $cuponDescuento directamente en los parámetros del __construct().
class ProductoOferta implements GetInfo
{
    public function __construct(
        private string $nombre,
        private float $precioBase,
        private float $cuponDescuento
        )   {
            // El cuerpo del constructor puede quedar vacío
    }

    public function getInfo(): string
    {
        $total = $this->precioBase - $this->cuponDescuento;

        return "Producto Oferta: {$this->nombre} | Base: $" . number_format($this->precioBase, 2) .
               " | Cupón de Descuento: -$" . number_format($this->cuponDescuento, 2) .
               " | Total: $" . number_format($total, 2) . "\n";
    }
}
mostrarInformacion(new ProductoOferta("Mayonesa", 80.00, 20.00));
