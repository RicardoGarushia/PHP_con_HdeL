<?php
header("Content-Type: text/plain; charset=utf-8");

echo "======================================================================\n";
echo "22. POO: PROPIEDADES DE SOLO LECTURA (readonly) (PHP 8.1+)\n";
echo "======================================================================\n\n";

// --- DEFINICIÓN DE CLASE ---

class UsuarioInmutable {
    // Combinación de Promoción de Propiedades + Readonly + Visibilidad
    public function __construct(
        public readonly int $id,
        public readonly string $curp,
        private string $password
    ) {}

    public function getPassword(): string {
        return $this->password;
    }
}

// --- EJECUCIÓN ---

$usuario = new UsuarioInmutable(101, "GARL920815HDFRRR01", "MiPasswordSeguro");

echo "--- RESULTADOS EN CONSOLA ---\n";
echo "Acceso de lectura a propiedades 'public readonly' (Sin usar getters):\n";
echo "ID de Usuario: " . $usuario->id . "\n";
echo "CURP registrada: " . $usuario->curp . "\n";
echo "Contraseña (vía getter privado): " . $usuario->getPassword() . "\n\n";

// Intentar modificar una propiedad readonly lanzará un Error Fatal.
// Descomenta la siguiente línea para comprobar el error en consola:
// $usuario->id = 200;

echo "[INFO]: La propiedad \$id es 'public readonly'. Se lee directamente pero no se puede reasignar.";
