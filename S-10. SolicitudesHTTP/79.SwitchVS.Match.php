<?php
// 1. CONFIGURACIÓN Y RUTAS: Aquí es donde configuras tu entorno, defines tus rutas y controlas el flujo de la aplicación según el método HTTP utilizado en la solicitud.
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.
$metodo = $_SERVER["REQUEST_METHOD"];   // Se utiliza la variable global $_SERVER sin declaración previa porque es una variable super-global predefinida por PHP que está disponible en todo el ámbito del programa.
header("Content-Type: text/plain");     // Esto es para que el navegador interprete la respuesta como texto plano y no como HTML, lo que facilita la lectura de los mensajes de error y depuración en la respuesta HTTP.

// 2. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
try {
    match ($metodo) {
        'GET'    => ejecutarLogicaGet(),
        'POST'   => ejecutarLogicaPost(),
        'PUT'    => ejecutarLogicaPut(),
        'DELETE' => ejecutarLogicaDelete(),
        default  => lanzarError405()
    };
} catch (UnhandledMatchError $e) {
    lanzarError405();
}

// 3. LÓGICA DE NEGOCIO: Aquí es donde va tu lógica de negocio para cada método HTTP.
function ejecutarLogicaGet() {
    procesarLectura();
}
function ejecutarLogicaPost() {
    procesarCreacion();
}
function ejecutarLogicaPut() {
    procesarActualizacion();
}
function ejecutarLogicaDelete() {
    procesarEliminacion();
}
function lanzarError405() {
    http_response_code(405);
    header("Allow: GET");
    exit("⚠️ Error 405: Método no permitido.");
}

// 4. FUNCIONES AUXILIARES: Aquí es donde defines tus funciones auxiliares para cada método HTTP, como procesarLectura(), procesarCreacion(), etc.
function procesarLectura() {
    echo "✅ La solicitud es de tipo GET. \nProcesando solicitud GET con estructura de control MATCH...\n";
}
function procesarCreacion() {
    echo "📩 La solicitud es de tipo POST. \nProcesando solicitud POST con estructura de control MATCH...\n";
}
function procesarActualizacion() {
    echo "🆙 La solicitud es de tipo PUT. \nProcesando solicitud PUT con estructura de control MATCH...\n";
}
function procesarEliminacion() {
    echo "🗑️ La solicitud es de tipo DELETE. \nProcesando solicitud DELETE con estructura de control MATCH...\n";
}


echo "MÉTODO DETECTADO: " . $_SERVER["REQUEST_METHOD"] . "\n\n\n\n"; 
echo "------------------------------------------\n\n";

echo "REPASANDO 74.7: PRIMERO LA LÓGICA Y DESPUÉS EL CONTENIDO ALV!\n\n";

echo "En PHP, al trabajar con solicitudes HTTP, es fundamental seguir una regla básica: 
PRIMERO debes procesar la lógica de la solicitud;
DESPUÉS enviar el contenido de la respuesta al cliente.\n\n";
echo "Esto se debe a que una vez que comienzas a enviar contenido al cliente (por ejemplo, 
con echo, espacio o cualquier otro elemento), ya no puedes modificar los encabezados HTTP ni el código de estado de la respuesta.
Por lo tanto, es importante asegurarse de que toda la lógica de procesamiento de la solicitud
se realice antes de enviar cualquier contenido al cliente para evitar errores y garantizar que la respuesta HTTP sea correcta y completa.\n\n";

echo "ESTE ES EL ÚLTIMO REPASO. ¡ASÍ QUE NO LO OLVIDES!\n\n\n\n"; 



echo "79.1. ESTRUCTURA DE CONTROL MATCH vs ESTRUCTURA DE CONTROL SWITCH\n\n";

echo "En PHP, la estructura de control SWITCH permite ejecutar diferentes bloques de código
dependiendo del valor de una expresión. Sin embargo, la estructura de control SWITCH 
tiene algunas limitaciones, como: 
1. La necesidad de usar break; para evitar la ejecución de casos posteriores 
2. la falta de soporte para comparaciones estrictas (===)
(Recuerda, PHP por defecto realiza conversiones de tipo de dato -tipado dinámico-).\n\n";

echo "La estructura de control MATCH, introducida en PHP 8.0, 
es más potente que la estructura de control SWITCH porque:
a) Devuelve un valor: Puedes asignar el resultado a una variable.
b) Comparación estricta (===): No hace conversiones de tipo de datos, lo que lo hace más seguro y predecible.
c) Sintaxis más limpia: No necesitas usar break, lo que reduce la posibilidad de errores y hace que el código sea más legible.\n\n";



echo "79.1.1 EJEMPLO DE USO DE LA ESTRUCTURA DE CONTROL match\n\n";

echo "<?php
// 1. CONFIGURACIÓN Y RUTAS: Configuración de entorno y control de flujo.
declare(strict_types=1);
\$metodo = \$_SERVER[\"REQUEST_METHOD\"];
header(\"Content-Type: text/plain\");

// 2. CONTROL DE RUTAS: Usando la estructura MATCH (PHP 8+)
try {
    match (\$metodo) {
        'GET'    => ejecutarLogicaGet(),
        'POST'   => ejecutarLogicaPost(),
        'PUT'    => ejecutarLogicaPut(),
        'DELETE' => ejecutarLogicaDelete(),
        default  => lanzarError405()
    };
} catch (UnhandledMatchError \$e) {
    lanzarError405();
}

// 3. LÓGICA DE NEGOCIO
function ejecutarLogicaGet() {
    procesarLectura();
}
function ejecutarLogicaPost() {
    procesarCreacion();
}
function ejecutarLogicaPut() {
    procesarActualizacion();
}
function ejecutarLogicaDelete() {
    procesarEliminacion();
}
function lanzarError405() {
    http_response_code(405);
    header(\"Allow: GET, POST, PUT, DELETE\");
    exit(\"⚠️ Error 405: Método no permitido.\");
}

// 4. FUNCIONES AUXILIARES
function procesarLectura() {
    echo \"✅ La solicitud es de tipo GET. \\nProcesando solicitud GET con estructura de control MATCH...\\n\";
}
function procesarCreacion() {
    echo \"📩 La solicitud es de tipo POST. \\nProcesando solicitud POST con estructura de control MATCH...\\n\";
}
function procesarActualizacion() {
    echo \"🆙 La solicitud es de tipo PUT. \\nProcesando solicitud PUT con estructura de control MATCH...\\n\";
}
function procesarEliminacion() {
    echo \"🗑️ La solicitud es de tipo DELETE. \\nProcesando solicitud DELETE con estructura de control MATCH...\\n\";
}

echo \"MÉTODO DETECTADO: \" . \$_SERVER[\"REQUEST_METHOD\"] . \"\\n\\n\\n\\n\"; 
echo \"------------------------------------------\";\n\n";

echo "En este ejemplo, 
se utiliza la variable global \$SERVER para obtener el método HTTP utilizado en la solicitud
y se utiliza la estructura de control match para dirigir el tráfico de la solicitud a diferentes funciones
que procesan la solicitud de acuerdo al método HTTP utilizado, 
lo que permite manejar diferentes tipos de solicitudes HTTP de manera adecuada en una aplicación web.\n\n\n\n";



echo "79.1.2 RESUMEN DE LA ESTRUCTURA DE CONTROL match\n\n";

echo "La estructura de control match en PHP 
es una herramienta poderosa y flexible 
para manejar múltiples casos de manera más eficiente y legible 
que el switch tradicional."; 

echo "Al utilizar match, los desarrolladores pueden escribir código más limpio y seguro, 
evitando errores comunes asociados con el switch, 
como olvidar un break o tener comparaciones no estrictas.
Además, el match permite asignar el resultado de la comparación a una variable, 
lo que facilita la gestión de casos complejos y la creación de aplicaciones web dinámicas y seguras.";