<?php
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.

// header("Content-Type: text/plain");
header("Content-Type: application/json");


echo "119. COMPOSER\n\n";

echo "119.1. ¿QUÉ ES COMPOSER?\n\n";

echo "COMPOSER tiene dos funciones principales: 
1. Gestionar las dependencias para PHP.
2. Autoloading de tus clases.\n\n";

echo "COMPOSER como gestor de dependencias te permite manejar las bibliotecas y paquetes que tu proyecto necesita de manera sencilla y eficiente.
Con COMPOSER, puedes declarar las dependencias de tu proyecto en un archivo llamado composer.json,
y luego COMPOSER se encargará de descargar e instalar esas dependencias por ti -por ejemplo, cuando clonas un repositorio-.\n\n"; 

echo "COMPOSER como herramienta de autoloading implica cargar tus clases automáticamente sin tener que incluir manualmente cada archivo.
El archivo autoload.php es el responsable de este proceso.\n\n";

echo "Imagina COMPOSER como una distribuidora de materiales para construir tu casa, nada más que en este caso es tu proyecto PHP.
Así, podrías fabricar tus propios ladrillos, fundir el vidrio para las ventanas y talar árboles para hacer las puertas desde cero... pero tardarías años. 
Lo inteligente es ir a una distribuidora de materiales, pedir las ventanas con ciertas medidas, los ladrillos listos y las puertas terminadas.
Semejante a la distribuidora de materiales, 
COMPOSER te permite obtener las bibliotecas y paquetes que necesitas para tu proyecto sin tener que construirlos tú mismo desde cero.\n\n\n\n"; 


echo "119.2. ¿CÓMO INSTALAR COMPOSER?\n\n";

echo "Para instalar COMPOSER, puedes seguir los siguientes pasos:
1. Descarga el instalador de COMPOSER desde su sitio web oficial.
2. Ejecuta el instalador y sigue las instrucciones.
3. El instalador de Windows agregará automáticamente la ruta de instalación de COMPOSER a tu variable de entorno PATH.
4. Verifica la instalación ejecutando el comando 'composer --version' en tu terminal:
   4.1 Si aparece un mensaje indicando la versión instalada de COMPOSER. ¡Listo para usar!
   4.2 Si no aparece ningún mensaje o da error, es posible que la ruta de instalación de COMPOSER no esté correctamente agregada a tu variable de entorno PATH.\n\n\n\n";



echo "119.3. USO BÁSICO DE COMPOSER\n\n";

echo "Una vez instalado COMPOSER, puedes utilizarlo para gestionar las dependencias de tu proyecto.
Por ejemplo: 
a) Para crear un nuevo proyecto con COMPOSER, puedes ejecutar el comando 'composer init'.
b) Para instalar las dependencias de un proyecto existente, puedes ejecutar 'composer install'.
c) Para agregar una nueva dependencia, puedes ejecutar 'composer require proveedor/nombre-paquete'.
d) Para actualizar las dependencias, puedes ejecutar 'composer update'.\n\n\n\n";


