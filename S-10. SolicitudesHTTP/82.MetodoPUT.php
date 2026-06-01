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
        // 'POST' => ejecutarLogicaPost($rutaArchivo, $camposRequeridos),
        'PUT' => ejecutarLogicaPut($rutaArchivo, $camposRequeridos),
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
    // VÉASE 81.MetodoPOST.php para la lógica de negocio de POST desde un archivo JSON, que es la misma que usaríamos aquí. 
}
function ejecutarLogicaPut(string $rutaArchivo, array $camposRequeridos)
{
    //  PASO 1 PUT. VALIDAR EL TIPO DE CONTENIDO (Content-Type Header) [Igual que PASO 1 POST]:
    validationContentType();    // ¡SE REUTILIZA DE POST: PASO 1 POST!

    //  PASO 2 PUT. VALIDAR REGLAS DE ACCESO Y AUTORIZACIÓN (Auth Guard) [Igual que PASO 2 POST]:
    verificarAutorizacionPOST();    // ¡SE REUTILIZA DE POST: PASO 2 POST!

    //  PASO 3 PUT. VALIDAR PRESENCIA DEL PARÁMETRO (IDENTIFICADOR) EN LA URL (Guard Clause) [Igual que PASO 1 GET]:
    verificarPresenciaCURP();   // ¡SE REUTILIZA DE GET: PASO 1 GET!

    //  PASO 4 PUT. VALIDAR QUE EL PARÁMETRO (IDENTIFICADOR) NO ESTÉ VACÍO (Guard Clause) [Igual que PASO 2 GET]:
    $curpIngresada = validarContenidoCURP();    // ¡SE REUTILIZA DE GET: PASO 2 GET!

    //  PASO 5 PUT. CAPTURA Y VALIDACIÓN DE EXISTENCIA DEL CUERPO (Body Presence) [Igual que PASO 3 POST]:
    $nuevoUsuario = capturarCuerpoSolicitud();  // ¡SE REUTILIZA DE POST: PASO 3 POST!

    //  PASO 6 PUT. VALIDAR PRESENCIA DE CAMPOS OBLIGATORIOS (Schema Validation) [Igual que PASO 4 POST]:
    $nuevoUsuario = validarDatosNecesarios($nuevoUsuario, $camposRequeridos);   // ¡SE REUTILIZA DE POST: PASO 4 POST!

    //  PASO 7 PUT. SANITIZACIÓN DEL PARÁMETRO (IDENTIFICADOR) [Igual que PASO 4 GET] Y DE LOS DATOS DE ENTRADA [Igual que PASO 5 POST]:
    $curpIngresada = sanitizarCURP($curpIngresada); // ¡SE REUTILIZA DE GET: PASO 4 GET!
    $nuevoUsuario = sanitizarDatosPOST($nuevoUsuario);  // ¡SE REUTILIZA DE POST: PASO 5 POST!

    //  PASO 8 PUT. VALIDAR FORMATO Y REQUISITOS TÉCNICOS DEL IDENTIFICADOR [Igual que PASO 5 GET] Y DE CADA CAMPO [Igual que PASO 6 POST]:
    $curpIngresada = validarFormatoCURP($curpIngresada);    // ¡SE REUTILIZA DE GET: PASO 5 GET!
    validarNivelSuscripcion($nuevoUsuario); // ¡SE REUTILIZA DE POST: PASO 6 POST!

    //  PASO 9 PUT. COMPROBACIÓN DE CONSISTENCIA DE IDENTIFICADORES (ID Matching):
    consistenciaDeIdentificadores ($curpIngresada, $nuevoUsuario['curp']);

    //  PASO 10 PUT. ESTABLECER CONEXIÓN CON LA PERSISTENCIA [Igual que PASO 6 GET -y PASO 7 POST-]:
    $usuarios_db = cargarDatos($rutaArchivo);   // ¡SE REUTILIZA DE GET: PASO 6 GET!

    //  PASO 11 PUT. VALIDAR DISPONIBILIDAD DE LA FUENTE DE DATOS (Guard Clause) [Igual que PASO 7 GET]:
    validarDisponibilidadFuente($usuarios_db);  // ¡SE REUTILIZA DE GET: PASO 7 GET!

    //  PASO 12 PUT. VALIDAR EXISTENCIA DEL RECURSO ESPECÍFICO (Guard Clause) [Igual que PASO 8 GET]:
    validarExistenciaRecurso($usuarios_db, $curpIngresada); // ¡SE REUTILIZA DE GET: PASO 8 GET!

    //  PASO 13. VALIDAR REGLAS DE NEGOCIO (Business Logic) [Igual que PASO 9 POST]:
    
    //  PASO 14. PREPARACIÓN Y (RE-)HIDRATACIÓN DEL RECURSO (Resource Preparation) [Igual que PASO 10 POST]:
    $nuevoUsuario = hidratarRecurso($nuevoUsuario); // ¡SE REUTILIZA DE POST: PASO 10 POST!
    $usuarios_db = prepararRecurso($usuarios_db, $nuevoUsuario);    // ¡SE REUTILIZA DE POST: PASO 10 POST! 

    //  PASO 15. PERSISTENCIA DE DATOS (Data Storage) [Igual que PASO 11 POST]:
    persistenciaDatos($rutaArchivo, $usuarios_db);  // ¡SE REUTILIZA DE POST: PASO 11 POST!

    //  PASO 16. VALIDAR ÉXITO DE LA OPERACIÓN (Final Integrity Check) [Igual que PASO 12 POST]:
    confirmarGuardadoExitoso($rutaArchivo, $nuevoUsuario['curp']);  // ¡SE REUTILIZA DE POST: PASO 12 POST!

    //  PASO 17. RESPONDER CON RESULTADO DE CREACIÓN (Created Response) [Igual que PASO 13 POST]:
    responderActualizacion($nuevoUsuario);  
}
function ejecutarLogicaDelete()
{
    // Aquí va el demás código específico para DELETE
}
function lanzarError405()
{
    http_response_code(405);
    header("Allow: DELETE");    // Esto es para indicar al cliente qué métodos HTTP sí están permitidos en esta ruta, lo que es una buena práctica para mejorar la comunicación entre el cliente y el servidor.
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



// 5.3 FUNCIONES PUT

//  PASO 1 PUT. VALIDAR EL TIPO DE CONTENIDO (Content-Type Header) [Igual que PASO 1 POST]:
    // ¡SE REUTILIZA DE POST: PASO 1 POST validationContentType()!

//  PASO 2 PUT. VALIDAR REGLAS DE ACCESO Y AUTORIZACIÓN (Auth Guard) [Igual que PASO 2 POST]:
    // ¡SE REUTILIZA DE POST: PASO 2 POST verificarAutorizacionPOST()!

//  PASO 3 PUT. VALIDAR PRESENCIA DEL PARÁMETRO (IDENTIFICADOR) EN LA URL (Guard Clause) [Igual que PASO 1 GET]:
    // ¡SE REUTILIZA DE GET: PASO 1 GET verificarPresenciaCURP()!

//  PASO 4 PUT. VALIDAR QUE EL PARÁMETRO (IDENTIFICADOR) NO ESTÉ VACÍO (Guard Clause) [Igual que PASO 2 GET]:
    // ¡SE REUTILIZA DE GET: PASO 2 GET validarContenidoCURP()!

//  PASO 5 PUT. CAPTURA Y VALIDACIÓN DE EXISTENCIA DEL CUERPO (Body Presence) [Igual que PASO 3 POST]:
    // ¡SE REUTILIZA DE POST: PASO 3 POST capturarCuerpoSolicitud()!

//  PASO 6 PUT. VALIDAR PRESENCIA DE CAMPOS OBLIGATORIOS (Schema Validation) [Igual que PASO 4 POST]:
    // ¡SE REUTILIZA DE POST: PASO 4 POST validarDatosNecesarios()!

//  PASO 7 PUT. SANITIZACIÓN DEL PARÁMETRO (IDENTIFICADOR) [Igual que PASO 4 GET] Y DE LOS DATOS DE ENTRADA [Igual que PASO 5 POST]:
    // ¡SE REUTILIZA DE GET: PASO 4 GET sanitizarCURP()!

    // ¡SE REUTILIZA DE POST: PASO 5 POST sanitizarDatosPOST()!

//  PASO 8. VALIDAR FORMATO Y REQUISITOS TÉCNICOS DEL IDENTIFICADOR [Igual que PASO 5 GET] Y DE CADA CAMPO [Igual que PASO 6 POST]:
    // ¡SE REUTILIZA DE GET: PASO 5 GET validarFormatoCURP()!
    
    // ¡SE REUTILIZA DE POST: PASO 6 POST validarNivelSuscripcion()!

//  PASO 9. COMPROBACIÓN DE CONSISTENCIA DE IDENTIFICADORES (ID Matching):
function consistenciaDeIdentificadores (string $curpURL, string $curpCuerpo){
    // Verificamos que el ID solicitado en la URL coincida exactamente con el ID enviado en el cuerpo JSON.
    // Si hay discrepancia, se lanza un error 400 Bad Request para evitar actualizaciones cruzadas accidentales.
    if (strtoupper($curpURL) !== strtoupper($curpCuerpo)) {
        http_response_code(400);
        exit("❌ Error 400: El CURP de la URL no coincide con el CURP del cuerpo.");
    }
} 

//  PASO 10 PUT. ESTABLECER CONEXIÓN CON LA PERSISTENCIA [Igual que PASO 6 GET -y PASO 7 POST-]:
    // ¡SE REUTILIZA DE GET: PASO 6 GET cargarDatos()!

//  PASO 11 PUT. VALIDAR DISPONIBILIDAD DE LA FUENTE DE DATOS (Guard Clause) [Igual que PASO 7 GET]:
    // ¡SE REUTILIZA DE GET: PASO 7 GET validarDisponibilidadFuente()!

//  PASO 12 PUT. VALIDAR EXISTENCIA DEL RECURSO ESPECÍFICO (Guard Clause) [Igual que PASO 8 GET]:
    // ¡SE REUTILIZA DE GET: PASO 8 GET validarExistenciaRecurso()!

//  PASO 13. VALIDAR REGLAS DE NEGOCIO (Business Logic) [Igual que PASO 9 POST]:
    
//  PASO 14. PREPARACIÓN Y (RE-)HIDRATACIÓN DEL RECURSO (Resource Preparation) [Igual que PASO 10 POST]:
    // ¡SE REUTILIZA DE POST: PASO 10 POST hidratarRecurso()!
    // ¡SE REUTILIZA DE POST: PASO 10 POST prepararRecurso()! 

//  PASO 15. PERSISTENCIA DE DATOS (Data Storage) [Igual que PASO 11 POST]:
    // ¡SE REUTILIZA DE POST: PASO 11 POST persistenciaDatos()!

//  PASO 16. VALIDAR ÉXITO DE LA OPERACIÓN (Final Integrity Check) [Igual que PASO 12 POST]:
    // ¡SE REUTILIZA DE POST: PASO 12 POST confirmarGuardadoExitoso()!

//  PASO 17. RESPONDER CON RESULTADO DE CREACIÓN (Created Response) [Igual que PASO 13 POST]:
function responderActualizacion(array $usuarioActualizado): void
{
    // Confirmamos que el registro realmente se guardó y es recuperable antes de avisar al cliente.
    // Si el registro no se encuentra tras intentar guardarlo, se lanza un error 500 Internal Server Error.
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "message" => "Recurso actualizado con éxito",
        "data" => $usuarioActualizado
    ], JSON_PRETTY_PRINT);
}



echo "82. MÉTODO PUT EN HTTP\n\n";

echo "82.1 INTRODUCCIÓN AL MÉTODO PUT\n\n";

echo "El método PUT es un verbo HTTP que se utiliza para enviar datos al servidor 
con el propósito de crear o actualizar un recurso específico.\n\n";

echo "A diferencia del método POST, que se utiliza principalmente para crear nuevos recursos,
el método PUT se utiliza para actualizar un recurso existente o crear uno nuevo si no existe.\n\n";

echo "Cuando se utiliza el método PUT, el cliente envía una representación completa del recurso que desea crear o actualizar al servidor,
y el servidor procesa esa representación para crear o actualizar el recurso correspondiente.\n\n\n\n";



echo "82.2 OBJETIVO Y PASOS DEL MÉTODO PUT\n\n";

echo "El objetivo es ACTUALIZAR UN RECURSO EXISTENTE O REEMPLAZARLO mediante los siguientes pasos:

    PASO 1. VALIDAR EL TIPO DE CONTENIDO (Content-Type Header) [Igual que PASO 1 POST]:
        Verificamos que el cliente declare qué formato está enviando (ej. 'application/json' o 'application/x-www-form-urlencoded' o 'multipart/form-data').
            Si el encabezado no coincide con lo que el servidor puede procesar, se lanza un error 415 Unsupported Media Type.
    PASO 2. VALIDAR REGLAS DE ACCESO Y AUTORIZACIÓN (Auth Guard) [Igual que PASO 2 POST]:
        Igual que con GET, verificamos si el cliente tiene credenciales válidas y permisos para crear este recurso específico.
            Si no está autenticado, 401 Unauthorized. Si no tiene permisos, 403 Forbidden.
    PASO 3. VALIDAR PRESENCIA DEL PARÁMETRO (IDENTIFICADOR) EN LA URL (Guard Clause) [Igual que PASO 1 GET]:
        Verificamos la existencia del parámetro (identificador) en la superglobal (ej. isset(\$_GET['id'])).
            Si el parámetro (identificador) NO está definido, se lanza un 400 Bad Request.
    PASO 4. VALIDAR QUE EL PARÁMETRO (IDENTIFICADOR) NO ESTÉ VACÍO (Guard Clause) [Igual que PASO 2 GET]:
        Garantizamos que el parámetro (identificador) enviado no sea una cadena vacía o solo espacios tras un trim().
            Si el dato está vacío, se lanza un 400 Bad Request.
    PASO 5. CAPTURA Y VALIDACIÓN DE EXISTENCIA DEL CUERPO (Body Presence) [Igual que PASO 3 POST]:
        Garantizamos que el cuerpo (php://input o \$_POST) no esté vacío y sea legible.
            Si el cuerpo es nulo o el JSON está malformado, 400 Bad Request.
    PASO 6. VALIDAR PRESENCIA DE CAMPOS OBLIGATORIOS (Schema Validation) [Igual que PASO 4 POST]:
        Aseguramos que el cuerpo contenga todas las llaves necesarias (ej. nombre, curp, email).
            Si falta algún campo esencial para el registro, 400 Bad Request.
    PASO 7. SANITIZACIÓN DEL PARÁMETRO (IDENTIFICADOR) [Igual que PASO 4 GET] Y DE LOS DATOS DE ENTRADA [Igual que PASO 5 POST]:
        Limpiamos el parámetro (identificador) y cada campo de caracteres sospechosos, etiquetas HTML o espacios para prevenir inyecciones.
            Si el resultado tras limpiar es invalido o vacío, 400 Bad Request.
    PASO 8. VALIDAR FORMATO Y REQUISITOS TÉCNICOS DEL IDENTIFICADOR [Igual que PASO 5 GET] Y DE CADA CAMPO [Igual que PASO 6 POST]:
        Comprobamos que el ID y que cada campo cumpla con la estructura técnica prevista (regex, longitud de cadenas, tipos de datos, (ej. edad debe ser int), etc.).
            Si algún dato es técnicamente inválido (ej. email sin @), 400 Bad Request.
    PASO 9. COMPROBACIÓN DE CONSISTENCIA DE IDENTIFICADORES (ID Matching):
        Verificamos que el ID solicitado en la URL coincida exactamente con el ID enviado en el cuerpo JSON.
            Si hay discrepancia, se lanza un error 400 Bad Request para evitar actualizaciones cruzadas accidentales.    
    PASO 10.ESTABLECER CONEXIÓN CON LA PERSISTENCIA [Igual que PASO 6 GET -y PASO 7 POST-]:
        Iniciamos el canal con la Base de Datos o sistema de archivos.
            Si la conexión falla, se lanza un 500 Internal Server Error.
    PASO 11.VALIDAR DISPONIBILIDAD DE LA FUENTE DE DATOS (Guard Clause) [Igual que PASO 7 GET]:
        Aseguramos que la tabla o archivo existan y sean accesibles.
            Si la fuente está corrupta o inaccesible, se lanza un 500 Internal Server Error.
    PASO 12.VALIDAR EXISTENCIA DEL RECURSO ESPECÍFICO (Guard Clause) [Igual que PASO 8 GET]:
        Validamos que el identificador exista en la persistencia. 
            Si el ID no existe en la persistencia, se lanza un 404 Not Found.
    PASO 13. VALIDAR REGLAS DE NEGOCIO (Business Logic) [Igual que PASO 9 POST]:
        Verificamos condiciones lógicas avanzadas (ej. ¿Hay cupo disponible? ¿El usuario es mayor de edad?).
            Si no cumple la lógica operativa, 422 Unprocessable Entity (o 403 Forbidden).
    PASO 14. PREPARACIÓN Y (RE-)HIDRATACIÓN DEL RECURSO (Resource Preparation) [Igual que PASO 10 POST]:
        Asignamos valores automáticos como IDs, UUIDs o marcas de tiempo (created_at).
            Si ocurre un error al construir el objeto final, 500 Internal Server Error. 
    PASO 15. PERSISTENCIA DE DATOS (Data Storage) [Igual que PASO 11 POST]:
        Ejecutamos la acción de guardado o escritura definitiva en la fuente de datos.    
            Si la escritura falla o no se confirma el guardado, 500 Internal Server Error.
    PASO 16. VALIDAR ÉXITO DE LA OPERACIÓN (Final Integrity Check) [Igual que PASO 12 POST]:
        Confirmamos que el registro realmente se guardó y es recuperable antes de avisar al cliente.
            Si el registro no se encuentra tras intentar guardarlo, se lanza un error 500 Internal Server Error.
    PASO 17. RESPONDER CON RESULTADO DE CREACIÓN (Created Response) [Igual que PASO 13 POST]:
        Enviamos el recurso creado (o su ID) y el encabezado de éxito.
            Se responde con un código 200 Ok y el cuerpo en formato JSON.\n\n";

echo "ACLARACIÓN: Los pasos son sólo una guía general y pueden variar según las necesidades específicas de tu aplicación y la lógica de negocio que estés implementando, 
pero seguir esta estructura te ayudará a mantener tu código organizado, claro y fácil de mantener.\n\n\n\n";



echo "81.3 CARACTERÍSTICAS DEL MÉTODO PUT\n\n";

echo "El método PUT tiene varias características importantes, incluyendo:

    1. IDEMPOTENTE: A diferencia de POST, PUT es idempotente. Esto significa que si realizas la misma solicitud PUT varias veces consecutivas, el resultado final en el servidor siempre será el mismo. El recurso quedará en el mismo estado sin importar si mandaste la petición una o diez veces.
    2. REEMPLAZO COMPLETO: El método PUT se utiliza para enviar una representación actualizada de un recurso. Es importante notar que, por convención, PUT reemplaza el recurso completo. Si solo envías un campo en el cuerpo de la petición, los campos que falten podrían borrarse o quedar vacíos, dependiendo de la implementación del servidor.
    3. DATOS EN EL CUERPO (Request Body): Al igual que POST, los datos se envían en el cuerpo de la solicitud. Esto permite enviar objetos complejos (generalmente en formato JSON o XML) y no tiene las restricciones de visibilidad o longitud de la URL que tiene GET.
    4. CREACIÓN VS. ACTUALIZACIÓN: Actualización: Si el recurso identificado por la URL existe, se actualiza con los datos enviados.
        Creación: Si el recurso no existe, el servidor puede optar por crearlo usando exactamente esa URL proporcionada por el cliente.
    5. NO SEGURO
    Al igual que POST, se considera un método no seguro porque su objetivo principal es modificar el estado del servidor (cambiar o crear datos).
    6. DIFERENCIA CLAVE CON POST
    La principal diferencia radica en la responsabilidad de la URL:
        En POST, el cliente envía datos a una colección (ej. /usuarios) y el servidor decide la ID del nuevo recurso.
        En PUT, el cliente especifica la ubicación exacta del recurso (ej. /usuarios/123). El cliente sabe exactamente qué registro está afectando.\n\n\n\n";



echo "81.4 USOS COMUNES DEL MÉTODO PUT\n\n";
echo "El método PUT se utiliza comúnmente para:

    1. ACTUALIZACIÓN INTEGRAL DE RECURSOS: Se usa para modificar un recurso existente enviando la versión completa y actualizada del mismo. Si el recurso en el servidor tiene campos que no se incluyen en la solicitud PUT, estos suelen ser eliminados o reseteados.
    2. CREACIÓN EN UNA URL ESPECÍFICA: A diferencia de POST, PUT se usa para crear un recurso cuando el cliente ya conoce la URL exacta donde debe residir (por ejemplo, .../users/ID_YA_DEFINIDA).
    3. CARGA DE ARCHIVOS ESPECÍFICOS: Se utiliza en escenarios donde se desea subir un archivo a una ruta de destino exacta, reemplazando cualquier contenido previo en esa ubicación.
    4. SINCRONIZACIÓN DE ESTADO: Es ideal para aplicaciones que mantienen una copia local de los datos y necesitan asegurarse de que el servidor tenga exactamente la misma versión que el cliente.\n\n\n\n";





