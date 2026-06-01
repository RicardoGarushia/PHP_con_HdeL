<?php
// CARGA DE FUNCIONES MANUAL (mientras no usemos Namespaces/Composer)

// 1. Errores (Lo más básico)
require_once __DIR__ . '/../exceptions/exceptions.php';

// 2. Datos/Repositorio (Para que la lógica pueda pedir datos)
require_once __DIR__ . '/../data/repository.php';

// 3. Validadores (Herramientas de chequeo)
require_once __DIR__ . '/../validators/validators.php';

// 4. Lógica de Negocio (El que usa todo lo anterior)
require_once __DIR__ . '/../business/logic.php';


// Aquí irían los demás que vayas creando:

?>