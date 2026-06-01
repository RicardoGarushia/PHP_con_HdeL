<?php
// 3. LÓGICA DE NEGOCIO: Aquí es donde va tu lógica de negocio para cada método HTTP.

// 3.1 Lógica para GET
function ejecutarLogicaGet()
{
    // 1. Validamos presencia y formato
    $curp = curpEstablecidoYLleno();
    $curp = curpFormatoValido($curp);

    // 2. Recuperamos los usuarios desde el archivo JSON
    $usuarios_db = cargarUsuarios($rutaArchivo);

    // 3. Buscamos al usuario solicitado
    $usuario = $usuarios_db[$curp] ?? null; // Si el curp no existe, devolvemos null

    // 4. Validamos existencia y nivel con los datos obtenidos
    validarExistencia($usuario, $curp);
    validarNivelPremium($usuario);

    echo "✅ Acceso total concedido a los datos de: " . $usuario['nombre'] . " " . $usuario['apellidoP'] . " " . $usuario['apellidoM'] . "\n\n";
}

// 3.2 Lógica para POST
function ejecutarLogicaPost(string $rutaArchivo)
{
    // 1. GUARD CLAUSE: Verificar que el cliente envía JSON. Buscamos si el string "application/json" existe en el encabezado
    $contentType = $_SERVER["CONTENT_TYPE"] ?? '';  // OPERADOR DE COALESCENCIA: SiExisteYNoEsNULL_UsaEste ?? SiNOExisteOEsNULL_UsaEsto 

    if (stripos($contentType, 'application/json') === false)    // === es comparación estricta, no hace conversiones raras de tipos. 
    // stripos() devuelve la posición de la primera aparición de un substring en un string, ignorando mayúsculas y minúsculas. Si no encuentra el substring, devuelve false. 
    // Por eso comparamos con false, para saber si no se encontró "application/json" en el encabezado Content-Type.
    {
        responderError(415, "Esta API solo acepta contenido de tipo 'application/json'.\nDetectado: $contentType");
    }

    // 2. EXTRAER: Obtener los datos del cuerpo de la solicitud (JSON) mediante la función file_get_contents del envoltorio ('php://...) del flujo de entrada (...input') de solo lectura php://input 
    // El envoltorio (wrapper) 'php://' es un "protocolo" de información similar a 'http://', 'file://' que le indica de dónde extraer los datos. 
    // En este caso, 'php://input' es un flujo de solo lectura que permite acceder al cuerpo de la solicitud HTTP tal como fue enviado por el cliente, sin procesar ni modificar. 
    // Es especialmente útil para leer datos en formatos como JSON o XML que se envían en el cuerpo de la solicitud POST, PUT, etc., ya que a diferencia de $_POST, no hace suposiciones sobre el formato de los datos y no los procesa automáticamente.
    $jsonRecibido = file_get_contents('php://input');

    // 3. GUARD CLAUSE: Verificar que se recibió algo en el cuerpo de la solicitud
    if (empty($jsonRecibido)) {
        responderError(400, "No se recibió ningún dato en el cuerpo de la solicitud POST.\n" .
            "Asegúrate de enviar un JSON válido en el cuerpo de la solicitud.");
    }

    // 4. Utilizar la función json_decode() para convertir el JSON a un Array Asociativo de PHP
    $nuevoUsuario = json_decode($jsonRecibido, true);   // Recuerda que si omites el true obtendrás un Objeto en lugar de un Array, y tendrías que acceder a los campos con $nuevoUsuario->curp en lugar de $nuevoUsuario['curp'].

    // 5. GUARD CLAUSE: Verificar que el JSON recibido sea válido
    if (json_last_error() !== JSON_ERROR_NONE) {
        // json_last_error() devuelve el último error ocurrido durante la decodificación (json_decode) o codificación (json_encode) JSON. JSON_ERROR_NONE indica que no hubo errores, por lo que si el resultado es diferente, significa que hubo un error en el JSON recibido.
        responderError(400, "No se recibió un JSON válido en el cuerpo de la solicitud POST.\n" .
            "Error de JSON: " . json_last_error_msg());
        // json_last_error_msg() devuelve un mensaje de error descriptivo para el último error ocurrido durante la decodificación o codificación JSON, lo que ayuda a identificar qué salió mal con el JSON recibido.
    }

    // 6. VALIDACIÓN: Verificar que el nuevo usuario tenga los campos necesarios (curp, nombre, apellidoP, apellidoM, nivel) 
    $camposRequeridos = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'nivel'];
    foreach ($camposRequeridos as $campo) {
        if (!isset($nuevoUsuario[$campo]) || empty(trim($nuevoUsuario[$campo]))) {
            // isset() verifica que el campo exista en el array, y empty() verifica que no esté vacío (después de eliminar espacios con trim()). 
            // Si alguna de estas condiciones falla, se devuelve un error 400 indicando que el campo es requerido.
            responderError(400, "El campo '$campo' es requerido y no puede estar vacío.\n" .
                "Asegúrate de incluir todos los campos necesarios en el JSON.");
        }
    }

    // 7. VALIDACIÓN: Verificar que el curp tenga un formato válido
    $nuevoUsuario['curp'] = curpFormatoValido($nuevoUsuario['curp']);

    // 8. VALIDACIÓN: Verificar que el nivel tenga un valor válido
    if (!in_array($nuevoUsuario['nivel'], ['basico', 'premium'])) {
        responderError(400, "El campo 'nivel' debe ser 'basico' o 'premium'.\n" .
            "Asegúrate de incluir un valor válido para el campo 'nivel' en el JSON.");
    }

    // 8. PERSISTENCIA: Aquí es donde guardarías el nuevo usuario en tu base de datos o archivo JSON.
    // Si el archivo no existe, empezamos con un array vacío. Sí existe, lo leemos y convertimos a un array para agregar el nuevo usuario.
    $usuarios_db = cargarUsuarios($rutaArchivo);

    // 9. Verificar que el curp del nuevo usuario no exista ya en la base de datos
    if (isset($usuarios_db[$nuevoUsuario['curp']])) {
        responderError(409, "El usuario con CURP '" . $nuevoUsuario['curp'] . "' ya existe.\n" .
            "Asegúrate de enviar un CURP único para cada nuevo usuario.");
    }

    // 10. Agregar al array y guardar
    $usuarios_db[$nuevoUsuario['curp']] = $nuevoUsuario;

    file_put_contents($rutaArchivo, json_encode($usuarios_db, JSON_PRETTY_PRINT));
    // La función file_put_contents() escribe datos en un archivo. 
    // En este caso, estamos escribiendo el array de usuarios actualizado (convertido a JSON con json_encode) en el archivo usuarios.json. 
    // El flag JSON_PRETTY_PRINT hace que el JSON se guarde con una estructura legible y ordenada, lo que facilita su lectura y mantenimiento.

    http_response_code(201);
    echo "✅ Usuario con CURP '" . $nuevoUsuario['curp'] . "' creado exitosamente.";
}

// 3.3 Lógica para PUT
function ejecutarLogicaPut(string $rutaArchivo)
{
    // 1. GUARD CLAUSE: Verificar que el cliente envía JSON. 
    // Buscamos si el string "application/json" existe en el encabezado
    $headers = array_change_key_case(getallheaders(), CASE_UPPER);
    $contentType = $headers['CONTENT-TYPE'] ?? $_SERVER["CONTENT_TYPE"] ?? '';

    if (stripos($contentType, 'application/json') === false) {
        responderError(415, "Esta API solo acepta 'application/json'.\nDetectado: $contentType");
    }

    if (stripos($contentType, 'application/json') === false)    // === es comparación estricta, no hace conversiones raras de tipos. 
    // stripos() devuelve la posición de la primera aparición de un substring en un string, ignorando mayúsculas y minúsculas. Si no encuentra el substring, devuelve false. 
    // Por eso comparamos con false, para saber si no se encontró "application/json" en el encabezado Content-Type.
    {
        responderError(415, "Esta API solo acepta contenido de tipo 'application/json'.\nDetectado: $contentType");
    }

    // 2. EXTRAER: Obtener los datos del cuerpo de la solicitud (JSON) mediante la función file_get_contents del envoltorio ('php://...) del flujo de entrada (...input') de solo lectura php://input 
    // El envoltorio (wrapper) 'php://' es un "protocolo" de información similar a 'http://', 'file://' que le indica de dónde extraer los datos. 
    // En este caso, 'php://input' es un flujo de solo lectura que permite acceder al cuerpo de la solicitud HTTP tal como fue enviado por el cliente, sin procesar ni modificar. 
    // Es especialmente útil para leer datos en formatos como JSON o XML que se envían en el cuerpo de la solicitud POST, PUT, etc., ya que a diferencia de $_POST, no hace suposiciones sobre el formato de los datos y no los procesa automáticamente.
    $jsonRecibido = file_get_contents('php://input');

    // 3. GUARD CLAUSE: Verificar que se recibió algo en el cuerpo de la solicitud
    if (empty($jsonRecibido)) {
        responderError(400, "No se recibió ningún dato en el cuerpo de la solicitud POST.\n" .
            "Asegúrate de enviar un JSON válido en el cuerpo de la solicitud.");
    }

    // 4. Utilizar la función json_decode() para convertir el JSON a un Array Asociativo de PHP
    $datosNuevos = json_decode($jsonRecibido, true);   // Recuerda que si omites el true obtendrás un Objeto en lugar de un Array, y tendrías que acceder a los campos con $nuevoUsuario->curp en lugar de $nuevoUsuario['curp'].

    // 5. GUARD CLAUSE: Verificar que el JSON recibido sea válido
    if (json_last_error() !== JSON_ERROR_NONE) {
        // json_last_error() devuelve el último error ocurrido durante la decodificación (json_decode) o codificación (json_encode) JSON. JSON_ERROR_NONE indica que no hubo errores, por lo que si el resultado es diferente, significa que hubo un error en el JSON recibido.
        responderError(400, "No se recibió un JSON válido en el cuerpo de la solicitud POST.\n" .
            "Error de JSON: " . json_last_error_msg());
        // json_last_error_msg() devuelve un mensaje de error descriptivo para el último error ocurrido durante la decodificación o codificación JSON, lo que ayuda a identificar qué salió mal con el JSON recibido.
    }

    // 6. GUARD CLAUSE: Verificar que el JSON recibido tenga el campo 'curp' y contenga un valor para identificar qué usuario se va a actualizar
    // isset() verifica que el campo exista en el array
    // empty() verifica que no esté vacío (después de eliminar espacios con trim()). 
    if (!isset($datosNuevos['curp']) || empty(trim($datosNuevos['curp']))) {
        responderError(400, "El campo 'curp' es requerido para identificar qué usuario se va a actualizar y no puede estar vacío.\n" .
            "Asegúrate de incluir el campo 'curp' con un valor válido en el JSON.");
    }

    // 7. VALIDACIÓN: Verificar que el curp tenga un formato válido
    $curpIdentificador = curpFormatoValido($datosNuevos['curp']);

    // 8. PERSISTENCIA: Cargar la base de datos actual para verificar que el usuario a actualizar exista y luego actualizarlo con los nuevos datos.
    $usuarios_db = cargarUsuarios($rutaArchivo);

    // 9. GUARD CLAUSE: ¿Existe el usuario que queremos editar?
    if (!isset($usuarios_db[$curpIdentificador])) {
        responderError(404, "No se puede actualizar: El usuario con CURP '$curpIdentificador' NO existe.");
    }

    // 10. VALIDACIÓN: Verificar que los nuevos datos tenga los campos necesarios (curp, nombre, apellidoP, apellidoM, nivel) 
    $camposRequeridos = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'nivel'];
    foreach ($camposRequeridos as $campo) {
        // isset() verifica que el campo exista en el array
        // empty() verifica que no esté vacío (después de eliminar espacios con trim()). 
        if (!isset($datosNuevos[$campo]) || empty(trim($datosNuevos[$campo]))) {
            // Si alguna de estas condiciones falla, se devuelve un error 400 indicando que el campo es requerido.
            responderError(400, "El campo '$campo' es requerido y no puede estar vacío.\n" .
                "Asegúrate de incluir todos los campos necesarios en el JSON.");
        }
    }

    // 11. VALIDACIÓN: Verificar que el nivel tenga un valor válido
    // la función in_array() verifica si un valor existe en un array. 
    // En este caso, verificamos si el valor del campo 'nivel' está dentro del array ['basico', 'premium']. 
    // Si no está, devolvemos un error 400 indicando que el valor es inválido.
    if (!in_array($datosNuevos['nivel'], ['basico', 'premium'])) {
        responderError(400, "El campo 'nivel' debe ser 'basico' o 'premium'.\n" .
            "Asegúrate de incluir un valor válido para el campo 'nivel' en el JSON.");
    }


    // 12. ACTUALIZACIÓN: Aquí es donde actualizarías el usuario en tu base de datos o archivo JSON.
    // En este ejemplo, simplemente reemplazamos el usuario existente con el nuevo usuario enviado en el JSON. 
    // En un caso real, podrías querer actualizar solo algunos campos en lugar de reemplazar todo el usuario.
    $usuarios_db[$curpIdentificador] = $datosNuevos;

    // 7. PERSISTENCIA
    if (file_put_contents($rutaArchivo, json_encode($usuarios_db, JSON_PRETTY_PRINT))) {
        echo "🆙 Usuario con CURP '$curpIdentificador' actualizado exitosamente.";
    } else {
        responderError(500, "Error al escribir en el servidor.");
    }
}

// 3.4 Lógica para DELETE
function ejecutarLogicaDelete(string $rutaArchivo)
{
    // 1. Validamos presencia y formato
    $curpABorrar = curpEstablecidoYLleno();
    $curpABorrar = curpFormatoValido($curpABorrar);

    // 2. Recuperamos los usuarios desde el archivo JSON
    $usuarios_db = cargarUsuarios($rutaArchivo);

    // 3. GUARD CLAUSE: ¿Existe el usuario?
    if (!isset($usuarios_db[$curpABorrar])) {
        responderError(404, "No se puede eliminar: El usuario con CURP '$curpABorrar' NO existe.");
    }

    // 4. ELIMINACIÓN: Usamos la función unset()
    // Esta función destruye la variable o la llave del array que le pases.
    unset($usuarios_db[$curpABorrar]);

    // 5. PERSISTENCIA: Guardamos el array modificado
    if (file_put_contents($rutaArchivo, json_encode($usuarios_db, JSON_PRETTY_PRINT))) {
        http_response_code(200); // OK
        echo "🗑️ Usuario con CURP '$curpABorrar' eliminado exitosamente.";
    } else {
        responderError(500, "Error crítico al intentar actualizar el archivo de usuarios.");
    }
}

