<?php
// 1. CONFIGURACIÓN Y RUTAS: Aquí es donde configuras tu entorno, defines tus rutas y controlas el flujo de la aplicación según el método HTTP utilizado en la solicitud.
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.
$metodo = $_SERVER["REQUEST_METHOD"];   // Se utiliza la variable global $_SERVER sin declaración previa porque es una variable super-global predefinida por PHP que está disponible en todo el ámbito del programa.
header("Content-Type: text/plain");     // Esto es para que el navegador interprete la respuesta como texto plano y no como HTML, lo que facilita la lectura de los mensajes de error y depuración en la respuesta HTTP.
$camposRequeridos = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'nivel'];  // Definimos un array con los campos requeridos para la lectura, creación o modificación de un usuario, lo que nos permite validar de manera más flexible y escalable sin tener que modificar la lógica de validación cada vez que se agregue o elimine un campo requerido.

// 2. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
try {
    match ($metodo) {
        'GET' => ejecutarLogicaGet($camposRequeridos),
        // 'POST' => ejecutarLogicaPost(),  // Esto lo comentamos porque aún no lo hemos visto...
        // 'PUT' => ejecutarLogicaPut(),    // ...pero la idea es que cada método HTTP tenga su propia función con su propia lógica de negocio, 
        // 'DELETE' => ejecutarLogicaDelete(),  // y así mantener el código organizado y fácil de mantener.
        default => lanzarError405()
    };
} catch (UnhandledMatchError $e) {
    lanzarError405();
}

// 3. LÓGICA DE NEGOCIO: Porque aquí es donde va tu lógica de negocio para cada método HTTP.
function ejecutarLogicaGet(array $camposRequeridos)
{
    //  PASO 1 GET. VALIDAR PRESENCIA DEL PARÁMETRO (IDENTIFICADOR) EN LA URL (Guard Clause):
    verificarPresenciaCURP();

    //  PASO 2 GET. VALIDAR QUE EL PARÁMETRO (IDENTIFICADOR) NO ESTÉ VACÍO (Guard Clause):
    $curpIngresada = validarContenidoCURP();
    
    //  PASO 3 GET. VALIDAR REGLAS DE ACCESO (SIMULADO)
    verificarAutorizacionInicial();
    
    //  PASO 4 GET. SANITIZACIÓN DEL PARÁMETRO (IDENTIFICADOR):
    $curpIngresada = sanitizarCURP($curpIngresada);
    
    //  PASO 5 GET. VALIDAR FORMATO Y REQUISITOS TÉCNICOS DEL IDENTIFICADOR (Guard Clause): 
    $curpIngresada = validarFormatoCURP($curpIngresada);
    
    //  PASO 6. ESTABLECER CONEXIÓN CON LA PERSISTENCIA:
    $usuarios_db = cargarDatos();

    //  PASO 7 GET. VALIDAR DISPONIBILIDAD DE LA FUENTE DE DATOS (Guard Clause):
    validarDisponibilidadFuente($usuarios_db);
    
    //  PASO 8 GET. VALIDAR EXISTENCIA DEL RECURSO ESPECÍFICO (Guard Clause):
    validarExistenciaRecurso($usuarios_db, $curpIngresada);
    
    //  PASO 9 GET. EXTRACCIÓN, MAPEO Y VALIDACIÓN DE LECTURA (Guard Clause):
    $usuario = extraccionConValidacion($usuarios_db, $curpIngresada);

    //  PASO 10 GET. VALIDAR INTEGRIDAD DEL CONTENIDO EXTRAÍDO (Guard Clause):
    validarDatosExtraidosDelUsuario($usuario, $camposRequeridos);

    //  PASO 11 GET. FORMATEAR RESPUESTA Y ENTREGA
    responderExito($usuario);
}
function ejecutarLogicaPost()
{
    // Aquí va el demás código específico para POST que puedes 
    // a) incrustarlo directamente o
    // b) meterlo en otras funciones    -RECOMENDADO-
}
function ejecutarLogicaPut()
{
    // Aquí va el demás código específico para PUT que puedes 
    // a) incrustarlo directamente o
    // b) meterlo en otras funciones    -RECOMENDADO-
}
function ejecutarLogicaDelete()
{
    // Aquí va el demás código específico para DELETE que puedes 
    // a) incrustarlo directamente o
    // b) meterlo en otras funciones    -RECOMENDADO-
}
function lanzarError405()
{
    http_response_code(405);
    header("Allow: GET");   // Esto es para indicar al cliente qué métodos HTTP sí están permitidos en esta ruta, lo que es una buena práctica para mejorar la comunicación entre el cliente y el servidor.
    exit("⚠️ Error 405: Método no permitido.");
}

//  4. SERVICIO DE DATOS


//  5. FUNCIONES: Aquí abajo (o en otro archivo) defines las funciones

//  5.1 FUNCIONES GET

//  PASO 1 GET. VALIDAR PRESENCIA DEL PARÁMETRO (IDENTIFICADOR) EN LA URL (Guard Clause):
function verificarPresenciaCURP()
{
    // Verificamos la existencia del parámetro (identificador) en la superglobal (ej. isset(\$_GET['id'])).
    // Si el parámetro (identificador) NO está definido, se lanza un 400 Bad Request.
    if (!isset($_GET['curp'])) {
        http_response_code(400);
        exit("❌ Error 400: El parámetro 'curp' es requerido.");
    }
}

//  PASO 2 GET. VALIDAR QUE EL PARÁMETRO (IDENTIFICADOR) NO ESTÉ VACÍO (Guard Clause):
function validarContenidoCURP(): string
{
    // Garantizamos que el parámetro (identificador) enviado no sea una cadena vacía o solo espacios tras un trim().
    $curpLimpiado = strtoupper(trim($_GET['curp']));   // Limpieza estética básica (espacios y mayúsculas)

    // Si el dato está vacío, se lanza un 400 Bad Request.
    if (empty($curpLimpiado)) {
        http_response_code(400);
        exit("❌ Error 400: El parámetro 'curp' no puede estar vacío.");
    }
    // Si no está vacío, se retorna la variable ya lista y limpia
    return $curpLimpiado;
}

//  PASO 3 GET. VALIDAR REGLAS DE ACCESO (SIMULADO)
// Nota: En una app real, aquí verificarías tokens JWT o sesiones.
function verificarAutorizacionInicial()
{
    // Antes de procesar, verificamos si el cliente tiene credenciales válidas y permisos.
    // Si no está autenticado, 401 Unauthorized. Si no tiene permisos, 403 Forbidden.
    $autorizado = true; // Simulación de check de API Key o Sesión
    if (!$autorizado) {
        http_response_code(401);
        exit("❌ Error 401: No autorizado.");
    }
}

//  PASO 4 GET. SANITIZACIÓN DEL PARÁMETRO (IDENTIFICADOR):
function sanitizarCURP(string $curpLimpiado): string
{
    // Limpiamos el parámetro (identificador) de caracteres sospechosos o espacios innecesarios para prevenir inyecciones.
    $curpSanitizado = strip_tags($curpLimpiado);    // Eliminamos etiquetas HTML
    
    // Si la entrada resultante es inválida o peligrosa, 400 Bad Request.
    if (empty($curpSanitizado)) {
        http_response_code(400);
        exit("❌ Error 400: Entrada inválida tras sanitización.");
    }
    return $curpSanitizado;
}

//  PASO 5 GET. VALIDAR FORMATO Y REQUISITOS TÉCNICOS DEL IDENTIFICADOR (Guard Clause): 
function validarFormatoCURP(string $curp): string
{
    // Comprobamos que el ID cumpla con la estructura técnica (Regex, tipado, longitud).
    // Si el formato es inválido (ej. e-mail sin arroba -@-), se lanza un 400 Bad Request.
    if (!preg_match("/^[A-Z]{4}\d{6}[A-Z]{6}[A-Z0-9]\d$/", $curp)) {    // Regex ajustada al estándar oficial de RENAPO
        http_response_code(400);
        exit("❌ Error 400: El formato del CURP es inválido.");
    }
    return $curp;
}

//  PASO 6 GET. ESTABLECER CONEXIÓN CON LA PERSISTENCIA:
// En este caso, los datos están incrustados directamente en el código. 
// En 80.MetodoGETDesdeJSON.php se aborda su implementación desde un archivo .json
function cargarDatos(): array
{
    // Iniciamos el canal con la Base de Datos o sistema de archivos.
    // Si la conexión falla, se lanza un 500 Internal Server Error.
    $usuarios_db = [
        "GALR901123HDFRPC03" => ["curp" => "GALR901123HDFRPC03", "nombre" => "Ricardo", "apellidoP" => "García", "apellidoM" => "López", "nivel" => ""],
        "MAMM901123MDFRPC03" => ["curp" => "MAMM901123MDFRPC03", "nombre" => "Maomao", "apellidoP" => "La", "apellidoM" => "Mao", "nivel" => "premium"],
        "FRLA901123MDFRPC03" => ["curp" => "FRLA901123MDFRPC03", "nombre" => "Frieren", "apellidoP" => "La", "apellidoM" => "Aniquiladora", "nivel" => "premium"]
    ];

    if (!$usuarios_db) {
        http_response_code(500);
        exit("❌ Error 500: No se pudo establecer conexión con la fuente de datos.");
    }

    return $usuarios_db;
}

//  PASO 7 GET. VALIDAR DISPONIBILIDAD DE LA FUENTE DE DATOS (Guard Clause):
function validarDisponibilidadFuente(?array $usuarios_db): void // Operador de tipo de retorno nullable: ?datatype \$variable
{
    // Aseguramos que la tabla o archivo existan y sean accesibles.
    // Si la fuente está corrupta o inaccesible, se lanza un 500 Internal Server Error.
    if (empty($usuarios_db)) {
        http_response_code(500);
        exit("🔍 Error 500: Base de datos no encontrada o no existe.");
    }
    echo "✅ Conexión exitosa a la base de datos.\n";
}

//  PASO 8 GET. VALIDAR EXISTENCIA DEL RECURSO ESPECÍFICO (Guard Clause):
function validarExistenciaRecurso(array $usuarios_db, string $curp): void
{
    // Validamos que el identificador exista en la persistencia.
    // Si el ID no existe en la persistencia, se lanza un 404 Not Found.
    if (!isset($usuarios_db[$curp])) {
        http_response_code(404); // 404 No Found
        exit("❌ Error 404: El usuario con CURP '" . $curp . "' NO EXISTE en nuestro sistema.\n");
    }

    $nombreUsuario = $usuarios_db[$curp]["nombre"];
    echo "👤 Usuario " . $nombreUsuario . " con CURP " . $curp . " localizado con éxito.\n";
}

//  PASO 9 GET. EXTRACCIÓN, MAPEO Y VALIDACIÓN DE LECTURA (Guard Clause):
function extraccionConValidacion(array $usuarios_db, string $curp): ?array
{
    // Recuperamos los datos y los transformamos a una estructura manejable (objeto/array).
    // Si hay un error de lectura o el formato es ilegible, 500 Internal Server Error.
    $usuario = $usuarios_db[$curp] ?? null; // Retorna el valor del array o null si no existe

    // Validamos la búsqueda falló en encontrar la llave.
    if ($usuario === null) {
        http_response_code(500);
        exit("🔍 Error 500: Fallo inesperado al extraer el recurso.");
    }

    return $usuario; 
}
 
//  PASO 10 GET. VALIDAR INTEGRIDAD DEL CONTENIDO EXTRAÍDO (Guard Clause):
function validarDatosExtraidosDelUsuario(array $usuario, array $camposRequeridos): void
{
    // Verificamos que el recurso tenga la información mínima requerida.                    
    foreach ($camposRequeridos as $campo) {
        // 1. Validamos existencia (Estructura)
        // Si faltan campos críticos por error de integridad, 500 Internal Server Error.  
        if (!isset($usuario[$campo])) {
            http_response_code(500);
            exit("❌ Error 500: Integridad fallida. Falta el campo obligatorio: '$campo'.");
        }

        // 2. Validamos contenido (Datos reales)
        // Si el recurso existe pero carece de contenido representativo, 204 No Content.
        if (empty(trim((string)$usuario[$campo]))) {    // Usamos trim para que una cadena de puros espacios " " también se considere vacía
            http_response_code(204);
            exit("❌ Error 204: El campo '$campo' existe, pero está vacío.");
        }
    }

    echo "✅ Datos del usuario localizados.\n";
}
//  PASO 11 GET. FORMATEAR RESPUESTA Y ENTREGA
function responderExito(array $usuario)
{
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "message" => "Usuario localizado",
        "data" => $usuario
    ], JSON_PRETTY_PRINT);
}



echo "\n\n\n\n80. MÉTODO GET EN HTTP\n\n";

echo "80.1 INTRODUCCIÓN AL MÉTODO GET\n\n";

echo "El método GET es uno de los métodos HTTP más comunes y se utiliza para SOLICITAR DATOS DE UN RECURSO ESPECÍFICO EN EL SERVIDOR.
Cuando un cliente realiza una solicitud GET, está solicitando que el servidor le envíe los datos asociados con la URL especificada en la solicitud.\n\n\n\n";



echo "80.2 OBJETIVO Y PASOS DEL MÉTODO GET\n\n";

echo "El objetivo es OBTENER DATOS SIN ALTERAR SU ESTADO (IDEMPOTENCIA) mediante los siguientes pasos:

    PASO 1. VALIDAR PRESENCIA DEL PARÁMETRO (IDENTIFICADOR) EN LA URL (Guard Clause):
        Verificamos la existencia del parámetro (identificador) en la superglobal (ej. isset(\$_GET['id'])).
            Si el parámetro (identificador) NO está definido, se lanza un 400 Bad Request.
    PASO 2. VALIDAR QUE EL PARÁMETRO (IDENTIFICADOR) NO ESTÉ VACÍO (Guard Clause):
        Garantizamos que el parámetro (identificador) enviado no sea una cadena vacía o solo espacios tras un trim().
            Si el dato está vacío, se lanza un 400 Bad Request.
    PASO 3. VALIDAR REGLAS DE ACCESO Y AUTORIZACIÓN (Guard Clause):
        Antes de procesar, verificamos si el cliente tiene credenciales válidas y permisos.
            Si no está autenticado, 401 Unauthorized. Si no tiene permisos, 403 Forbidden.
    PASO 4. SANITIZACIÓN DEL PARÁMETRO (IDENTIFICADOR):
        Limpiamos el parámetro (identificador) de caracteres sospechosos, etiquetas HTML o espacios para prevenir inyecciones.
            Si la entrada resultante es inválida o vacío, 400 Bad Request.
    PASO 5. VALIDAR FORMATO Y REQUISITOS TÉCNICOS DEL IDENTIFICADOR (Guard Clause):
        Comprobamos que el ID cumpla con la estructura técnica (Regex, tipado, longitud).
            Si el formato es inválido (ej. e-mail sin arroba -@-), se lanza un 400 Bad Request.
    PASO 6. ESTABLECER CONEXIÓN CON LA PERSISTENCIA:
        Iniciamos el canal con la Base de Datos o sistema de archivos.
            Si la conexión falla, se lanza un 500 Internal Server Error.
    PASO 7. VALIDAR DISPONIBILIDAD DE LA FUENTE DE DATOS (Guard Clause):
        Aseguramos que la tabla o archivo existan y sean accesibles.
            Si la fuente está corrupta o inaccesible, se lanza un 500 Internal Server Error.
    PASO 8. VALIDAR EXISTENCIA DEL RECURSO ESPECÍFICO (Guard Clause):
        Validamos que el identificador exista en la persistencia. 
            Si el ID no existe en la persistencia, se lanza un 404 Not Found.
    PASO 9. EXTRACCIÓN, MAPEO Y VALIDACIÓN DE LECTURA (Guard Clause):
        Recuperamos los datos y los transformamos a una estructura manejable (objeto/array). 
            Si el recurso no puede ser extraído o el formato es ilegible tras localizarlo, se lanza un 500 Internal Server Error.
    PASO 10. VALIDAR INTEGRIDAD DEL CONTENIDO EXTRAÍDO (Guard Clause):
        Verificamos que el recurso tenga la información mínima requerida.                    
            a) Estructura: Si faltan campos críticos por error de integridad, 500 Internal Server Error.
            b) Contenido: Si el recurso existe pero carece de contenido representativo, 204 No Content.
    PASO 11. FORMATEAR RESPUESTA Y ENTREGA:
        Codificamos el recurso (json_encode) y enviamos headers adecuados.
            Se responde con un código 200 OK y el cuerpo del mensaje.\n\n";

echo "ACLARACIÓN: Los pasos son sólo una guía general y pueden variar según las necesidades específicas de tu aplicación y la lógica de negocio que estés implementando, 
pero seguir esta estructura te ayudará a mantener tu código organizado, claro y fácil de mantener.\n\n\n\n";



echo "80.3 CARACTERÍSTICAS DEL MÉTODO GET\n\n";

echo "El método GET tiene varias características importantes, incluyendo:

    1. IDEMPOTENTE: Las solicitudes GET no deben tener efectos secundarios en el servidor y pueden ser repetidas sin causar cambios adicionales en el servidor.
    2. SEGURO: Las solicitudes GET no deben modificar los datos en el servidor y no deberían causar cambios en el estado del servidor.
    3. PARÁMETROS EN LA URL: Los datos enviados con una solicitud GET se incluyen en la URL como parámetros de consulta (query parameters) después del signo de interrogación (?).
        Por ejemplo: http://example.com/api/users?curp=GALR&name=Ricardo&edad=35
        En este ejemplo, el signo de interrogación (?) separa la URL (http://example.com/api/users) del conjunto de parámetros de consulta. 
        Los parámetros de consulta son 'curp', 'name' y 'edad', y sus valores son 'GALR', 'Ricardo' y '35', respectivamente. 
        Cada parámetro está separado por un ampersand (&).
        Y cada valor está unido a su parámetro en la forma key=value. Es decir, url?key=value&key=value&key=value...
        En este caso, el cliente está solicitando información sobre un usuario con CURP 'GALR', nombre 'Ricardo' y edad '35'.
        El servidor puede procesar esta solicitud y devolver los datos correspondientes al usuario solicitado.
    4. LIMITACIONES DE LONGITUD: Las URL tienen una longitud máxima limitada de aproximadamente 2048 caracteres, por lo que las solicitudes GET NO son adecuadas para enviar grandes cantidades de datos.
    5. CACHÉ: Las respuestas a las solicitudes GET pueden ser almacenadas en caché por los navegadores y servidores, lo que puede mejorar el rendimiento al evitar solicitudes repetidas para el mismo recurso.
    6. SEGURIDAD: Dado que los parámetros de consulta en las solicitudes GET se incluyen en la URL, pueden ser visibles en los registros del servidor, en el historial del navegador y en otros lugares, lo que puede representar un riesgo de seguridad si se incluyen datos sensibles en la URL.\n\n\n\n";



echo "80.4 USOS COMUNES DEL MÉTODO GET\n\n";

echo "El método GET se utiliza comúnmente para:

1. OBTENER RECURSOS: El método GET se utiliza para obtener recursos específicos del servidor, como páginas web, imágenes, archivos, etcétera.
2. CONSULTAR APIs: Las solicitudes GET se utilizan para consultar APIs y obtener datos de recursos específicos, como información de usuarios, productos, etcétera.
3. ENVIAR PARÁMETROS DE BÚSQUEDA: Las solicitudes GET se utilizan para enviar parámetros de búsqueda en la URL, como en los motores de búsqueda o en formularios de búsqueda en sitios web.
4. NAVEGACIÓN: Las solicitudes GET se utilizan para navegar por diferentes páginas y recursos en un sitio web, como hacer clic en enlaces o acceder a diferentes secciones de un sitio.\n\n\n\n";



echo "80.5 CARÁCTERES ESPECIALES EN LOS PARÁMETROS DE CONSULTA: %+número\n\n";

echo "En los parámetros de consulta de una URL, ciertos caracteres especiales deben ser codificados para garantizar que la URL sea válida y se interprete correctamente por el servidor.\n\n";

echo "Uno de los caracteres especiales comunes es el signo de espacio, que se codifica como '%20' o se puede representar como un signo de más ('+').
Por ejemplo, si deseas enviar un parámetro de consulta con un valor que contiene espacios, como 'Ricardo García López', 
puedes codificarlo como 'Ricardo%20García%20López' o 'Ricardo+García+López' en la URL.
Ambas formas son válidas y el servidor las interpretará correctamente como 'Ricardo García López'.\n\n";

echo "También, por ejemplo, los caracteres especiales como el signo de interrogación ('?') y el ampersand ('&') deben ser codificados como '%3F' y '%26' respectivamente.\n\n\n\n";



echo "80.6 VARIABLE GLOBAL \$_GET\n\n";

echo "En PHP, la variable global \$_GET es un array asociativo que contiene los parámetros de consulta enviados en una solicitud GET.
Cuando un cliente realiza una solicitud GET con parámetros de consulta en la URL, PHP automáticamente llena el array de la variable \$GET con los valores de esos parámetros, esto permite a los desarrolladores acceder fácilmente a los datos enviados por el cliente a través de la URL.\n\n\n";


echo "80.6.1 EJEMPLO DE USO DE LA VARIABLE GLOBAL \$_GET\n\n";

echo "Ejemplo de uso de la variable global \$_GET para acceder a los parámetros de consulta en una solicitud GET:\n\n";

echo "Supongamos que un cliente realiza una solicitud GET a la siguiente URL:\n";
echo "http://localhost/PHP_HdeL/S-10.%20SolicitudesHTTP/80.MetodoGET.php?curp=FRLA901123MDFRPC03&name=Frieren%20La%20Aniquiladora&edad=1001\n\n";
echo "En este caso, el servidor puede acceder a los valores de los parámetros de consulta utilizando la variable global \$_GET de la siguiente manera:\n\n";
echo "echo \"CURP: \" . \$_GET['curp'] . \"\\n\";\n";
echo "echo \"Nombre: \" . \$_GET['name'] . \"\\n\";\n";
echo "echo \"Edad: \" . \$_GET['edad'] . \"\\n\";\n\n";
echo "La salida de este código sería:\n\n";
echo "CURP: FRLA901123MDFRPC03\n";
echo "Nombre: Frieren\n";
echo "Edad: 1001\n\n";

echo "EJECUCIÓN COMPLETA DEL EJEMPLO (Recuerda que tienen que ir los valores en la URL):\n\n";
if (isset($_GET['curp'])) {
    echo "CURP: " . $_GET['curp'] . "\n";
} else {
    echo "No has ingresado el \"curp\" en la URL\n";
}
if (isset($_GET['name'])) {
    echo "Nombre: " . $_GET['name'] . "\n";
} else {
    echo "No has ingresado el \"name\" en la URL\n";
}
if (isset($_GET['edad'])) {
    echo "Edad: " . $_GET['edad'] . "\n";
} else {
    echo "No has ingresado la \"edad\" en la URL\n";
}

echo "\nEn este ejemplo, el cliente realiza una solicitud GET a la URL 
http://localhost/PHP_HdeL/S-10.%20SolicitudesHTTP/80.MetodoGET.php?curp=FRLA901123MDFRPC03&name=Frieren%20La%20Aniquiladora&edad=1001
y se utiliza la variable global \$GET para acceder a los parámetros de consulta enviados en la solicitud GET, 
lo que permite al servidor procesar la solicitud y devolver la información correspondiente al usuario solicitado.\n\n\n\n";



echo "80.7 EJEMPLO DE SOLICITUD GET\n\n";

echo "80.7.1 OBTENER información de un usuario con curp = 'FRLA901123MDFRPC03':\n\n";

echo <<<'EOD'
<?php
// 1. CONFIGURACIÓN Y RUTAS: Aquí es donde configuras tu entorno, defines tus rutas y controlas el flujo de la aplicación según el método HTTP utilizado en la solicitud.
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.
$metodo = $_SERVER["REQUEST_METHOD"];   // Se utiliza la variable global $_SERVER sin declaración previa porque es una variable super-global predefinida por PHP que está disponible en todo el ámbito del programa.
header("Content-Type: text/plain");     // Esto es para que el navegador interprete la respuesta como texto plano y no como HTML, lo que facilita la lectura de los mensajes de error y depuración en la respuesta HTTP.

// 2. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
try {
    match ($metodo) {
        'GET' => ejecutarLogicaGet(),
        // 'POST' => ejecutarLogicaPost(),  // Esto lo comentamos porque aún no lo hemos visto...
        // 'PUT' => ejecutarLogicaPut(),    // ...pero la idea es que cada método HTTP tenga su propia función con su propia lógica de negocio, 
        // 'DELETE' => ejecutarLogicaDelete(),  // y así mantener el código organizado y fácil de mantener.
        default => lanzarError405()
    };
} catch (UnhandledMatchError $e) {
    lanzarError405();
}

// 3. LÓGICA DE NEGOCIO: Porque aquí es donde va tu lógica de negocio para cada método HTTP.
function ejecutarLogicaGet()
{
    //  PASO 1 GET. VALIDAR PRESENCIA DEL PARÁMETRO (IDENTIFICADOR) EN LA URL (Guard Clause):
    verificarPresenciaParametro();

    //  PASO 2 GET. VALIDAR QUE EL PARÁMETRO (IDENTIFICADOR) NO ESTÉ VACÍO (Guard Clause):
    $curpIngresada = validarContenidoParametro();
    
    //  PASO 3 GET. VALIDAR REGLAS DE ACCESO (SIMULADO)
    verificarAutorizacionInicial();
    
    //  PASO 4 GET. SANITIZACIÓN DEL PARÁMETRO (IDENTIFICADOR):
    $curpIngresada = sanitizarParametro($curpIngresada);
    
    //  PASO 5 GET. VALIDAR FORMATO Y REQUISITOS TÉCNICOS DEL IDENTIFICADOR (Guard Clause): 
    $curpIngresada = validarFormatoParametro($curpIngresada);
    
    //  PASO 6. ESTABLECER CONEXIÓN CON LA PERSISTENCIA:
    $usuarios_db = cargarDatos();

    //  PASO 7 GET. VALIDAR DISPONIBILIDAD DE LA FUENTE DE DATOS (Guard Clause):
    validarDisponibilidadFuente($usuarios_db);
    
    //  PASO 8 GET. VALIDAR EXISTENCIA DEL RECURSO ESPECÍFICO (Guard Clause):
    validarExistenciaRecurso($usuarios_db, $curpIngresada);
    
    //  PASO 9 GET. EXTRACCIÓN, MAPEO Y VALIDACIÓN DE LECTURA (Guard Clause):
    $usuario = extraccionConValidacion($usuarios_db, $curpIngresada);

    //  PASO 10 GET. VALIDAR INTEGRIDAD DEL CONTENIDO EXTRAÍDO (Guard Clause):
    validarDatosExtraidosDelUsuario($usuario);

    //  PASO 11 GET. FORMATEAR RESPUESTA Y ENTREGA
    responderExito($usuario);
}
function ejecutarLogicaPost()
{
    // Aquí va el demás código específico para POST que puedes 
    // a) incrustarlo directamente o
    // b) meterlo en otras funciones    -RECOMENDADO-
}
function ejecutarLogicaPut()
{
    // Aquí va el demás código específico para PUT que puedes 
    // a) incrustarlo directamente o
    // b) meterlo en otras funciones    -RECOMENDADO-
}
function ejecutarLogicaDelete()
{
    // Aquí va el demás código específico para DELETE que puedes 
    // a) incrustarlo directamente o
    // b) meterlo en otras funciones    -RECOMENDADO-
}
function lanzarError405()
{
    http_response_code(405);
    header("Allow: GET");   // Esto es para indicar al cliente qué métodos HTTP sí están permitidos en esta ruta, lo que es una buena práctica para mejorar la comunicación entre el cliente y el servidor.
    exit("⚠️ Error 405: Método no permitido.");
}

//  4. SERVICIO DE DATOS


//  5. FUNCIONES: Aquí abajo (o en otro archivo) defines las funciones

//  5.1 FUNCIONES GET

//  PASO 1 GET. VALIDAR PRESENCIA DEL PARÁMETRO (IDENTIFICADOR) EN LA URL (Guard Clause):
function verificarPresenciaParametro()
{
    // Verificamos la existencia del parámetro (identificador) en la superglobal (ej. isset(\$_GET['id'])).
    // Si el parámetro (identificador) NO está definido, se lanza un 400 Bad Request.
    if (!isset($_GET['curp'])) {
        http_response_code(400);
        exit("❌ Error 400: El parámetro 'curp' es requerido.");
    }
}

//  PASO 2 GET. VALIDAR QUE EL PARÁMETRO (IDENTIFICADOR) NO ESTÉ VACÍO (Guard Clause):
function validarContenidoParametro(): string
{
    // Garantizamos que el parámetro (identificador) enviado no sea una cadena vacía o solo espacios tras un trim().
    $curpLimpiado = strtoupper(trim($_GET['curp']));   // Limpieza estética básica (espacios y mayúsculas)

    // Si el dato está vacío, se lanza un 400 Bad Request.
    if (empty($curpLimpiado)) {
        http_response_code(400);
        exit("❌ Error 400: El parámetro 'curp' no puede estar vacío.");
    }
    // Si no está vacío, se retorna la variable ya lista y limpia
    return $curpLimpiado;
}

//  PASO 3 GET. VALIDAR REGLAS DE ACCESO (SIMULADO)
// Nota: En una app real, aquí verificarías tokens JWT o sesiones.
function verificarAutorizacionInicial()
{
    // Antes de procesar, verificamos si el cliente tiene credenciales válidas y permisos.
    // Si no está autenticado, 401 Unauthorized. Si no tiene permisos, 403 Forbidden.
    $autorizado = true; // Simulación de check de API Key o Sesión
    if (!$autorizado) {
        http_response_code(401);
        exit("❌ Error 401: No autorizado.");
    }
}

//  PASO 4 GET. SANITIZACIÓN DEL PARÁMETRO (IDENTIFICADOR):
function sanitizarParametro(string $curpLimpiado): string
{
    // Limpiamos el parámetro (identificador) de caracteres sospechosos o espacios innecesarios para prevenir inyecciones.
    $curpSanitizado = strip_tags($curpLimpiado);    // Eliminamos etiquetas HTML
    
    // Si la entrada resultante es inválida o peligrosa, 400 Bad Request.
    if (empty($curpSanitizado)) {
        http_response_code(400);
        exit("❌ Error 400: Entrada inválida tras sanitización.");
    }
    return $curpSanitizado;
}

//  PASO 5 GET. VALIDAR FORMATO Y REQUISITOS TÉCNICOS DEL IDENTIFICADOR (Guard Clause): 
function validarFormatoParametro(string $curp): string
{
    // Comprobamos que el ID cumpla con la estructura técnica (Regex, tipado, longitud).
    // Si el formato es inválido (ej. e-mail sin arroba -@-), se lanza un 400 Bad Request.
    if (!preg_match("/^[A-Z]{4}\d{6}[A-Z]{6}[A-Z0-9]\d$/", $curp)) {    // Regex ajustada al estándar oficial de RENAPO
        http_response_code(400);
        exit("❌ Error 400: El formato del CURP es inválido.");
    }
    return $curp;
}

//  PASO 6. ESTABLECER CONEXIÓN CON LA PERSISTENCIA:
// En este caso, los datos están incrustados directamente en el código. 
// En 80.MetodoGETDesdeJSON.php se aborda su implementación desde un archivo .json
function cargarDatos(): array
{
    // Iniciamos el canal con la Base de Datos o sistema de archivos.
    // Si la conexión falla, se lanza un 500 Internal Server Error.
    $usuarios_db = [
        "GALR901123HDFRPC03" => ["curp" => "GALR901123HDFRPC03", "nombre" => "Ricardo", "apellidoP" => "García", "apellidoM" => "López", "nivel" => ""],
        "MAMM901123MDFRPC03" => ["curp" => "MAMM901123MDFRPC03", "nombre" => "Maomao", "apellidoP" => "La", "apellidoM" => "Mao", "nivel" => "premium"],
        "FRLA901123MDFRPC03" => ["curp" => "FRLA901123MDFRPC03", "nombre" => "Frieren", "apellidoP" => "La", "apellidoM" => "Aniquiladora", "nivel" => "premium"]
    ];

    if (!$usuarios_db) {
        http_response_code(500);
        exit("❌ Error 500: No se pudo establecer conexión con la fuente de datos.");
    }

    return $usuarios_db;
}

//  PASO 7 GET. VALIDAR DISPONIBILIDAD DE LA FUENTE DE DATOS (Guard Clause):
function validarDisponibilidadFuente(?array $usuarios_db): void // Operador de tipo de retorno nullable: ?datatype \$variable
{
    // Aseguramos que la tabla o archivo existan y sean accesibles.
    // Si la fuente está corrupta o inaccesible, se lanza un 500 Internal Server Error.
    if (empty($usuarios_db)) {
        http_response_code(500);
        exit("🔍 Error 500: Base de datos no encontrada o no existe.");
    }
    echo "✅ Conexión exitosa a la base de datos.\n";
}

//  PASO 8 GET. VALIDAR EXISTENCIA DEL RECURSO ESPECÍFICO (Guard Clause):
function validarExistenciaRecurso(array $usuarios_db, string $curp): void
{
    // Validamos que el identificador exista en la persistencia.
    // Si el ID no existe en la persistencia, se lanza un 404 Not Found.
    if (!isset($usuarios_db[$curp])) {
        http_response_code(404); // 404 No Found
        exit("❌ Error 404: El usuario con CURP '" . $curp . "' NO EXISTE en nuestro sistema.\n");
    }

    $nombreUsuario = $usuarios_db[$curp]["nombre"];
    echo "👤 Usuario " . $nombreUsuario . " con CURP " . $curp . " localizado con éxito.\n";
}

//  PASO 9 GET. EXTRACCIÓN, MAPEO Y VALIDACIÓN DE LECTURA (Guard Clause):
function extraccionConValidacion(array $usuarios_db, string $curp): ?array
{
    // Recuperamos los datos y los transformamos a una estructura manejable (objeto/array).
    // Si hay un error de lectura o el formato es ilegible, 500 Internal Server Error.
    $usuario = $usuarios_db[$curp] ?? null; // Retorna el valor del array o null si no existe

    // Validamos la búsqueda falló en encontrar la llave.
    if ($usuario === null) {
        http_response_code(500);
        exit("🔍 Error 500: Fallo inesperado al extraer el recurso.");
    }

    return $usuario; 
}
 
//  PASO 10 GET. VALIDAR INTEGRIDAD DEL CONTENIDO EXTRAÍDO (Guard Clause):
function validarDatosExtraidosDelUsuario(array $usuario): void
{
    // Definimos qué campos son obligatorios para que este recurso sea válido
    $camposObligatorios = ["curp", "nombre", "apellidoP", "apellidoM", 'nivel'];

    // Verificamos que el recurso tenga la información mínima requerida.                    
    foreach ($camposObligatorios as $campo) {
        // 1. Validamos existencia (Estructura)
        // Si faltan campos críticos por error de integridad, 500 Internal Server Error.  
        if (!isset($usuario[$campo])) {
            http_response_code(500);
            exit("❌ Error 500: Integridad fallida. Falta el campo obligatorio: '$campo'.");
        }

        // 2. Validamos contenido (Datos reales)
        // Si el recurso existe pero carece de contenido representativo, 204 No Content.
        if (empty(trim((string)$usuario[$campo]))) {    // Usamos trim para que una cadena de puros espacios " " también se considere vacía
            http_response_code(204);
            exit("❌ Error 204: El campo '$campo' existe pero está vacío.");
        }
    }

    echo "✅ Datos del usuario localizados.\n";
}
//  PASO 11 GET. FORMATEAR RESPUESTA Y ENTREGA
function responderExito(array $usuario)
{
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "message" => "Usuario localizado",
        "data" => $usuario
    ], JSON_PRETTY_PRINT);
}
EOD;

echo "80.8 RESUMEN DEL MÉTODO HTTP GET\n\n";

echo "El método GET es una herramienta fundamental en el desarrollo web para obtener información de un servidor sin modificar nada.
Es importante seguir una estructura clara y organizada al implementar la lógica de negocio para las solicitudes GET, incluyendo la validación de parámetros de entrada, la carga y búsqueda de datos, la validación de reglas de negocio y la respuesta con los datos solicitados, para garantizar que tu aplicación sea robusta, segura y fácil de mantener.\n\n";


