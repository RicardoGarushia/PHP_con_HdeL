<?php
// 1. CONFIGURACIÓN Y RUTAS: Aquí es donde configuras tu entorno, defines tus rutas y controlas el flujo de la aplicación según el método HTTP utilizado en la solicitud.
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.
$metodo = $_SERVER["REQUEST_METHOD"];   // Se utiliza la variable global $_SERVER sin declaración previa porque es una variable super-global predefinida por PHP que está disponible en todo el ámbito del programa.
header("Content-Type: text/plain");     // Esto es para que el navegador interprete la respuesta como texto plano y no como HTML, lo que facilita la lectura de los mensajes de error y depuración en la respuesta HTTP.
$camposRequeridos = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'nivel'];  // Definimos un array con los campos requeridos para la lectura, creación o modificación de un usuario, lo que nos permite validar de manera más flexible y escalable sin tener que modificar la lógica de validación cada vez que se agregue o elimine un campo requerido.
$rutaArchivo = __DIR__ . '/usuarios.json'; // __DIR__ obtiene la carpeta actual del script, lo que hace que la ruta sea relativa a la ubicación del archivo PHP, lo que es más seguro y portátil que usar rutas absolutas o relativas sin referencia.

// 2. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
try {
    match ($metodo) {
        'GET' => ejecutarLogicaGet($rutaArchivo, $camposRequeridos),
        // 'POST' => ejecutarLogicaPost(),  // Esto lo comentamos porque aún no lo hemos visto...
        // 'PUT' => ejecutarLogicaPut(),    // ...pero la idea es que cada método HTTP tenga su propia función con su propia lógica de negocio, 
        // 'DELETE' => ejecutarLogicaDelete(),  // y así mantener el código organizado y fácil de mantener.
        default => lanzarError405()
    };
} catch (UnhandledMatchError $e) {
    lanzarError405();
}

// 3. LÓGICA DE NEGOCIO: Porque aquí es donde va tu lógica de negocio para cada método HTTP.
function ejecutarLogicaGet(string $rutaArchivo, array $camposRequeridos)
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
    $usuarios_db = cargarDatos($rutaArchivo);

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
function cargarDatos($rutaArchivo): array
{
    // Iniciamos el canal con la Base de Datos o sistema de archivos.
    // Si la conexión falla, se lanza un 500 Internal Server Error.

    // 1. Validación de existencia del archivo
    if (!file_exists($rutaArchivo)) {
        // Si el archivo no existe se cierra la aplicación de inmediato.
        http_response_code(500);
        exit("❌ Error 500: Base de datos no disponible en servidor.");
    }

    // 2. Si existe, leemos el contenido del archivo (es un string largo)
    $contenidoJson = file_get_contents($rutaArchivo);   // La función file_get_contents() retorna el booleano false en caso de algún error. 
    if ($contenidoJson === false) {
        http_response_code(500);
        exit("❌ Error 500: No se pudo leer el archivo de usuarios.");
    }

    // 3. Convertimos el JSON (string) a un Array Asociativo de PHP y se valida la conversión
    // El segundo parámetro \"true\" es vital. Si no lo pones, PHP creará un Objeto en lugar de un Array, y tu código \$usuario['nombre'] fallaría (tendrías que usar \$usuario->nombre).*/
    $usuarios_db = json_decode($contenidoJson, true);

    // 4. Se evalúa si existió algún error, y cualquier valor diferente a "ningún error" detiene el programa. 
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);
        exit("❌ Error 500: El archivo JSON está corrupto o mal formado.");
    }

    return $usuarios_db ?? [];    // Se devuelve el array o un array vacío si no hay datos
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



echo "\n\n\n\n80.1 MÉTODO GET EN HTTP DESDE UN JSON\n\n";

echo "80.1.1 USO DEL JSON EN MÉTODOS HTTP\n\n";

echo "(Para realizar un repaso, consulte 37.JSON.php)\n\n";

echo "En el desarrollo real, el JSON suele ser un paso intermedio entre la base de datos y el cliente, o entre el servidor y el cliente, dependiendo de la arquitectura de tu aplicación. 
Es decir, no es común que un cliente (como Postman o una App) solicite directamente un archivo JSON, sino que solicite datos a un servidor, y el servidor se encargue de consultar la base de datos, convertir los datos a JSON y enviarlos al cliente.
Sin embargo, para fines didácticos y de simplicidad, vamos a simular este proceso utilizando un archivo JSON local como nuestra \"base de datos\". Esto nos permitirá centrarnos en la lógica de lectura y manejo de JSON sin complicarnos con la configuración de una base de datos real.\n\n";

echo "La idea es que el cliente (Postman, navegador, etc.) haga una solicitud GET a nuestro script PHP, pasando un parámetro de entrada (en este caso, la CURP del usuario) y el script PHP se encargue de leer el archivo JSON, buscar al usuario por su CURP y devolver la información correspondiente o un mensaje de error si no se encuentra.\n\n";

echo "De forma muy resumida, primero se crea un archivo JSON (.json) con la información de tus usuarios (puedes usar el ejemplo de usuarios.json que se te proporciono); y después, escribir un script PHP que lea ese archivo, busque al usuario por su CURP y retorne la información correspondiente.\n\n";

echo "Vamos por pasos: 

PASO 1. En este ejemplo, el archivo se rotula como usuarios.json y contiene en formato JSON lo que se almacenaba en la variable \$usuarios_db de tipo array del PASO 5 GET. CARGAR DATOS. 
Es decir, pasamos del array que estaba contenido dentro del mismo código en el PASO 5 GET. CARGAR DATOS:

\$usuarios_db = [
    \"GALR901123HDFRPC03\" => [\"curp\" => \"GALR901123HDFRPC03\", \"nombre\" => \"Ricardo\", \"apellidoP\" => \"García\", \"apellidoM\" => \"López\", \"nivel\" => \"free\"]/*,
    \"MAMM901123MDFRPC03\" => [\"curp\" => \"MAMM901123MDFRPC03\", \"nombre\" => \"Maomao\", \"apellidoP\" => \"La\", \"apellidoM\" => \"Mao\", \"nivel\" => \"premium\"],
    \"FRLA901123MDFRPC03\" => [\"curp\" => \"FRLA901123MDFRPC03\", \"nombre\" => \"Frieren\", \"apellidoP\" => \"La\", \"apellidoM\" => \"Aniquiladora\", \"nivel\" => \"premium\"]
];

    A un archivo adicional llamado usuarios.json, QUE SE ENCUENTRA EN LA MISMA CARPETA QUE ESTE ARCHIVO PHP y contiene el siguiente JSON: 

{
    \"GALR901123HDFRPC03\": {\"curp\": \"GALR901123HDFRPC03\", \"nombre\": \"Ricardo\", \"apellidoP\": \"García\", \"apellidoM\": \"López\", \"nivel\": \"free\"},
    \"MAMM901123MDFRPC03\": {\"curp\": \"MAMM901123MDFRPC03\", \"nombre\": \"Maomao\", \"apellidoP\": \"La\", \"apellidoM\": \"Mao\", \"nivel\": \"premium\"},
    \"FRLA901123MDFRPC03\": {\"curp\": \"FRLA901123MDFRPC03\", \"nombre\": \"Frieren\", \"apellidoP\": \"La\", \"apellidoM\": \"Aniquiladora\", \"nivel\": \"premium\"}
}

NOTA: Si olvidaste la diferencia entre arrays y JSON, revisa nuevamente, la sección 3 que aborda arrays y 37.JSON.php y 38.JSON_Encode_Decode.php.
\n\n\n";


echo "PASO 2. Ahora como los datos o la base de datos está en un archivo ajeno al archivo del código PHP, es necesario crear una variable en el script PHP que almacene la ubicación de dicho archivo, de la siguiente manera: 

// 1. CONFIGURACIÓN Y RUTAS: Aquí es donde configuras tu entorno, defines tus rutas y controlas el flujo de la aplicación según el método HTTP utilizado en la solicitud.
...
\$rutaArchivo = __DIR__ . '/usuarios.json'; // __DIR__ obtiene la carpeta actual del script, lo que hace que la ruta sea relativa a la ubicación del archivo PHP, lo que es más seguro y portátil que usar rutas absolutas o relativas sin referencia.\n\n";

echo "PASO 3. Ahora la variable \$rutaArchivo, que almacena la dirección del archivo usuarios.json, se pasa como argumento en la función ejecutarLogicaGet():

// 2. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
try {
    match (\$metodo) {
        'GET' => ejecutarLogicaGet(\$rutaArchivo),   // Aquí se pasa la ruta del archivo JSON a la función ejecutarLogicaGet() para que pueda cargar los datos y buscar al usuario por su CURP.
        // 'POST' => ejecutarLogicaPost(),      // Esto lo comentamos porque aún no lo hemos visto...
        // 'PUT' => ejecutarLogicaPut(),        // ...pero la idea es que cada método HTTP tenga su propia función con su propia lógica de negocio, 
        // 'DELETE' => ejecutarLogicaDelete(),  // y así mantener el código organizado y fácil de mantener.
        default => lanzarError405()
    };
} catch (UnhandledMatchError $e) {
    lanzarError405();
}\n\n";

echo "PASO 4. Ahora es necesario trabajar con la variable para que apartir de la ubicación del archivo usuarios.json nos brinde la información que contiene.
Para ello se modifica la función cargarDatos() de la siguiente manera:\n"; 
echo <<<'EOD'
//  PASO 5. CARGAR FUENTE DE DATOS: 
function cargarDatos(string $rutaArchivo): array
{
    // Intentamos conectar con la base de datos o leer el archivo físico (ej. usuarios.json).
    // Si hay un error de conexión, permisos o el archivo no existe, se lanza un error 500 Internal Server Error.
    
    // 1. Validación de existencia del archivo
    if (!file_exists($rutaArchivo)) {
        // Si el archivo no existe se cierra la aplicación de inmediato.
        http_response_code(500);
        exit("❌ Error 500: Base de datos no disponible en servidor.");
    }

    // 2. Si existe, leemos el contenido del archivo (es un string largo)
    $contenidoJson = file_get_contents($rutaArchivo);   // La función file_get_contents() retorna el booleano false en caso de algún error. 
    if ($contenidoJson === false) {
        http_response_code(500);
        exit("❌ Error 500: No se pudo leer el archivo de usuarios.");
    }

    // 3. Convertimos el JSON (string) a un Array Asociativo de PHP y se valida la conversión
    // El segundo parámetro \"true\" es vital. Si no lo pones, PHP creará un Objeto en lugar de un Array, y tu código \$usuario['nombre'] fallaría (tendrías que usar \$usuario->nombre).*/
    $usuarios_db = json_decode($contenidoJson, true);

    // 4. Se evalúa si existió algún error, y cualquier valor diferente a "ningún error" detiene el programa. 
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);
        exit("❌ Error 500: El archivo JSON está corrupto o mal formado.");
    }

    return $usuarios_db ?? [];    // Se devuelve el array o un array vacío si no hay datos
}
EOD;

echo "\n\nPASO 5. La función cargarDatos() es invocada y almacenada en la variable \$usuarios_db para que el programa funcione normalmente:

function ejecutarLogicaGet(string \$rutaArchivo)
{
    // Aquí va el contenido anterior ya creado

    //  PASO 5. CARGAR FUENTE DE DATOS:
    \$usuarios_db = cargarDatos(\$rutaArchivo);

    // Aquí va el contenido posterior ya creado
}
\n\n\n";


echo "¡Y listo, el programa correrá igual!";