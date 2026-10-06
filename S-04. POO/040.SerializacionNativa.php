<?php

declare(strict_types=1);

header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "40. POO y Web: Serialización Nativa de Objetos\n";
echo "======================================================================\n\n";

// --- 40.1 SERIALIZACIÓN NATIVA BÁSICA ---
echo "--- 40.1 Serialización y Deserialización Básica ---\n";

class ConfiguracionSistema
{
    public function __construct(
        public string $entorno,
        public bool $modoDepuracion,
        protected array $servidores
    ) {}
}

$config = new ConfiguracionSistema("producción", false, ["192.168.1.1", "192.168.1.2"]);

// Convierte el objeto completo (incluyendo visibilidades) en un string representativo de PHP
$stringSerializado = serialize($config);
echo "Objeto serializado (String nativo de PHP):\n$stringSerializado\n\n";

// Restaura la instancia del objeto en memoria
$configRestaurada = unserialize($stringSerializado);
echo "Objeto deserializado correctamente:\n";
var_dump($configRestaurada);
echo "\n";


// --- 40.2 MÉTODOS MÁGICOS __serialize() Y __unserialize() (PHP 7.4+ / 8.0+) ---
echo "--- 40.2 Personalización con __serialize() y __unserialize() ---\n";

class SesionUsuario
{
    private string $idSesion;

    public function __construct(
        public string $usuario,
        private string $tokenSecreto,
        private string $ipOrigen
    ) {
        $this->idSesion = bin2hex(random_bytes(8));
    }

    /**
     * Intercepta serialize() y devuelve únicamente un array asociativo con los datos a guardar.
     */
    public function __serialize(): array
    {
        return [
            'usr' => $this->usuario,
            'ip'  => $this->ipOrigen,
            // Omitimos $tokenSecreto e $idSesion por seguridad y caducidad
        ];
    }

    /**
     * Intercepta unserialize() y reconstruye el estado interno de la instancia.
     */
    public function __unserialize(array $data): void
    {
        $this->usuario = $data['usr'];
        $this->ipOrigen = $data['ip'];
        $this->tokenSecreto = "REGENERADO_TRAS_DESERIALIZACION";
        $this->idSesion = bin2hex(random_bytes(8)); // Genera un nuevo ID al deserializar
    }

    public function obtenerResumen(): string
    {
        return "Usuario: {$this->usuario} | IP: {$this->ipOrigen} | Token: {$this->tokenSecreto}";
    }
}

$sesion = new SesionUsuario("rgarcia", "secret_token_999", "127.0.0.1");
$sesionSerializada = serialize($sesion);

echo "Sesión serializada con filtro de atributos:\n$sesionSerializada\n\n";

$sesionRestaurada = unserialize($sesionSerializada);
echo "Estado de la sesión tras unserialize():\n";
echo $sesionRestaurada->obtenerResumen() . "\n\n";


// --- 40.3 SEGURIDAD EN DESERIALIZACIÓN (allowed_classes) ---
echo "--- 40.3 Inyección de Objetos y Deserialización Segura ---\n";

// Opción recomendada: Restringir qué clases se permite instanciar al deserializar
$objetoSeguro = unserialize($sesionSerializada, [
    'allowed_classes' => [SesionUsuario::class] // Solo permite instancias de esta clase
]);

echo "Objeto deserializado de forma segura (Clase permitida): " . get_class($objetoSeguro) . "\n";

// Si se deshabilita la instanciación de clases, devuelve stdClass o __PHP_Incomplete_Class
$objetoIncompleto = unserialize($sesionSerializada, [
    'allowed_classes' => false // No instanciar ninguna clase personalizada
]);

echo "Objeto deserializado con allowed_classes = false: " . get_class($objetoIncompleto) . "\n";