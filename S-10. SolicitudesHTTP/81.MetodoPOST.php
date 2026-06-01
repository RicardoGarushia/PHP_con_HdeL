<?php
// 1. CONFIGURACIÓN Y RUTAS: Aquí es donde configuras tu entorno, defines tus rutas y controlas el flujo de la aplicación según el método HTTP utilizado en la solicitud.
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.
$metodo = $_SERVER["REQUEST_METHOD"];   // Se utiliza la variable global $_SERVER sin declaración previa porque es una variable super-global predefinida por PHP que está disponible en todo el ámbito del programa.
header("Content-Type: text/plain");     // Esto es para que el navegador interprete la respuesta como texto plano y no como HTML, lo que facilita la lectura de los mensajes de error y depuración en la respuesta HTTP.
$camposRequeridos = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'nivel'];  // Definimos un array con los campos requeridos para la creación de un nuevo usuario, lo que nos permite validar de manera más flexible y escalable en la función presenciaYValidezDatosCuerpo() sin tener que modificar la lógica de validación cada vez que se agregue o elimine un campo requerido.
$rutaArchivo = __DIR__ . '/usuarios.json'; // __DIR__ obtiene la carpeta actual del script, lo que hace que la ruta sea relativa a la ubicación del archivo PHP, lo que es más seguro y portátil que usar rutas absolutas o relativas sin referencia.

// 2. CONTROL DE RUTAS: Para controlar las rutas según el método HTTP.
try {
    match ($metodo) {
        // 'GET' => ejecutarLogicaGet($rutaArchivo, $camposRequeridos),
        'POST' => ejecutarLogicaPost($rutaArchivo, $camposRequeridos),
        // 'PUT' => ejecutarLogicaPut(),
        // 'DELETE' => ejecutarLogicaDelete(),
        default => lanzarError405()
    };
} catch (UnhandledMatchError $e) {
    lanzarError405();
}

// 3. LÓGICA DE NEGOCIO: Porque aquí es donde va tu lógica de negocio para cada método HTTP.
function ejecutarLogicaGet(string $rutaArchivo, array $camposRequeridos)
{
    // VÉASE 80.MetodoGETDesdeJSON.php para la lógica de negocio de GET desde un archivo JSON, que es la misma que usaríamos aquí. 
}
function ejecutarLogicaPost(string $rutaArchivo, array $camposRequeridos)
{
    //  PASO 1 POST. VALIDAR EL TIPO DE CONTENIDO (Content-Type Header):
    validationContentType();

    //  PASO 2 POST. VALIDAR REGLAS DE ACCESO Y AUTORIZACIÓN (Auth Guard):
    verificarAutorizacionPOST(); 

    //  PASO 3 POST. CAPTURA Y VALIDACIÓN DE EXISTENCIA DEL CUERPO (Body Presence):
    $nuevoUsuario = capturarCuerpoSolicitud(); 

    //  PASO 4 POST. VALIDAR PRESENCIA DE CAMPOS OBLIGATORIOS (Schema Validation):
    $nuevoUsuario = validarDatosNecesarios($nuevoUsuario, $camposRequeridos);

    //  PASO 5 POST. SANITIZACIÓN DE LOS DATOS DE ENTRADA:
    $nuevoUsuario = sanitizarDatosPOST($nuevoUsuario);

    //  PASO 6 POST. VALIDAR FORMATO, TIPADO Y REQUISITOS TÉCNICOS (Deep Validation):
    validarNivelSuscripcion($nuevoUsuario);

    validarFormatoCURP($nuevoUsuario['curp']);  // ¡SE REUTILIZA DE GET: PASO 5 GET validarFormatoCURP()! 

    //  PASO 7 POST. ESTABLECER CONEXIÓN CON LA PERSISTENCIA:
    $usuarios_db = cargarDatos($rutaArchivo);  // ¡SE REUTILIZA DE GET: PASO 6 GET cargarDatos()!

    //  PASO 8 POST. VALIDAR UNICIDAD DEL RECURSO:
    evitarDuplicidad($usuarios_db, $nuevoUsuario['curp']); 

    //  PASO 9 POST. VALIDAR REGLAS DE NEGOCIO:


    //  PASO 10 POST. PREPARACIÓN E HIDRATACIÓN DEL RECURSO (Resource Preparation): 
    $nuevoUsuario = hidratarRecurso($nuevoUsuario);
    $usuarios_db = prepararRecurso($usuarios_db, $nuevoUsuario); 

    //  PASO 11 POST. PERSISTENCIA DE DATOS (Data Storage):
    persistenciaDatos($rutaArchivo, $usuarios_db);

    //  PASO 12 POST. VALIDAR ÉXITO DE LA OPERACIÓN (Final Integrity Check):
    confirmarGuardadoExitoso($rutaArchivo, $nuevoUsuario['curp']);

    //  PASO 13 POST. RESPONDER CON RESULTADO DE CREACIÓN (Created Response):
    responderCreacion($nuevoUsuario); 
}
function ejecutarLogicaPut()
{
    // Aquí va el demás código específico para PUT
}
function ejecutarLogicaDelete()
{
    // Aquí va el demás código específico para DELETE
}
function lanzarError405()
{
    http_response_code(405);
    header("Allow: POST");    // Esto es para indicar al cliente qué métodos HTTP sí están permitidos en esta ruta, lo que es una buena práctica para mejorar la comunicación entre el cliente y el servidor.
    exit("⚠️ Error 405: Método no permitido.");
}

// 4. SERVICIO DE DATOS



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



// 5.2 FUNCIONES POST

//  PASO 1 POST. VALIDAR EL TIPO DE CONTENIDO (Content-Type Header):
function validationContentType(): void
{
    // Verificamos que el cliente declare qué formato está enviando (ej. 'application/json' o 'application/x-www-form-urlencoded' o 'multipart/form-data').
    // Si el encabezado no coincide con lo que el servidor puede procesar, se lanza un error 415 Unsupported Media Type.
    $contentType = $_SERVER["CONTENT_TYPE"] ?? '';  // Operador de coalescencia nula (??)

    // GUARD CLAUSE: Verificar que el Content-Type sea 'application/json'
    if (stripos($contentType, 'application/json') === false)    // Operador de comparación estricta (===) para que no existan conversiones de tipo de dato.
    // stripos() devuelve la posición de la primera aparición de un substring en un string, ignorando mayúsculas y minúsculas. Si no encuentra el substring, devuelve false. 
    {
        http_response_code(415);    // 415 = Unsupported Media Type
        exit("❌ Error 415: Esta API solo acepta contenido de tipo 'application/json'.\n" .
            "Detectado: $contentType");
    }
}

//  PASO 2 POST. VALIDAR REGLAS DE ACCESO Y AUTORIZACIÓN (Auth Guard):
function verificarAutorizacionPOST(): void
{
    // Igual que con GET, verificamos si el cliente tiene credenciales válidas y permisos para crear este recurso específico.
    // Si no está autenticado, 401 Unauthorized. Si no tiene permisos, 403 Forbidden.
    $autenticado = true;        // Simulación: solo usuarios con una "API-KEY" ficticia podrían crear recursos
    if (!$autenticado) {
        http_response_code(401);
        exit("❌ Error 401: No autenticado para crear recursos.");
    }
}

//  PASO 3 POST. CAPTURA Y VALIDACIÓN DE EXISTENCIA DEL CUERPO (Body Presence):
function capturarCuerpoSolicitud(): array
{
    // Garantizamos que el cuerpo (php://input o \$_POST) no esté vacío y sea legible.
    $jsonRecibido = file_get_contents('php://input');

    // Si el cuerpo es nulo o el JSON está malformado, 400 Bad Request.
    if ($jsonRecibido === false || empty(trim($jsonRecibido))) {
        http_response_code(400);
        exit("❌ Error 400: El cuerpo de la solicitud está vacío.");
    }

    $nuevoUsuario = json_decode($jsonRecibido, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        exit("❌ Error 400: JSON malformado. Detalle: " . json_last_error_msg());
    }

    return $nuevoUsuario;
}

//  PASO 4 POST. VALIDAR PRESENCIA DE CAMPOS OBLIGATORIOS (Schema Validation):
function validarDatosNecesarios(array $nuevoUsuario, array $camposRequeridos): array
{
    // Verificamos que el recurso tenga la información mínima requerida.                    
    foreach ($camposRequeridos as $campo) {
        // 1. Validamos existencia (Estructura)
        // Si faltan campos críticos por error de integridad, 500 Internal Server Error.  
        if (!isset($nuevoUsuario[$campo])) {
            http_response_code(400);
            exit("❌ Error 400: El campo '$campo' es obligatorio en el esquema.");
        }

        // 2. Validamos contenido (Datos reales)
        // Si el recurso existe pero carece de contenido representativo, 204 No Content.
        if (empty(trim((string)$nuevoUsuario[$campo]))) {    // Usamos trim para que una cadena de puros espacios " " también se considere vacía
            http_response_code(204);
            exit("❌ Error 204: El campo '$campo' existe pero está vacío.");
        }
    }
    return $nuevoUsuario; // Si todo está bien, retornamos el nuevo usuario para que pueda ser procesado en los pasos siguientes.
}

//  PASO 5 POST. SANITIZACIÓN DE LOS DATOS DE ENTRADA:
function sanitizarDatosPOST(array $nuevoUsuario): array
{
    $datosLimpiosNuevoUsuario = [];
    // Limpiamos cada campo de caracteres sospechosos, etiquetas HTML o espacios para prevenir inyecciones.
    foreach ($nuevoUsuario as $llave => $valor) {
        // Limpiamos etiquetas con la función strip_tags() y espacios con la función trim()
        $limpio = strip_tags(trim((string)$valor));
        // Si el resultado tras limpiar es invalido o vacío, 400 Bad Request.
        if (empty($limpio)) {
            http_response_code(400);
            exit("❌ Error 400: El campo '$llave' quedó vacío tras la sanitización.");
        }
        $datosLimpiosNuevoUsuario[$llave] = $limpio;
    }
    return $datosLimpiosNuevoUsuario;
}

//  PASO 6 POST. VALIDAR FORMATO, TIPADO Y REQUISITOS TÉCNICOS DE CADA CAMPO (Deep Validation):
function validarNivelSuscripcion(array $nuevoUsuario): void
{
    // Comprobamos que cada campo cumpla con la estructura prevista (regex, longitud de cadenas, tipos de datos, (ej. edad debe ser int), etc.).
    // Si algún dato es técnicamente inválido (ej. email sin @), 400 Bad Request.

    // Validación de Nivel
    if (!in_array(strtolower($nuevoUsuario['nivel']), ['free', 'premium'])) {
        http_response_code(400);
        exit("❌ Error 400: El 'nivel' tiene que ser 'free' o 'premium'.");
    }
}
    // ¡SE REUTILIZA DE GET: PASO 5 GET validarFormatoCURP()! 


//  PASO 7 POST. ESTABLECER CONEXIÓN CON LA PERSISTENCIA:
    // ¡SE REUTILIZA DE GET: PASO 6 GET cargarDatos()!

//  PASO 8 POST. VALIDAR UNICIDAD DEL RECURSO:
function evitarDuplicidad(array $usuarios_db, string $curp): void
{
    // Buscamos si ya existe un registro con el mismo identificador único (ej. CURP duplicada).
    // Si el recurso ya existe en el sistema, 409 Conflict para evitar duplicados.
    if (isset($usuarios_db[strtoupper($curp)])) {
        http_response_code(409);
        exit("❌ Error 409: El usuario con CURP '$curp' ya existe en el sistema.");
    }
}

//  PASO 9 POST. VALIDAR REGLAS DE NEGOCIO:
//  EJEMPLO: 
/*  function validarReglasNegocioPOST(array $datos): void
{
    // Verificamos condiciones lógicas avanzadas (ej. ¿Hay cupo disponible? ¿El usuario es mayor de edad?).
    // Si no cumple la lógica operativa, 422 Unprocessable Entity (o 403 Forbidden).

    // Ejemplo: No permitir registros de usuarios 'premium' si el nombre es demasiado corto
    if (strtolower($datos['nivel']) === 'premium' && strlen($datos['nombre']) < 3) {
        http_response_code(422);
        exit("❌ Error 422: Los usuarios Premium requieren un nombre real completo.");
    }
}*/
    
//  PASO 10 POST. PREPARACIÓN E HIDRATACIÓN DEL RECURSO (Resource Preparation): 
//  EJEMPLO: 
function hidratarRecurso(array $nuevoUsuario): array
{
    // Asignamos valores automáticos como IDs, UUIDs o marcas de tiempo (created_at).
    // Si ocurre un error al construir el objeto final, 500 Internal Server Error.
    $nuevoUsuario['curp'] = strtoupper($nuevoUsuario['curp']);
    return $nuevoUsuario;
}

function prepararRecurso(array $usuarios_db, array $nuevoUsuario): array
{
    //  Se prepara el array de usuariosActuales para agregar la entrada del nuevo usuario. 
    $usuarios_db[$nuevoUsuario['curp']] = $nuevoUsuario;
    return $usuarios_db;   // Devolvemos el array completo
}

//  PASO 11 POST. PERSISTENCIA DE DATOS (Data Storage):
function persistenciaDatos(string $rutaArchivo, array $usuarios_db): void
{
    // json_encode convierte el array en una cadena de texto formateada en JSON
    $jsonFinal = json_encode($usuarios_db, JSON_PRETTY_PRINT);

    //  Ejecutamos la acción de guardado o escritura definitiva en la fuente de datos.
    $resultadoEscritura = file_put_contents($rutaArchivo, $jsonFinal, LOCK_EX);

    // Si la escritura falla o no se confirma el guardado, 500 Internal Server Error.
    if ($resultadoEscritura === false){    
        http_response_code(500);
        exit("❌ Error 500: Fallo crítico al escribir en el disco. No se pudieron guardar los datos en el servidor.");
    }
}

//  PASO 12 POST. VALIDAR ÉXITO DE LA OPERACIÓN (Final Integrity Check):
function confirmarGuardadoExitoso(string $rutaArchivo, string $curp): void
{
    // Confirmamos que el registro realmente se guardó y es recuperable antes de avisar al cliente.
    // Si el registro no se encuentra tras intentar guardarlo, se lanza un error 500 Internal Server Error.

    // 1. Volvemos a leer la fuente de datos fresca desde el disco
    $usuariosRecienGuardados = cargarDatos($rutaArchivo);   // ¡REUTILIZADA DE GET: PASO 5 GET!

    // 2. Verificamos si el nuevo recurso realmente existe en esa lectura
    if (!isset($usuariosRecienGuardados[$curp])) {
        http_response_code(500);
        exit("❌ Error 500: Error de integridad. El usuario fue procesado, pero no se encuentra en el almacenamiento.");
    }
    
    // 3. Si llegó aquí, la persistencia fue real y verificada
    echo "✅ Verificación de integridad: El recurso se confirmó en el almacenamiento.\n";
}

//  PASO 13 POST. RESPONDER CON RESULTADO DE CREACIÓN (Created Response):
function responderCreacion(array $usuarioFinal): void
{
    // Confirmamos que el registro realmente se guardó y es recuperable antes de avisar al cliente.
    // Si el registro no se encuentra tras intentar guardarlo, se lanza un error 500 Internal Server Error.
    header('Content-Type: application/json');
    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Recurso creado y verificado",
        "data" => $usuarioFinal
    ], JSON_PRETTY_PRINT);
}



echo "81. MÉTODO POST EN HTTP\n\n";

echo "81.1 INTRODUCCIÓN AL MÉTODO POST\n\n";

echo "El método POST es uno de los métodos HTTP más comunes y se utiliza para ENVIAR DATOS AL SERVIDOR.
Cuando un cliente realiza una solicitud POST, está enviando datos al servidor que el servidor puede procesar para 
crear un nuevo recurso o actualizar uno existente en función de la URL especificada en la solicitud.\n\n\n\n";


echo "81.2 OBJETIVO Y PASOS DEL MÉTODO POST\n\n";

echo "El objetivo es ENVIAR DATOS AL SERVIDOR para crear nuevos recursos (NO IDEMPOTENTE) mediante los siguientes pasos:

    PASO 1. VALIDAR EL TIPO DE CONTENIDO (Content-Type Header):
        Verificamos que el cliente declare qué formato está enviando (ej. 'application/json' o 'application/x-www-form-urlencoded' o 'multipart/form-data').
            Si el encabezado no coincide con lo que el servidor puede procesar, se lanza un error 415 Unsupported Media Type.
    PASO 2. VALIDAR REGLAS DE ACCESO Y AUTORIZACIÓN (Auth Guard):
        Igual que con GET, verificamos si el cliente tiene credenciales válidas y permisos para crear este recurso específico.
            Si no está autenticado, 401 Unauthorized. Si no tiene permisos, 403 Forbidden.
    PASO 3. CAPTURA Y VALIDACIÓN DE EXISTENCIA DEL CUERPO (Body Presence):
        Garantizamos que el cuerpo (php://input o \$_POST) no esté vacío y sea legible.
            Si el cuerpo es nulo o el JSON está malformado, 400 Bad Request.
    PASO 4. VALIDAR PRESENCIA DE CAMPOS OBLIGATORIOS (Schema Validation):
        Aseguramos que el cuerpo contenga todas las llaves necesarias (ej. nombre, curp, email).
            Si falta algún campo esencial para el registro, 400 Bad Request.
    PASO 5. SANITIZACIÓN DE LOS DATOS DE ENTRADA DE CADA CAMPO:
        Limpiamos cada campo de caracteres sospechosos, etiquetas HTML o espacios para prevenir inyecciones.
            Si el resultado tras limpiar es invalido o vacío, 400 Bad Request.
    PASO 6. VALIDAR FORMATO, TIPADO Y REQUISITOS TÉCNICOS DE CADA CAMPO (Deep Validation):
        Comprobamos que cada campo cumpla con la estructura prevista (regex, longitud de cadenas, tipos de datos, (ej. edad debe ser int), etc.).
            Si algún dato es técnicamente inválido (ej. email sin @), 400 Bad Request.
    PASO 7. ESTABLECER CONEXIÓN CON LA PERSISTENCIA [Igual que PASO 6 GET]:
        Iniciamos el canal con la Base de Datos o sistema de archivos.
            Si la conexión falla, se lanza un 500 Internal Server Error.
    PASO 8. VALIDAR UNICIDAD DEL RECURSO (Collision Check):
        Buscamos si ya existe un registro con el mismo identificador único (ej. CURP duplicada).
            Si el recurso ya existe en el sistema, 409 Conflict para evitar duplicados.
    PASO 9. VALIDAR REGLAS DE NEGOCIO (Business Logic):
        Verificamos condiciones lógicas avanzadas (ej. ¿Hay cupo disponible? ¿El usuario es mayor de edad?).
            Si no cumple la lógica operativa, 422 Unprocessable Entity (o 403 Forbidden).
    PASO 10. PREPARACIÓN E HIDRATACIÓN DEL RECURSO (Resource Preparation):
        Asignamos valores automáticos como IDs, UUIDs o marcas de tiempo (created_at).
            Si ocurre un error al construir el objeto final, 500 Internal Server Error.
    PASO 11. PERSISTENCIA DE DATOS (Data Storage):
        Ejecutamos la acción de guardado o escritura definitiva en la fuente de datos.    
            Si la escritura falla o no se confirma el guardado, 500 Internal Server Error.
    PASO 12. VALIDAR ÉXITO DE LA OPERACIÓN (Final Integrity Check):
        Confirmamos que el registro realmente se guardó y es recuperable antes de avisar al cliente.
            Si el registro no se encuentra tras intentar guardarlo, se lanza un error 500 Internal Server Error.
    PASO 13. RESPONDER CON RESULTADO DE CREACIÓN (Created Response):
        Enviamos el recurso creado (o su ID) y el encabezado de éxito.
            Se responde con un código 201 Created y el cuerpo en formato JSON.";

echo "ACLARACIÓN: Los pasos son sólo una guía general y pueden variar según las necesidades específicas de tu aplicación y la lógica de negocio que estés implementando, 
pero seguir esta estructura te ayudará a mantener tu código organizado, claro y fácil de mantener.\n\n\n\n";



echo "81.3 CARACTERÍSTICAS DEL MÉTODO POST\n\n";

echo "El método POST tiene varias características importantes, incluyendo:

    1. NO IDEMPOTENTE: Las solicitudes POST pueden tener efectos secundarios en el servidor y no pueden ser repetidas sin causar cambios adicionales en el servidor.
    2. NO SEGURO: Las solicitudes POST pueden modificar los datos en el servidor y pueden causar cambios en el estado del servidor.
    3. DATOS EN EL CUERPO DE LA SOLICITUD: Los datos enviados con una solicitud POST se incluyen en el cuerpo de la solicitud (request body) en lugar de en la URL, lo que permite enviar grandes cantidades de datos y datos más complejos que no se pueden incluir fácilmente en la URL.
    4. NO LIMITACIONES DE LONGITUD: A diferencia de las solicitudes GET, las solicitudes POST no tienen limitaciones de longitud en los datos enviados, lo que las hace adecuadas para enviar grandes cantidades de datos o datos complejos, como archivos o formularios con muchos campos.
    5. NO CACHÉ: Las respuestas a las solicitudes POST generalmente no se almacenan en caché por los navegadores y servidores, lo que significa que cada solicitud POST se procesa de manera independiente y no se reutilizan respuestas anteriores.
    6. SEGURIDAD: Dado que los datos enviados con una solicitud POST se incluyen en el cuerpo de la solicitud, no son visibles en los registros del servidor, en el historial del navegador y en otros lugares, lo que puede ser más seguro para enviar datos sensibles en comparación con las solicitudes GET, donde los datos se incluyen en la URL.\n\n\n\n";



echo "81.4 USOS COMUNES DEL MÉTODO POST\n\n";
echo "El método POST se utiliza comúnmente para:

    1. ENVIAR FORMULARIOS: Las solicitudes POST se utilizan para enviar datos de formularios desde el cliente al servidor, como en el caso de formularios de registro, inicio de sesión, contacto, etc.
    2. CREAR RECURSOS: Las solicitudes POST se utilizan para crear nuevos recursos en el servidor cuando se envían datos que el servidor puede procesar para crear un nuevo recurso, como en el caso de crear un nuevo usuario, una nueva publicación, etc.
    3. ACTUALIZAR RECURSO: Las solicitudes POST también se pueden utilizar para actualizar recursos existentes cuando se envían datos que el servidor puede procesar para actualizar un recurso existente, como en el caso de actualizar la información de un usuario, modificar una publicación, etc.
    4. ENVIAR ARCHIVOS: Las solicitudes POST se utilizan para enviar archivos desde el cliente al servidor, como en el caso de subir imágenes, documentos, etc.\n\n\n\n";



echo "81.5 VARIABLE GLOBAL \$_POST\n\n";

echo "En PHP, la variable global \$_POST es un array asociativo que contiene los datos enviados en el cuerpo de una solicitud POST.
Cuando un cliente realiza una solicitud POST con datos en el cuerpo de la solicitud, PHP automáticamente llena el array de la variable \$_POST con los valores de esos datos, esto permite a los desarrolladores acceder fácilmente a los datos enviados por el client a través del cuerpo de la solicitud.\n\n";


