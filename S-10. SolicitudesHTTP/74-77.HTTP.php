<?php
header("Content-Type: text/plain");

echo "74. HTTP (HyperText Transfer Protocol)\n\n";

echo "74.1 ¿QUÉ ES HTTP?\n\n";

echo "HTTP es el protocolo de comunicación utilizado en la web
para la transferencia de datos entre clientes y servidores.
Permite a los usuarios acceder a páginas web, enviar formularios, interactuar con APIs,
y realizar diversas acciones en la web a través de solicitudes y respuestas HTTP.\n\n\n\n";



echo "74.2 COMPONENTES DE HTTP\n\n";

echo "El protocolo HTTP se compone de varios componentes clave, incluyendo:

    1. SOLICITUDES HTTP: Mensajes enviados por el cliente al servidor para solicitar recursos
    o realizar acciones específicas.
    2. RESPUESTAS HTTP: Mensajes enviados por el servidor al cliente en respuesta a
    las solicitudes HTTP, que contienen el resultado de la solicitud y los datos solicitados.
    3. MÉTODOS HTTP: Indican la acción que el cliente desea realizar 
    (GET - extraer datos, POST - insertar datos, PUT - modificar datos, DELETE - eliminar datos, etc.).
    4. CÓDIGOS DE ESTADO/RESPUESTA HTTP (Status Code): Indican el resultado de la solicitud 
    (200 OK, 404 Not Found, etc.).
    5. ENCABEZADOS HTTP: Proporcionan información adicional sobre la solicitud o respuesta
    como el tipo de contenido, la autenticación, etc.
    6. CUERPO HTTP: Contiene los datos enviados en la solicitud o respuesta,
    generalmente en formato JSON, XML, HTML, etc.\n\n\n\n";



echo "74.3 PROCESO HTTP\n\n";

echo "El proceso HTTP generalmente sigue estos pasos:

    1. El cliente envía una solicitud HTTP al servidor.
    2. El servidor recibe la solicitud y la procesa.
    3. El servidor genera una respuesta HTTP y la envía de vuelta al cliente.\n\n\n\n";



echo "74.4 COMPONENTES DE UNA SOLICITUD HTTP\n\n";

echo "Las solicitudes HTTP se componen de varios componentes, incluyendo:

    1. MÉTODO HTTP: Indica la acción que el cliente desea realizar
    (GET -extraer datos-, POST -insertar datos-, PUT -modificar datos-, DELETE -eliminar datos-, etc.).
    2. URL: La dirección del recurso al que se está accediendo.
    3. VERSIÓN HTTP: Indica la versión del protocolo HTTP que se está utilizando (HTTP/1.1, HTTP/2, etc.).
    4. HEADERS (Encabezados): Proporcionan información adicional sobre la solicitud, como el tipo de contenido, la autenticación, etc.
    5. BODY (Cuerpo): Contiene datos que se envían al servidor,
    generalmente en solicitudes POST o PUT, como datos de formularios o JSON.\n\n\n";


echo "74.4.1 EJEMPLO DE COMPONENTES DE UNA SOLICITUD HTTP\n\n";

echo "Ejemplo de una solicitud HTTP POST:\n\n";
echo "POST /api/users HTTP/1.1\n";
echo "Host: example.com\n";
echo "Content-Type: application/json\n";
echo "Authorization: Bearer token\n\n";
echo "{\n";
echo "  \"email\": \"john.doe@example.com\"\n";
echo "  \"password\": \"JohnDoe7\",\n";
echo "}\n\n\n\n";



echo "74.5 COMPONENTES DE UNA RESPUESTA HTTP\n\n";

echo "Las respuestas HTTP se componen de los siguientes componentes:

    1. VERSIÓN HTTP: Indica la versión del protocolo HTTP que se está utilizando (HTTP/1.1, HTTP/2, etc.).
    2. CÓDIGOS DE ESTADO/RESPUESTA HTTP (Status Code): Indica el resultado de la solicitud HTTP (200 OK, 404 Not Found, etc., de 100 a 500).
    3. HEADERS (Encabezados): Proporcionan información adicional sobre la respuesta, como el tipo de contenido, la longitud del cuerpo, etc.
    4. BODY (Cuerpo): Contiene los datos devueltos por el servidor.\n\n\n";


echo "74.5.1 EJEMPLO DE COMPONENTES DE UNA RESPUESTA HTTP\n\n";

echo "Ejemplo de una respuesta HTTP 200 OK:\n\n";
echo "HTTP/1.1 200 OK\n";
echo "Date: Wed, 21 Oct 2020 07:28:00 GMT\n";
echo "Server: Apache/2.4.1 (Unix)\n";
echo "Content-Type: application/json\n";
echo "Content-Length: 123\n\n";
echo "{\n";
echo "  \"id\": 1,\n";
echo "  \"name\": \"John Doe\",\n";
echo "  \"age\": 26,\n";
echo "  \"email\": \"john.doe@example.com\"\n";
echo "  \"active\": True,\n";
echo "}\n\n\n\n";



echo "74.6 HTTP RESPONSE STATUS CODE\n\n";

echo "Los CÓDIGOS DE ESTADO/RESPUESTA HTTP se clasifican en cinco categorías principales conformados por tres dígitos:
    
    A. 1xx (INFORMATIVO): Indican que la solicitud ha sido recibida y el proceso continúa.
    B. 2xx (ÉXITO): Indican que la solicitud fue exitosa (200 OK, 201 Created, 204 No Content, etc.).
    C. 3xx (REDIRRECCIÓN): Indican que se requiere una acción adicional para completar la solicitud 
    (300 Multiple Choices, 301 Moved Permanently, 302 Found, 303 See Other, 304 Not Modified, etc.).
    D. 4xx (ERRORES DEL CLIENTE): Indican que hubo un error en la solicitud del cliente.
    (400 Bad Request, 401 Unauthorized, 404 Not Found, etc.).
    E. 5xx (ERRORES DEL SERVIDOR): Indican que hubo un error en el servidor al procesar la solicitud 
    (500 Internal Server Error, 501 Not Implemented, 503 Service Unavailable, etc.).\n\n";

echo "Estos CÓDIGOS DE ESTADO/RESPUESTA HTTP son esenciales para que los clientes y servidores 
puedan comunicarse de manera efectiva y entender el resultado de las solicitudes realizadas en la web.
Son establecidos por el estándar HTTP y son fundamentales para el funcionamiento de la web.\n\n\n\n";



echo "74.7 REGLA BÁSICA PARA TRABAJAR CON SOLICITUDES HTTP EN PHP: PRIMERO LA LÓGICA Y DESPUÉS EL CONTENIDO ALV!\n\n";

echo "En PHP, al trabajar con solicitudes HTTP, es fundamental seguir una regla básica: 
primero tienes que procesar la lógica de la solicitud y luego enviar el contenido de la respuesta al cliente.
Esto se debe a que una vez que comienzas a enviar contenido al cliente (por ejemplo, un simple echo), 
ya no puedes modificar los headers (encabezados) HTTP ni el CÓDIGO DE ESTADO/RESPUESTA HTTP (Status Code).
Por lo tanto, es importante asegurarse de que toda la lógica de procesamiento de la solicitud
se realice antes de enviar cualquier contenido al cliente para evitar errores y garantizar que la respuesta HTTP sea correcta y completa.\n\n";

echo "Incluso un espacio en blanco o un salto de línea fuera de las etiquetas <?php cuenta como \"contenido\" y 
enviará un 200 OK prematuro en lo que podría ser un Código de estado/respuesta (Status Code).\n\n\n\n";



echo "74.8 RESUMEN FINAL\n\n";

echo "HTTP (HyperText Transfer Protocol) es el protocolo de comunicación utilizado en la web para la transferencia de datos entre clientes y servidores.
Permite a los usuarios acceder a páginas web, enviar formularios, interactuar con APIs, y realizar diversas acciones en la web a través de solicitudes y respuestas HTTP.\n\n";