<?php
header("Content-Type: text/plain; charset=utf-8");

echo "\n======================================================================\n";
echo "3. INFRAESTRUCTURA Y CONFIGURACIÓN DEL ENTORNO\n";
echo "======================================================================\n\n";

echo "Para desarrollar aplicaciones robustas en PHP, es vital comprender la arquitectura 
cliente-servidor. El entorno de desarrollo mínimo requiere:\n\n";

echo "a) SERVIDOR WEB: Procesa las peticiones HTTP (por ejemplo, Apache, Nginx).\n";
echo "b) INTÉRPRETE DE PHP: El motor que procesa el código PHP del lado del servidor.\n";
echo "c) SGBD (Sistema de Gestión de Bases de Datos): Para la persistencia de datos (por ejemplo, MySQL, MariaDB, PostgreSQL).\n";
echo "d) IDE o EDITOR DE TEXTO: Herramienta de escritura y depuración de código.\n";
echo "e) NAVEGADOR WEB: El cliente que renderiza el resultado final de los scripts PHP.\n\n";


echo "\n======================================================================\n";
echo "3.1. STACKS DE DESARROLLO (PAQUETES TODO-EN-UNO)\n";
echo "======================================================================\n\n";

echo "Afortunadamente, existen diversas herramientas 'todo-en-uno' que facilitan esta configuración 
al integrar múltiples componentes esenciales como Apache, MySQL y PHP en un solo paquete:\n\n"; 

$stacks = [
    "XAMPP"    => "Multiplataforma. El más estándar. Incluye Apache, MariaDB (reemplazo de MySQL), PHP y Perl.",
    "LAMP"     => "Linux, Apache, MySQL/MariaDB, PHP. Ideal para servidores Linux y entornos de producción.",
    "Laragon"  => "Solo Windows. Altamente recomendado por ser ligero, portable y permitir gestionar 'Virtual Hosts' automáticamente.",
    "MAMP"     => "Originalmente para Mac, ahora multiplataforma. Muy intuitivo visualmente.",
    "EasyPHP"  => "Solo Windows. Fácil de usar, aunque menos popular que XAMPP.",
    "Docker"   => "Mención especial (Avanzado). Permite crear contenedores aislados, ideal para replicar entornos de producción exactos."
];

foreach ($stacks as $nombre => $desc) {
    echo "- $nombre: $desc\n";
}

echo "\nMi recomendación para principiantes es usar XAMPP o Laragon, dependiendo de tu sistema operativo y preferencias personales. 
Ambos son fáciles de instalar y configurar, y ofrecen un entorno completo para desarrollar aplicaciones PHP de manera eficiente.\n\n";


echo "\n======================================================================\n";
echo "3.2. HERRAMIENTAS DE CODIFICACIÓN (IDE vs EDITORES)\n";
echo "======================================================================\n\n";

echo "Para escribir código PHP, puedes optar por un IDE (Entorno de Desarrollo Integrado) o un editor de texto. 
Un IDE ofrece características como depuración integrada, autocompletado de código, gestión de proyectos y control de versiones, 
mientras que un editor de texto es más ligero y puede ser suficiente para proyectos pequeños o para quienes prefieren una interfaz más simple:\n\n";

echo "1. Visual Studio Code: El estándar actual. 
Es un editor ligero que, con las extensiones adecuadas (PHP Intelephense, PHP Debug), se comporta como un IDE potente.\n";
echo "2. PHPStorm: El IDE por excelencia para profesionales. 
Ofrece el análisis de código más profundo, aunque es de pago.\n";
echo "3. Sublime Text / Notepad++: Excelentes para ediciones rápidas de archivos únicos por su bajísimo consumo de recursos.\n\n";



echo "\n------------------------------------------------------\n";
echo "Consejo Pro #1: Usar XAMPP y Visual Studio Code para programar en PHP.";
echo "\n------------------------------------------------------\n\n";


echo "\n======================================================================\n";
echo "3.3. FLUJO DE TRABAJO RECOMENDADO\n";
echo "======================================================================\n\n";

echo "Para desarrollar en PHP, sigue este flujo de trabajo recomendado:
1. Instalación: Instalar XAMPP o Laragon.
2. Directorio Raíz: Los archivos deben guardarse en la carpeta 'htdocs' (XAMPP) o 'www' (Laragon).
3. Extensión: Todo archivo de script debe finalizar en '.php'.
4. Ejecución: No se abren haciendo doble clic en el archivo. 
    Se accede mediante 'http://localhost/nombre_archivo.php' en el navegador. 
    4.1. En caso de archivos dentro de carpetas, sólo se agregan las carpetas necesarias para llegar al archivo, es decir:
        'http://localhost/nombreCarpetaA/nombreCarpetaB/nombreCarpetaNecesarias/nombre_archivo.php'\n\n";


echo "\n------------------------------------------------------\n";
echo "Consejo Pro #2: Siempre verifica la versión de PHP en tu servidor local usando la función:\n\n";

echo <<<'EOD'
<?php
phpinfo();
?>
EOD;

echo "\n\nPara asegurar compatibilidad con librerías modernas.";
echo "\n------------------------------------------------------\n\n";

echo "\n------------------------------------------------------\n";
echo "Consejo Pro #3: Evitar usar extensiones tipo 'Live Server' para PHP. 
La práctica profesional consiste en guardar tus archivos en la carpeta 'htdocs' (o 'www') 
y acceder directamente mediante 'localhost/tu_archivo.php'.
Esto te acostumbra a trabajar como lo harás en un servidor real.";
echo "\n------------------------------------------------------\n";