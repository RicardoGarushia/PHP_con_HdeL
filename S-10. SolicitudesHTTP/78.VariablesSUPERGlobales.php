<?php
// 1. CONFIGURACIÓN Y RUTAS: Aquí es donde configuras tu entorno, defines tus rutas y controlas el flujo de la aplicación según el método HTTP utilizado en la solicitud.
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.
$metodo = $_SERVER["REQUEST_METHOD"];   // Se utiliza la variable global $_SERVER sin declaración previa porque es una variable super-global predefinida por PHP que está disponible en todo el ámbito del programa.
header("Content-Type: text/plain");     // Esto es para que el navegador interprete la respuesta como texto plano y no como HTML, lo que facilita la lectura de los mensajes de error y depuración en la respuesta HTTP.

// 2. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
// Si decides mantener todo el código en un solo archivo (válido ÚNICAMENTE para proyectos pequeños)
// NO uses IF-ELSE anidados con todo el código adentro, NI una estructura SWITCH.  
// En la siguiente clase "79.SwitchVS.Match.php" se aborda una mejor estructura: 
// la estructura de control MATCH (introducida en PHP 8.0). 
// En este único ejemplo, se utiliza la estructura SWITCH para retomar las estructuras de control de clases previas 
switch ($metodo) {
    case 'GET':
        // Aquí va el demás código específico para GET que puedes 
        // a) incrustarlo directamente o
        // b) meterlo en otras funciones    -RECOMENDADO-
        procesarLectura();  // Invocas a la función procesarLectura()
        break;
    case 'POST':
        // Aquí va el demás código específico para POST que puedes 
        // a) incrustarlo directamente o
        // b) meterlo en otras funciones    -RECOMENDADO-
        procesarCreacion(); // Invocas a la función procesarCreacion()
        break;
    case 'PUT':
        // Aquí va el demás código específico para PUT que puedes 
        // a) incrustarlo directamente o
        // b) meterlo en otras funciones    -RECOMENDADO-
        procesarActualizacion();    // Invocas a la función procesarActualizacion()
        break;
    case 'DELETE':
        // Aquí va el demás código específico para DELETE que puedes 
        // a) incrustarlo directamente o
        // b) meterlo en otras funciones    -RECOMENDADO-
        procesarEliminacion();  // Invocas a la función procesarEliminacion()
        break;
    default:
        // http_response_code() se utiliza para establecer el código de estado HTTP de la respuesta que se enviará al cliente. 
        http_response_code(405);    // Cambiamos el código de estado a 405 METHOD NOT ALLOWED
        header("Allow: GET, POST, PUT, DELETE");    // Indicamos los métodos HTTP permitidos (allow)
        echo "⚠️ Error 405: Método no permitido. \n\n";  // Mensaje para el cliente
        // exit;   // Detenemos la ejecución porque no hay nada más que procesar. 
        echo "Por cuestiones didácticas, estará desactivado el exit para que puedas ver el mensaje de error 405, pero en un proyecto real, lo ideal es detener la ejecución porque no hay nada más que procesar.\n\n";
        break; 
}

// 3. FUNCIONES AUXILIARES: Aquí es donde defines tus funciones auxiliares para cada método HTTP, como procesarLectura(), procesarCreacion(), etc.
function procesarLectura() {
    echo "✅ La solicitud es de tipo GET. \nProcesando solicitud GET con la estructura de control switch (mejor usar match)...\n";
}
function procesarCreacion() {
    echo "📩 La solicitud es de tipo POST. \nProcesando solicitud POST con la estructura de control switch (mejor usar match)...\n";
}
function procesarActualizacion() {
    echo "🆙 La solicitud es de tipo PUT. \nProcesando solicitud PUT con la estructura de control switch (mejor usar match)...\n";
}
function procesarEliminacion() {
    echo "🗑️ La solicitud es de tipo DELETE. \nProcesando solicitud DELETE con la estructura de control switch (mejor usar match)...\n";
}

echo "MÉTODO DETECTADO: " . $_SERVER["REQUEST_METHOD"] . "\n\n\n\n"; 
echo "------------------------------------------\n\n";

echo "REPASANDO 74.7: PRIMERO LA LÓGICA Y DESPUÉS EL CONTENIDO ALV!\n\n";

echo "En PHP, al trabajar con solicitudes HTTP, es fundamental seguir una regla básica: 
PRIMERO debes procesar la lógica de la solicitud;
DESPUÉS enviar el contenido de la respuesta al cliente.\n\n";

echo "Esto se debe a que una vez que comienzas a enviar contenido al cliente 
(por ejemplo, con echo, espacio o cualquier otro elemento), 
ya no puedes modificar los encabezados HTTP ni el código de estado de la respuesta.
Por lo tanto, es importante asegurarse de que toda la lógica de procesamiento de la solicitud
se realice antes de enviar cualquier contenido al cliente para evitar errores y garantizar que la respuesta HTTP sea correcta y completa.\n\n\n\n";



echo "78. VARIABLES SUPER-GLOBALES VS. VARIABLES GLOBALES (VARIABLES LOCALES EN 13.FUNCIONES.php)\n\n";

echo "78.1 VARIABLES SUPER-GLOBALES\n\n";

echo "En PHP, las VARIABLES SUPER-GLOBALES son VARIABLES PREDEFINIDAS en PHP que ESTÁN DISPONIBLES EN TODOS LOS ÁMBITOS (scopes) de un script. 
Es decir, NO son declaradas por el programador, sino que ya fueron creadas por el lenguaje PHP y están disponibles para su uso en cualquier parte del código (funciones, clases o archivos) sin necesidad de realizar ninguna declaración.\n\n"; 

echo "PHP utiliza las VARIABLES SUPER-GLOBALES principalmente para recibir información del servidor, del entorno o del usuario.\n\n"; 

echo "Las VARIABLES SUPER-GLOBALES son:

a) \$_SERVER: Información sobre el entorno del servidor y la ejecución del script.
b) \$_GET: Datos enviados a través de la URL.
c) \$_POST: Datos enviados a través de un formulario HTTP.
d) \$_SESSION: Variables de sesión almacenadas en el servidor.
e) \$_COOKIE: Datos almacenados en el navegador del cliente.
f) \$_FILES: Datos de archivos subidos a través de un formulario HTTP.
g) \$_ENV: Variables de entorno del servidor. A veces hay que configurar el archivo php.ini para que PHP \"lea\" las variables del sistema operativo.
h) \$_REQUEST: Combina datos de \$_GET, \$_POST y \$_COOKIE. Evítala por cuestiones de seguridad y claridad.
i) \$GLOBALS (Sin guión bajo): Acceso a todas las variables globales del script.\n\n\n\n";



echo "78.2 VARIABLES GLOBALES\n\n";

echo "En PHP, las VARIABLES GLOBABLES son VARIABLES DECLARADAS fuera de cualquier función o clase, 
que están disponibles en todo el ámbito del script. 
Es decir, SON CREADAS POR EL PROGRAMADOR y pueden ser accedidas y modificadas 
desde cualquier parte del código, incluyendo funciones, clases y archivos incluidos, 
con el propósito de mantener el estado de la aplicación a lo largo de la ejecución del script.\n\n"; 

echo "El programador declara VARIABLES GLOBALES principalmente para 
almacenar información que necesita ser compartida entre diferentes partes del código.\n\n"; 

echo "En resumen, la principal diferencia entre VARIABLES SUPER-GLOBALES y VARIABLES GLOBALES es
que las primeras son predefinidas por PHP y están disponibles en todo el ámbito del programa sin necesidad de declaración, 
mientras que las segundas son creadas por el programador y también están disponibles en todo el ámbito del programa, 
pero requieren ser declaradas explícitamente por el programador para su uso.\n\n\n\n";



echo "78.3 VARIABLES LOCALES\n\n";

echo "En PHP, las VARIABLES LOCALES son VARIABLES DECLARADAS dentro de una función o método,
que solo están disponibles dentro de esa función o método. 
Es decir, SON CREADAS POR EL PROGRAMADOR y solo pueden ser accedidas y modificadas dentro del ámbito de la función o método donde fueron declaradas,
lo que permite encapsular la lógica y evitar conflictos de nombres con otras partes del código.\n\n";

echo "Las VARIABLES LOCALES se utilizan principalmente para almacenar información que solo es relevante dentro de una función o método específico,
lo que ayuda a mantener el código organizado y evitar errores relacionados con el alcance de las variables.\n\n\n\n";



echo "78.4 EXPLICACIÓN DE LA VARIABLE SUPER-GLOBAL \$SERVER\n\n";

echo "En PHP, la VARIABLE SUPER-GLOBAL\$SERVER es un array asociativo 
que contiene información sobre el servidor y el entorno de ejecución."; 

echo "Esta variable se utiliza comúnmente para acceder a información como:

a) El método HTTP utilizado (GET, POST, etc.) para procesar la solicitud de manera adecuada.
b) La URL solicitada para determinar qué recurso o página se está solicitando.
c) Los encabezados de la solicitud para obtener información adicional sobre la solicitud, como el tipo de contenido, la autenticación, etc.
d) La dirección IP del cliente para fines de seguridad, análisis o personalización de la respuesta.
e) El agente de usuario (navegador) del cliente para adaptar la respuesta según el tipo de dispositivo o navegador utilizado.
f) La hora de la solicitud para fines de registro o análisis de tráfico.
g) Y otros datos relacionados con la solicitud HTTP realizada por el cliente.\n\n";

echo "Puede utilizar: 
<?php
print_r(\$_SERVER) 
?>\n\n"; 

echo "Para imprimir la variable global \$SERVER de manera legible, 
lo que muestra toda la información contenida en la variable global \$SERVER:\n\n"; 

echo "O si gusta volverlo un json utilice: 
<?php 
json_encode(\$_SERVER, JSON_PRETTY_PRINT) 
?>\n\n"; 

echo "Para imprimir la variable global \$SERVER como un json de manera legible.\n\n";

echo "La variable \$SERVER es esencial para manejar solicitudes HTTP en PHP
y permite a los desarrolladores acceder a información importante sobre la solicitud
y el entorno del servidor para procesar y responder adecuadamente a las solicitudes de los clientes en la web.\n\n\n\n";



echo "79.4.1 EJEMPLO DE USO DE LA VARIABLE GLOBAL \$SERVER\n\n";

echo "Ejemplo de cómo procesar la solicitud de acuerdo al método HTTP utilizado en la solicitud:\n\n";

echo "<?php
// 1. CONFIGURACIÓN Y RUTAS: Aquí es donde configuras tu entorno, defines tus rutas y controlas el flujo de la aplicación según el método HTTP utilizado en la solicitud.
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.
\$metodo = \$_SERVER[\"REQUEST_METHOD\"];   // Se utiliza la variable global \$SERVER sin declaración previa porque es una variable super-global predefinida por PHP que está disponible en todo el ámbito del programa.
header(\"Content-Type: text/plain\");   // Esto es para que el navegador interprete la respuesta como texto plano y no como HTML, lo que facilita la lectura de los mensajes de error y depuración en la respuesta HTTP.

// 2. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
// Si decides mantener todo el código en un solo archivo (válido ÚNICAMENTE para proyectos pequeños)
// NO uses IF-ELSE anidados con todo el código adentro, NI una estructura SWITCH.  
// En la siguiente clase \"79.SwitchVS.Match.php\" se aborda una mejor estructura:  
// la estructura de control MATCH (introducida en PHP 8.0).
// En este único ejemplo, se utiliza la estructura SWITCH para retomar las estructuras de control de clases previas
switch (\$metodo) {
    case 'GET':
        // Aquí va el demás código específico para GET que puedes 
        // a) incrustarlo directamente o
        // b) meterlo en otras funciones    -RECOMENDADO-
        procesarLectura();
        break;
    case 'POST':
        // Aquí va el demás código específico para POST que puedes 
        // a) incrustarlo directamente o
        // b) meterlo en otras funciones    -RECOMENDADO-
        procesarCreacion();
        break;
    case 'PUT':
        // Aquí va el demás código específico para PUT que puedes 
        // a) incrustarlo directamente o
        // b) meterlo en otras funciones    -RECOMENDADO-
        procesarActualizacion();
        break;
    case 'DELETE':
        // Aquí va el demás código específico para DELETE que puedes 
        // a) incrustarlo directamente o
        // b) meterlo en otras funciones    -RECOMENDADO-
        procesarEliminacion();
        break;
    default:
        // http_response_code() se utiliza para establecer el código de estado HTTP de la respuesta que se enviará al cliente.
        http_response_code(405);    // Cambiamos el código de estado a 405 METHOD NOT ALLOWED
        header(\"Allow: GET, POST, PUT, DELETE\");  // Indicamos los métodos HTTP permitidos (allow)
        echo \"⚠️ Error 405: Método no permitido. \\n\\n\"; // Mensaje para el cliente
        break;
}

function procesarLectura() {
    echo \"✅ La solicitud es de tipo GET. \\n\";
}
function procesarCreacion() {
    echo \"📩 La solicitud es de tipo POST. \\n\";
}
function procesarActualizacion() {
    echo \"🆙 La solicitud es de tipo PUT. \\n\";
}
function procesarEliminacion() {
    echo \"🗑️ La solicitud es de tipo DELETE. \\n\";
}

echo \"MÉTODO DETECTADO: \" . \$_SERVER[\"REQUEST_METHOD\"] . \"\\n\";
echo \"------------------------------------------\";\n\n";

echo "En este ejemplo, 
se utiliza la variable global \$SERVER para obtener el método HTTP utilizado en la solicitud
y se utiliza junto una estructura de control SWITCH (aunque es mejor usar MATCH) 
para dirigir el tráfico de la solicitud a diferentes funciones
que procesan la solicitud de acuerdo al método HTTP utilizado,
lo que permite manejar diferentes tipos de solicitudes HTTP 
de manera adecuada en una aplicación web.\n\n";

echo "En la siguiente clase \"79.SwitchVSMatch.php\" se aborda una mejor estructura de control: 
la estructura de control MATCH (introducida en PHP 8.0), 
que es más concisa y legible que el switch, 
especialmente cuando se tienen múltiples casos a evaluar.\n\n\n\n"; 



echo "78.4.2 RESUMEN DE LA VARIABLE GLOBAL \$_SERVER\n\n";

echo "En resumen, la variable global \$SERVER es una herramienta fundamental en PHP
para manejar solicitudes HTTP y acceder a información importante sobre la solicitud
y el entorno del servidor, lo que permite a los desarrolladores crear aplicaciones web dinámicas y seguras.\n\n\n\n";



echo "78.4.3 EJECUCIÓN DE print_r(\$_SERVER)\n\n";

echo "Al ejecutar print_r(\$_SERVER), se muestra un array asociativo con toda la información contenida en la variable global \$SERVER,
que incluye datos como el método HTTP utilizado, la URL solicitada, los encabezados de la solicitud, la dirección IP del cliente, el agente de usuario, la hora de la solicitud
y otros datos relacionados con la solicitud HTTP realizada por el cliente.\n\n";

print_r($_SERVER);


echo "\n\n\n\n78.3.4 EJECUCIÓN DE json_encode(\$_SERVER, JSON_PRETTY_PRINT)\n\n";

echo "Lo mismo que print_r(\$_SERVER) pero en formato JSON legible, lo que facilita la lectura de la información contenida en la variable global \$SERVER.\n\n"; 

echo json_encode($_SERVER, JSON_PRETTY_PRINT);



echo "\n\n\n\n78.4 RESUMEN DE LAS VARIABLES SUPERGLOBALES Y GLOBALES\n\n";

echo "En resumen, las VARIABLES SUPER-GLOBALES son VARIABLES PREDEFINIDAS por PHP que están disponibles en todo el ámbito del programa sin necesidad de declaración,
mientras que las VARIABLES GLOBALES son VARIABLES DECLARADAS por el programador que también están disponibles en todo el ámbito del programa, 
pero requieren ser declaradas explícitamente por el programador para su uso.
Las VARIABLES SUPER-GLOBALES se utilizan principalmente para recibir información del servidor, del entorno o del usuario, 
mientras que las VARIABLES GLOBALES se utilizan para almacenar información que necesita ser compartida entre diferentes partes del código.
La variable global \$SERVER es una herramienta fundamental para manejar solicitudes HTTP en PHP y acceder a información importante
sobre la solicitud y el entorno del servidor, lo que permite a los desarrolladores crear aplicaciones web dinámicas y seguras.\n\n\n\n";
