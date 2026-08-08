<?php
header("Content-Type: text/plain");

echo "\n39. NAMESPACE\n\n";

echo "NAMESPACE es un concepto fundamental en la programación moderna, especialmente en lenguajes como PHP.\n";
echo "Un namespace (espacio de nombres) es un mecanismo que encapsula y agrupa elementos (clases, interfaces, funciones y constantes) bajo un nombre único para evitar colisiones de nombres.\n";
echo "Permite organizar el código y facilita su mantenimiento.\n\n";

echo "Un namespace se define utilizando la palabra clave 'namespace' seguida del nombre del espacio de nombres.\n";
echo "Por convención, los nombres de los namespaces suelen seguir una estructura jerárquica similar a la de los directorios en un sistema de archivos.\n\n";

echo "En la carpeta 39.Namespace tienes dos subcarpetas:\n";
echo "- CarpetaA: contiene la clase Usuario y la función Similar().\n";
echo "- CarpetaB: contiene la función EvaluarAdulto() y otra función Similar().\n\n";

echo "Así puedes usar require_once para incluir los archivos y luego importar las clases y funciones con 'use':\n";
echo "require_once __DIR__ . '/CarpetaA/archivoAClase.php';\n";
echo "require_once __DIR__ . '/CarpetaB/archivoBFuncion.php';\n";
echo "use CarpetaA\\Usuario;\n";
echo "use function CarpetaB\\evaluarAdulto;\n\n";

require_once __DIR__ . '/CarpetaA/archivoAClase.php';
require_once __DIR__ . '/CarpetaB/archivoBFuncion.php';

use CarpetaA\Usuario;
use function CarpetaB\evaluarAdulto;

echo "Ejemplo de uso real:\n";
$objecto = new Usuario("Juan", "Camaney", true);
echo $objecto->saludar() . "\n";
echo evaluarAdulto(21) . "\n\n";

echo "Si tienes funciones con el mismo nombre en distintos namespaces, como Similar(), debes llamarlas usando el nombre completo del namespace:\n";
echo "echo CarpetaA\\Similar();\n";
echo "echo CarpetaB\\Similar();\n\n";

echo "Salida de las funciones Similar() de cada namespace:\n";
echo CarpetaA\Similar() . "\n";
echo CarpetaB\Similar() . "\n\n";

// Ejemplo de namespaces anidados
echo "39.1 Namespaces anidados\n";
echo "Puedes definir namespaces jerárquicos, por ejemplo:\n";
echo "namespace CarpetaA\\SubModulo;\n";
echo "class Herramienta {}\n\n";
echo "Y luego importar y usar así:\n";
echo "use CarpetaA\\SubModulo\\Herramienta; // La clase Herramienta vive en la categoría SubModulo, que a su vez está dentro de la categoría CarpetaA\n";
echo "\$herr = new Herramienta();\n\n";

// Ejemplo práctico (simulado, debes tener el archivo y clase real para que funcione):
// require_once __DIR__ . '/CarpetaA/SubModulo/Herramienta.php';
// use CarpetaA\SubModulo\Herramienta;  // La clase Herramienta vive en la categoría SubModulo, que a su vez está dentro de la categoría CarpetaA
// $herr = new Herramienta();
// echo $herr->usar();

echo "Esto permite organizar aún mejor tus módulos y evitar colisiones incluso en proyectos grandes.\n";

