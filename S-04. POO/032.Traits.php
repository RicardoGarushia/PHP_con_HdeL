<?php
declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "32. POO: Traits (Rasgos) y Reutilización Horizontal de Código\n";
echo "======================================================================\n\n";

// --- TRAITS ---
// Trait #1: Registro Login Cliente
trait RegistroLoginCliente 
{
    public function loginCliente(string $usuario, string $registroAcceso): void 
    {
        if (!file_exists($registroAcceso)) {    // Si el archivo no existe, lo creamos
            file_put_contents($registroAcceso, ""); // Creamos el archivo vacío
        }

        $logAcceso = file_get_contents($registroAcceso); // Leemos el contenido del archivo
        $logAcceso .= "{$usuario} se logueó el " . date("Y-m-d H:i:s") . "\n"; // Añadimos el usuario y la fecha de acceso
        file_put_contents($registroAcceso, $logAcceso); // Guardamos el contenido en el archivo

        echo "[LOG]: Registro de acceso guardado en {$registroAcceso}\n";
    }

    public function registrarCliente(string $usuario): void 
    {
        echo "[REGISTRO]: El cliente {$usuario} se ha registrado.\n";
        $this->loginCliente($usuario, "log_032.Traits_" . $usuario . ".txt");
    }
}

// Trait #2: Enviar Email
trait EnviarEmail 
{
    protected function enviarEmail(string $nombre): void 
    {
        echo "[EMAIL]: Notificación por correo enviada a {$nombre}\n";
    }
}

// Trait #3: Enviar Tarjeta Regalo
trait EnviarTarjetaRegalo 
{
    private const TARJETA_REGALO = 100.0;

    private function enviarTarjetaRegalo(string $nombre): void 
    {
        echo "[REGALO]: Tarjeta enviada a {$nombre} con valor de $" . self::TARJETA_REGALO . "\n";
    }
}

// --- CLASE CONSUMIDORA ---
class Cliente 
{
    private string $usuario;
    private string $contrasena;

    // Composición de múltiples traits
    use EnviarEmail, EnviarTarjetaRegalo, RegistroLoginCliente;

    public function __construct(string $usuario, string $contrasena)
    {
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;

        // Invocación de métodos aportados por los traits
        $this->enviarEmail($this->usuario);         // Protected
        $this->enviarTarjetaRegalo($this->usuario);  // Private
        $this->registrarCliente($this->usuario);    // Public
    }
}

// --- EJECUCIÓN ---

$cliente = new Cliente("Ricardo", "contrasena123");