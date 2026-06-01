<?php
header("Content-Type: text/plain");

echo "48. PRINCIPIOS SOLID: Single Responsibility Principle (Principio de Responsabilidad Única) \n\n";

echo "48.1 ¿QUÉ SON LOS PRINCIPIOS SOLID?\n\n";

echo "Los PRINCIPIOS SOLID son conjunto de cinco principios de diseño orientados a objetos (POO)
que tienen como objetivo hacer que los diseños de software sean más COMPRENSIBLES, FLEXIBLES, MANTENIBLES y ESCALABLES.\n\n";

echo "Fueron promovidos por Robert C. Martin (conocido como \"Uncle Bob\")
a principios de la década de 2000, basados en conceptos anteriores de diseño.
Aplicarlos ayuda a evitar lo que se conoce como \"código con olor\" (code smells)
y a desarrollar sistemas más resistentes a los cambios.\n\n\n\n";


echo "48.2 ¿CUÁLES SON LOS PRINCIPIOS SOLID?\n\n";

echo "El acrónimo SOLID se forma con la inicial de cada uno de los cinco principios:
S - 1. Single Responsibility Principle (Principio de Responsabilidad Única)
O - 2. Open/Closed Principle (Principio de Abierto/Cerrado)
L - 3. Liskov Substitution Principle (Principio de Sustitución de Liskov)
I - 4. Interface Segregation Principle (Principio de Segregación de Interfaces)
D - 5. Dependency Inversion Principle (Principio de Inversión de Dependencias)\n\n\n\n";


echo "48.2.1 Single Responsibility Principle (Principio de Responsabilidad Única)\n\n";

echo "El Single Responsibility Principle (SRP) establece que una clase debe tener solo una razón para cambiar,
lo que se interpreta como que una clase debe tener una, y solo una, responsabilidad.\n\n";

echo "Responsabilidad: Se refiere a un eje de cambio o un actor (persona, rol) que podría solicitar un cambio en el código.\n\n";

echo "Significado práctico: 
    Si una clase maneja múltiples responsabilidades,
    un cambio solicitado por un actor en una de esas responsabilidades
    podría obligarte a modificar código que sirve a otra responsabilidad,
    introduciendo riesgos y haciendo el sistema frágil.\n\n\n\n";


echo "48.2.1.1 MAL EJEMPLO de Violación del Single Responsibility Principle (Principio de Responsabilidad Única)\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo "COLOCAR EJEMPLO DE CÓDIGO DESPUÉS\n\n";


class SINResponsabilidadUnicaCOMPRACLIENTE
{
    // PROPIEDADES O ATRIBUTOS: 
    private $id = 12345;
    private $nombreQuienRecibe = "Ricardo";
    private $direccionEntrega = "Av. Siempre Viva 123";
    private $telefono = "55-1020-3040";
    private $password = "password1234";
    private $carrito = [];
    private $montoTotal = 0;

    // CONSTRUCTOR:


    // DESTRUCTOR:


    // MÉTODOS:
    // MÉTODOS 1. GETTER Y SETTER:
    // Método 1.Get.1: Getter para variable $montoTotal
    public function getTotal(): float
    {
        return $this->montoTotal;
    }
    
    // Método #1.Set.1: Modificar dirección de entrega
    public function setNuevaDireccionEntrega($nuevaDireccionEntrega): void
    {
        echo "Cambiando dirección de entrega de: $this->direccionEntrega a: $nuevaDireccionEntrega\n";
        $this->direccionEntrega = $nuevaDireccionEntrega;
    }

    // Método #1.Set.2: Modificar teléfono
    public function setNuevoTelefono($nuevoTelefono): void
    {
        echo "Cambiando teléfono de: $this->telefono a: $nuevoTelefono\n";
        $this->telefono = $nuevoTelefono;
    }
    // Método #1.Set.3: Modificar contraseña
    public function setNuevoPassword($nuevoPassword): void
    {
        echo "Cambiando password de: $this->password a: $nuevoPassword\n";
        $this->password = $nuevoPassword;
    }


    // MÉTODOS 2. FUNCIONES INSTANCIADAS
    // Método #2.1: Crear pedido
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
    // Método #2.2: Procesar pedido
    public function generarPedido(): void
    {
        echo "Mostrar en pantalla: ¡Muchas gracias por su compra. El total es de: $$this->montoTotal!\n";
        echo "Se envía el pedido a: $this->direccionEntrega\n";
        echo "Se llamará sobre el pedido a: $this->telefono\n";
        echo "Se entregará el pedido a: $this->nombreQuienRecibe\n";
        $this->enviarEmail();
    }
    // Método #2.3: Actualizar pedido
    public function actualizarPedido(): void
    {
        echo "Mostrar en pantalla: ¡Actualización de datos de su compra. El total es de: $$this->montoTotal!\n";
        echo "Se envía el pedido a: $this->direccionEntrega\n";
        echo "Se llamará sobre el pedido a: $this->telefono\n";
        echo "Se entregará el pedido a: $this->nombreQuienRecibe\n";
        $this->enviarEmail();
    }
    // Método #2.4: Enviar correo electrónico con monto total y descripción 
    public function enviarEmail(): void
    {
        echo "Se envía email con copia de la información.\n\n";
    }

    // 4. MÉTODOS MÁGICOS:

}

$multipleResponsabilidad = new SINResponsabilidadUnicaCOMPRACLIENTE();
$multipleResponsabilidad->agregarElemento(descripcion: "Lata atún", cantidad: 10, precio: 25.5);
$multipleResponsabilidad->agregarElemento(descripcion: "Lata sardina", cantidad: 7, precio: 20);
$multipleResponsabilidad->agregarElemento(descripcion: "Papel higiénico", cantidad: 4, precio: 99.5);
$multipleResponsabilidad->generarPedido();
$multipleResponsabilidad->setNuevaDireccionEntrega(nuevaDireccionEntrega: "Av. San Lorenzo 123");
$multipleResponsabilidad->setNuevoTelefono("55 9988 7766");
$multipleResponsabilidad->actualizarPedido();
$multipleResponsabilidad->setNuevoPassword("NuevoPassword321");


echo "La anterior clase viola el SRP porque tiene múltiples responsabilidades (múltiples \"razones para cambiar\"):
1. Gestión de la Compra/Carrito: (agregarElemento(), getTotal(), generarPedido(), actualizarPedido()). 
Responsabilidad de la lógica de negocio.
2. Gestión de Datos Personales del Cliente: (\$direccionEntrega, \$telefono, \$password, setNuevaDireccionEntrega(), setNuevoTelefono(), setNuevoPassword()).
Responsabilidad de la entidad/datos del cliente.
3. Comunicación/Notificación: (enviarEmail). Responsabilidad de un servicio de notificación.\n\n";

echo "Problema (Razón para cambiar):
a) Si la lógica de negocio para procesar pedidos cambia (ej. nuevo cálculo de impuestos), tienes que cambiar esta clase.
b) Si la estructura de datos personales del cliente cambia (ej. se añade un campo de RFC), tienes que cambiar esta clase.
c) Si el método de notificación cambia (ej. de email a SMS), tienes que cambiar esta clase.
La clase tiene acopladas las tres responsabilidades, y cualquier cambio en una afecta a las demás.\n\n\n\n";




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