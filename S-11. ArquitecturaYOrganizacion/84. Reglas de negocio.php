<?php
declare(strict_types=1);    // Esto es opcional, pero es una buena práctica para asegurarnos de que estamos trabajando con los tipos de datos correctos y evitar errores inesperados en tiempo de ejecución.

// header("Content-Type: text/plain");
header("Content-Type: application/json");


echo "84. REGLAS DE NEGOCIO Y ARQUITECTURA DE SOFTWARE\n\n";

echo "84.1. ¿QUÉ SON LAS REGLAS DE NEGOCIO?\n\n"; 

echo "Las REGLAS DE NEGOCIO son las leyes, restricciones y procesos 
que definen cómo funciona una empresa o una situación específica en la vida real, 
independientemente de la tecnología que uses.\n\n";

echo "Si mañana decidieras dejar de usar PHP 
y lo hicieras todo en papel o con otra herramienta, esas reglas seguirían siendo las mismas. 
Son el \"corazón\" de tu aplicación.\n\n\n\n";



echo "84.2. DIFERENCIA ENTRE REGLAS DE NEGOCIO Y REGLAS TÉCNICAS\n\n"; 

echo "Las REGLAS DE NEGOCIO se centran en el \"qué\" y el \"por qué\" de una aplicación,
mientras que las REGLAS TÉCNICAS se centran en el \"cómo\" implementarlas.\n\n";

echo "Las REGLAS DE NEGOCIO definen los procesos, restricciones y políticas 
que rigen el funcionamiento de una empresa o sistema."; 

echo "Por otro lado, las REGLAS TÉCNICAS se refieren a las 
decisiones de diseño, arquitectura y tecnología 
que utilizas para implementar esas reglas de negocio.\n\n";

echo "Por ejemplo, una regla de negocio podría ser: 
\n\"Un cliente no puede realizar una compra si su saldo es insuficiente\".
\nMientras que una regla técnica podría ser:
\n\"Utilizar una base de datos relacional para almacenar la información de los clientes y sus saldos\".\n\n\n\n";



echo "84.3. TIPOS DE REGLAS DE NEGOCIO\n\n";

echo "Las REGLAS DE NEGOCIO pueden clasificarse en varios tipos, como:
1. Reglas de definición: 
Definen conceptos, entidades o relaciones
(por ejemplo, un cliente es una persona que realiza compras).
2. Reglas de validación: 
Aseguran que los datos ingresados cumplan con ciertos criterios
(por ejemplo, mostrar una identificación al comprar determinados productos).
3. Reglas de proceso: 
Definen cómo se deben llevar a cabo ciertos procesos 
(por ejemplo, un \"pedido al mayoreo\" debe ser aprobado por un gerente antes de ser procesado).
4. Reglas de restricción: 
Imponen limitaciones o condiciones 
(por ejemplo, un cliente no puede tener más de 5 pedidos activos al mismo tiempo).
5. Reglas de cálculo: 
Especifican cómo se deben realizar ciertos cálculos 
(por ejemplo, el total de una compra se calcula sumando el precio de los productos y aplicando un descuento si el cliente es miembro).\n\n\n\n";



echo "84.3. IMPORTANCIA DE LAS REGLAS DE NEGOCIO\n\n";

echo "Las REGLAS DE NEGOCIO son fundamentales porque:
1. Definen el valor que tu aplicación ofrece a los usuarios.
2. Guían el desarrollo y la toma de decisiones técnicas.
3. Aseguran que tu aplicación cumpla con los objetivos y necesidades de la empresa o situación que estás abordando.\n\n\n\n";



echo "84.4. REGLAS DE NEGOCIO Y ARQUITECTURA DE SOFTWARE\n\n";  

echo "Las REGLAS DE NEGOCIO influyen directamente en la ARQUITECTURA DE SOFTWARE de tu aplicación,
ya que determinan qué funcionalidades y procesos deben implementarse,
y cómo deben interactuar entre sí.\n\n";

echo "Una buena arquitectura de software debe estar diseñada para
soportar y facilitar la implementación de las reglas de negocio,
asegurando que la aplicación sea flexible, escalable y fácil de mantener 
a medida que evolucionan las necesidades de la empresa o situación que estás abordando.\n\n";

echo "LA ARQUITECTURA EXISTE PARA PROTEGER LAS REGLAS DE NEGOCIO.\n\n";

echo "Imagina que las reglas de negocio son una joya valiosa. 
La arquitectura es la caja fuerte y el sistema de seguridad que la rodea.\n\n";

echo "Si la arquitectura es débil o mal diseñada,
la joya (reglas de negocio) estará en riesgo de ser robada, dañada o difícil de acceder cuando se necesite.\n\n";

echo "Por eso es crucial diseñar una arquitectura de software sólida y bien pensada,
que proteja y facilite el acceso a las reglas de negocio,
permitiendo que tu aplicación cumpla con su propósito de manera efectiva y eficiente.\n\n\n\n";



echo "84.5. CONCLUSIÓN\n\n";

echo "Las REGLAS DE NEGOCIO son el corazón de tu aplicación,
definiendo el valor que ofrece a los usuarios y guiando el desarrollo técnico.\n\n"; 

echo "Una buena arquitectura de software debe estar diseñada para 
proteger y facilitar la implementación de estas reglas,
asegurando que tu aplicación sea flexible, escalable y fácil de mantener 
a medida que evolucionan las necesidades de la empresa o situación que estás abordando.\n\n";

echo "En resumen, la Arquitectura es decidir qué archivos van en qué carpetas para que no se mezclen 
el \"qué\" y el \"por qué\" (las reglas de negocio) 
con el \"cómo\" (el código de PHP, bibliotecas, conexiones a bases de datos y demás herramientas).\n\n";

echo "Dado que usarás Laravel o Symfony de la forma \"estándar\", 
estarás usando una arquitectura MVC (Modelo-Vista-Controlador), 
que es más sencilla pero suele \"ensuciarse\" más rápido si el proyecto crece mucho.\n\n";

echo "Si estás aprendiendo PHP y vas a usar Laravel, 
no intentes implementar Clean Architecture pura desde el día uno, 
porque Laravel está diseñado para ser ágil y a veces esas arquitecturas \"chocan\" con su filosofía.\n\n";

echo "Haz esto (Arquitectura Orientada al Dominio simplificada):
1. Sigue el MVC de Laravel para cosas sencillas (CRUDS básicos).
2. Usa \"Service Classes\": Si tienes una regla de negocio compleja (ej. calcular un préstamo), 
no la pongas en el Controlador. Crea una carpeta app/Services y pon ahí la lógica en PHP puro.
3. Usa \"Repositories\": Si sientes que tus Modelos tienen demasiado código de consultas SQL, 
crea una capa de Repositorios para separar la base de datos de la lógica.\n\n";
