<?php
header("Content-Type: text/plain");

echo "52. PRINCIPIOS SOLID: Dependency Inversion Principle (DIP, Principio de Inversión de Dependencias) \n\n";

echo "52.1 ¿QUÉ SON LOS PRINCIPIOS SOLID?\n\n";

echo "Los PRINCIPIOS SOLID son conjunto de cinco principios de diseño orientados a objetos (POO)
que tienen como objetivo hacer que los diseños de software sean más COMPRENSIBLES, FLEXIBLES, MANTENIBLES y ESCALABLES.\n\n";

echo "Fueron promovidos por Robert C. Martin (conocido como \"Uncle Bob\")
a principios de la década de 2000, basados en conceptos anteriores de diseño.
Aplicarlos ayuda a evitar lo que se conoce como \"código con olor\" (code smells)
y a desarrollar sistemas más resistentes a los cambios.\n\n\n\n";


echo "52.2 ¿CUÁLES SON LOS PRINCIPIOS SOLID?\n\n";

echo "El acrónimo SOLID se forma con la inicial de cada uno de los cinco principios:
S - 1. Single Responsibility Principle (Principio de Responsabilidad Única)
O - 2. Open/Closed Principle (Principio de Abierto/Cerrado)
L - 3. Liskov Substitution Principle (Principio de Sustitución de Liskov)
I - 4. Interface Segregation Principle (Principio de Segregación de Interfaces)
D - 5. Dependency Inversion Principle (Principio de Inversión de Dependencias)\n\n\n\n";


echo "52.2.1 Dependency Inversion Principle (DIP, Principio de Inversión de Dependencias) establece dos reglas fundamentales:
    1. Los módulos de alto nivel no deben depender de módulos de bajo nivel. Ambos deben depender de abstracciones.
    2. Las abstracciones no deben depender de los detalles. Los detalles deben depender de las abstracciones.\n\n";

echo "Significado práctico: 
    Módulos de Alto Nivel: Contienen la lógica de negocio importante (ej. ProcesadorDePedidos, NotificadorDeUsuarios).
    Módulos de Bajo Nivel: Contienen los detalles de implementación,
    como el manejo de datos o servicios externos (ej. BaseDeDatosMySQL, ServicioDeCorreoElectronico).\n\n";

echo "Cuando se logra esto, el código de alto nivel se vuelve independiente de los detalles de bajo nivel.\n\n";

echo "Analogía:
Imagina un estéreo (módulo de alto nivel).
    No debe depender de la marca específica de la bocina (módulo de bajo nivel).
    Ambos deben depender de un cable estándar (la abstracción).
    De esta forma, puedes cambiar la bocina sin cambiar el estéreo.\n\n\n\n";

echo "48.2.1.1 MAL EJEMPLO de Violación del Single Responsibility Principle (Principio de Responsabilidad Única)\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";

// Módulo de Bajo Nivel (Detalle de implementación concreta)
class BaseDeDatosMySQL
{
    public function guardar(string $datos): void
    {
        echo "DETALLE: Conectando a MySQL y guardando: $datos\n";
    }
}

// Módulo de Alto Nivel (Lógica de Negocio)
class ProcesadorDeOrden
{
    private $db;

    // ¡VIOLACIÓN!: El módulo de alto nivel se inicializa con el módulo de bajo nivel concreto.
    public function __construct()
    {
        // DEPENDENCIA DIRECTA de un DETALLE concreto (new BaseDeDatosMySQL())
        $this->db = new BaseDeDatosMySQL();
    }

    public function guardarOrden(string $orden): void
    {
        // El módulo de negocio llama al método de la clase concreta
        $this->db->guardar($orden);
        echo "ALTO NIVEL: Orden procesada y guardada.\n";
    }
}

// $procesador = new ProcesadorDeOrden();
// $procesador->guardarOrden("Pedido #456");

echo "La anterior clase viola el DIP porque el módulo de alto nivel (ProcesadorDeOrden)
está fuertemente acoplado al módulo de bajo nivel (BaseDeDatosMySQL).\n\n";

echo "Problema (Razón para cambiar):
Si decides cambiar el sistema de almacenamiento de MySQL a PostgreSQL, o a un archivo JSON,
tienes que modificar la clase de alto nivel ProcesadorDeOrden
(específicamente la línea \$this->db = new BaseDeDatosMySQL(); en el constructor).\n\n\n\n";




echo "\n\n\n\n48.2.1.2 BUEN EJEMPLO de Single Responsibility Principle (Principio de Responsabilidad Única)\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";

class ResponsabilidadUnicaCOMPRA
{
    // PROPIEDADES O ATRIBUTOS: 
    private $carrito = [];
    private $montoTotal = 0;
    private Email $email;

    // CONSTRUCTOR:
    public function __construct(Email $ObjetoEmail)
    {
        $this->email = $ObjetoEmail;
    }

    // DESTRUCTOR:


    // MÉTODOS:
    // MÉTODOS 1. GETTER Y SETTER:
    // 1.Get.1. Método getter para variable $montoTotal
    public function getTotal(): float
    {
        return $this->montoTotal;
    }


    // 2. Métodos instanciados 


    // Método #2.1: Agregar elemento
    public function agregarElemento(string $descripcion, int $cantidad, float $precio): void
    {
        $this->carrito[] = [
            "Descripción" => $descripcion,
            "Cantidad: " => $cantidad,
            "Precio" => $precio,
            "Subtotal" => $subtotal = ($cantidad * $precio)
        ];
        $this->montoTotal += $subtotal;
        echo "Se han agregado la cantidad de $cantidad $descripcion con precio unitario de $$precio\n";
        echo "Generando un subtotal de: $$subtotal\n\n";
        echo "Su total hasta este momento es de: $$this->montoTotal \n\n";
    }
    // Método #2.2: Generar pedido
    public function generarPedido(string $nombreDeQuienRecibe, string $direccionEntregaPedido, string $telefonoPedido): void
    {
        echo "Mostrar en pantalla: ¡Muchas gracias por su compra. El total es de: $$this->montoTotal!\n";
        echo "Se envía el pedido a: $direccionEntregaPedido\n";
        echo "Se llamará sobre el pedido a: $telefonoPedido\n";
        echo "Se entregará el pedido a: $nombreDeQuienRecibe\n";
        $this->email->enviarEmail();
    }

    // Método #2.3: Actualizar pedido
    public function actualizarPedido(string $nombreDeQuienRecibe, string $direccionEntregaPedido, string $telefonoPedido): void
    {
        echo "Mostrar en pantalla: ¡Actualización de datos de su compra. El total es de: $$this->montoTotal!\n";
        echo "Se envía el pedido a: $direccionEntregaPedido\n";
        echo "Se llamará sobre el pedido a: $telefonoPedido\n";
        echo "Se entregará el pedido a: $nombreDeQuienRecibe\n";
        $this->email->enviarEmail();
    }
    // Métodos mágicos:

}

class ResponsabilidadUnicaDATOSPERSONALES
{
    private $id = 12345;
    private $nombreQuienRecibe = "Ricardo";
    private $direccionEntrega = "Av. Siempre Viva 123";
    private $telefono = "55-1020-3040";
    private $password = "password1234";

    // MÉTODOS:
    // MÉTODOS #1: GETTER Y SETTER:
    // 1.Get.1 Método GETTER para obtener nombre de quien recibe
    public function getNombreQuienRecibe(): string
    {
        return $this->nombreQuienRecibe;
    }

    // 1.Get.2 Método GETTER para obtener direccion de entrega
    public function getDireccionEntrega(): string
    {
        return $this->direccionEntrega;
    }

    // 1.Get.3 Método GETTER para obtener teléfono
    public function getTelefono(): string
    {
        return $this->telefono;
    }


    // 1.Set.1 Método SETTER para modificar dirección de entrega
    public function setNuevaDireccionEntrega($nuevaDireccionEntrega): void
    {
        echo "Cambiando dirección de entrega de: $this->direccionEntrega a: $nuevaDireccionEntrega\n";
        $this->direccionEntrega = $nuevaDireccionEntrega;
    }
    // 1.Set.2 Método SETTER para modificar teléfono
    public function setNuevoTelefono($nuevoTelefono): void
    {
        echo "Cambiando teléfono de: $this->telefono a: $nuevoTelefono\n";
        $this->telefono = $nuevoTelefono;
    }
    // 1.Set.3 Método SETTER Modificar contraseña
    public function setNuevoPassword($nuevoPassword): void
    {
        echo "Cambiando password de: $this->password a: $nuevoPassword\n";
        $this->direccionEntrega = $nuevoPassword;
    }
}

// INTERFACES
interface Email
{
    public function enviarEmail(): void;
}

class ResponsabilidadUnicaEMAIL implements Email
{
    // MÉTODOS
    public function enviarEmail(): void
    {
        echo "Se envía email con copia de la información.\n\n";
    }
}

// Creación de las instancias de clase 
$email = new ResponsabilidadUnicaEMAIL();
$compra = new ResponsabilidadUnicaCOMPRA($email);
$datosPersonales = new ResponsabilidadUnicaDATOSPERSONALES();

// Ejecución de funciones instanciadas (métodos de clase)
$compra->agregarElemento(descripcion: "Lata atún", cantidad: 10, precio: 25.5);
$compra->agregarElemento(descripcion: "Lata sardina", cantidad: 7, precio: 20);
$compra->agregarElemento(descripcion: "Papel higiénico", cantidad: 4, precio: 99.5);
$compra->generarPedido($datosPersonales->getNombreQuienRecibe(), $datosPersonales->getDireccionEntrega(), $datosPersonales->getTelefono());    // En este caso, se utiliza la función de una clase dentro de otra clase por el valor que retorna. 
$datosPersonales->setNuevaDireccionEntrega("Av. San Lorenzo 123");
$datosPersonales->setNuevoTelefono("88 5566 1212");
$compra->actualizarPedido($datosPersonales->getNombreQuienRecibe(), $datosPersonales->getDireccionEntrega(), $datosPersonales->getTelefono());    // En este caso, se utiliza la función de una clase dentro de otra clase por el valor que retorna. 
$datosPersonales->setNuevoPassword("OtroNuevoPassword");



echo "La anterior clase es un BUEN EJEMPLO que demuestra la aplicación correcta del SRP al separar las responsabilidades en clases dedicadas::
1. ResponsabilidadUnicaCOMPRA (Responsabilidad Única: Gestión del Carrito/Pedido):
Solo contiene la lógica para agregar ítems, calcular el total y generar/actualizar el pedido.
Inyecta la dependencia del email en el constructor, en lugar de manejar la lógica de envío ella misma.
2. ResponsabilidadUnicaDATOSPERSONALES (Responsabilidad Única: Gestión de la Entidad Cliente/Datos de Entrega):
Solo se encarga de almacenar y gestionar los datos personales y de entrega del cliente (getters/setters).
3. ResponsabilidadUnicaEMAIL (Responsabilidad Única: Servicio de Comunicación/Notificación):
Solo se encarga de la lógica para enviar el correo electrónico (implementación de la interfaz Email).\n\n";

echo "Problema (Razón para cambiar):
a) Mayor Cohesión: Cada clase hace una cosa bien.
b) Menor Acoplamiento: Los cambios en los datos personales no afectan la lógica de la compra, y viceversa.
c) Facilidad de Mantenimiento y Extensión: Si decides enviar un SMS en lugar de un email,
solo modificas o creas una nueva clase que implemente la interfaz Email (y esto ya se acerca al OCP, el segundo principio).
Tu clase ResponsabilidadUnicaCOMPRA no necesita ser tocada, ya que solo interactúa con la interfaz.\n\n\n\n";




?>