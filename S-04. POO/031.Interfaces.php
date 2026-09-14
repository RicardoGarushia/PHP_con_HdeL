<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "31. POO: Interfaces y Desacoplamiento\n";
echo "======================================================================\n\n";

// --- INTERFACES (Contratos) ---

// Definición de la interfaz EnviarDatos (Interfaz A) 
interface EnviarDatos 
{
    public function enviar(string $message): void;  // Obliga a implementar enviar()
}

// Definición de la interfaz GuardarDatos (Interfaz B) 
interface GuardarDatos 
{
    public function guardar(): void;    // Obliga a implementar guardar()
}

// --- CLASES IMPLEMENTADORAS ---

// CLASE IMPLEMENTADORA #1: Implementa ambas interfaces
class Servidor implements EnviarDatos, GuardarDatos 
{
    public function enviar(string $message): void 
    {
        echo "Se envía la venta del SERVIDOR al jefe\n" . $message . "\n";
    }

    public function guardar(): void 
    {
        echo "Se guarda la venta en el SERVIDOR\n";
    }
}

// CLASE IMPLEMENTADORA #2: Solo implementa GuardarDatos
class Nube implements GuardarDatos 
{
    public function guardar(): void 
    {
        echo "Se guarda la venta en LA NUBE\n";
    }
}

// CLASE IMPLEMENTADORA #3: Solo implementa EnviarDatos
class Email implements EnviarDatos 
{
    public function enviar(string $message): void 
    {
        echo "Se envía la venta por EMAIL al jefe\n" . $message . "\n";
    }
}

// --- CONSUMIDORES (Dependen de la abstracción) ---

// CLASE CONSUMIDORA #1: Exige un objeto que cumpla el contrato GuardarDatos
class ProcesadorDeDatos 
{
    // Propiedad que almacena una instancia de cualquier clase que implemente GuardarDatos
    private GuardarDatos $guardado;

    // Inyección de dependencias por Constructor
    public function __construct(GuardarDatos $procesoDeGuardado)
    {
        $this->guardado = $procesoDeGuardado;
    }

    public function procesar(): void 
    {
        echo "Procesando la información mediante la CLASE consumidora\n";
        $this->guardado->guardar();
    }
}

// FUNCIÓN CONSUMIDORA #1: Exige un objeto que cumpla el contrato GuardarDatos
function ProcesarDatos(GuardarDatos $objeto): void
{
    echo "Procesando la información mediante la FUNCIÓN consumidora\n";
    $objeto->guardar();
}

// --- EJECUCIÓN ---
$servidor = new Servidor(); // Instancia (objeto) de la clase Servidor que cumple con las implementaciones de las interfaces EnviarDatos y GuardarDatos
$nube     = new Nube();     // Instancia (objeto) de la clase Nube que cumple con la implementación de la interfaz GuardarDatos
$email    = new Email();    // Instancia (objeto) de la clase Email que cumple con la implementación de la interfaz EnviarDatos

// Creación del objeto de la CLASE CONSUMIDORA ProcesadorDeDatos con Inyección de Dependencias 
// Funciona con $servidor o $nube.
// Pasar $email lanzará TypeError: Email no implementa la interfaz GuardarDatos.
$guardado = new ProcesadorDeDatos(procesoDeGuardado: $servidor);    // Intercalar entre $nube y $servidor. $email produce error por no tener implementado el método procesar() y no ser del tipo GuardarDatos
$guardado->procesar();

echo "\n----------------------------------------------------------------------\n";

// Ejecución de la FUNCIÓN CONSUMIDORA
// Funciona con $servidor o $nube.
// Pasar $email lanzará TypeError: Email no implementa la interfaz GuardarDatos.
ProcesarDatos(objeto: $nube);  // Intercalar entre $nube y $servidor. $email produce error por no tener implementado el método procesar() y no ser del tipo GuardarDatos