<?php
header("Content-Type: text/plain");

echo "\n9. OPERADORES\n\n";

echo "En programación, un OPERADOR es un símbolo o una palabra clave
que le indica al motor del lenguaje (en este caso, PHP) 
que debe realizar una acción específica (una operación) sobre uno o más valores.\n\n\n\n"; 



echo "9.1. NIVELES DE OPERADORES: UNARIOS, BINARIOS Y TERNARIOS\n\n"; 

echo "Los NIVELES DE OPERADORES es la clasificación técnica más pura que existe en computación:

a) UNARIOS: Solo necesitan un operando.
Ejemplo: !\$activado (el operador NOT invierte el valor).
Ejemplo: \$numero++ (el operador postincremento ++ incrementa en uno después de evaluar la expresión).
Ejemplo: \$++numero (el operador preincremento ++ incrementa en uno antes de evaluar la expresión).
Ejemplo: \$objeto->propiedad (el operador de acceso a miembros -> accede a la propiedad o función de un objeto confiando que dicho objeto existe y es válido. En caso de no serlo, el código se detiene con un error fatal).
Ejemplo: \$objeto?->propiedad (el operador de acceso a miembros nullable: accede a la propiedad o función de un objeto si este existe, de lo contrario devuelve null. No produce un error fatal).
Ejemplo: ?datatype \$variable (el operador de tipo de retorno nullable: indica que una variable puede contener un valor del tipo especificado o null).
Ejemplo: &\$variable (el operador de referencia & devuelve la dirección de memoria de la variable).

b) BINARIOS: (Los más comunes) Necesitan dos operandos.
Ejemplo: \$a + \$b; (operador de suma \"+\": a se suma a b).
Ejemplo: \$x = \$y; (operador de asignación \"=\": y se asigna a x ).
Ejemplo: \$cadenaNumerica == \$numero; (operador de igualdad laxo \"==\": tras realizar una conversión de tipos son iguales)
Ejemplo: \$x === \$y; (operador de igualdad estricta \"===\": empezando por el tipo de dato son iguales)
Ejemplo: \$nombre . \$apellido; (operador de concatenación \".\": nombre concatenado con apellido)
Ejemplo: \$valorBits &  \$valorBits; (operador AND a nivel de bits \"&\": realiza una operación AND bit a bit entre los valores)
Ejemplo: \$operando1 && \$operando2; (operador lógico AND \"&&\": devuelve True si ambos operandos son verdaderos)
Ejemplo: \$nombreUsuario = \$nombreRegistrado ?? \"Invitado\"; (operador de coalescencia nula \"??\": si \$nombreRegistrado no existe o es null, asigna \"Invitado\" a \$nombreUsuario)
Ejemplo: \$objeto->metodo(); (operador de acceso a miembros \"->\": accede a un método dinámico o propiedad de un objeto -\$objeto->propiedad;-)
Ejemplo: Clase::metodo(); (operador de resolución de ámbito \"::\": accede a un método estático o constante de una clase -Clase::propiedad;-)

c) TERNARIOS: Necesitan tres operandos. En PHP solo hay uno: el operador condicional ? : (también conocido como \"operador ternario\" pa'los cuates)
Ejemplo: \$edad > 18 ? \"adulto\" : \"niño\"
Si observa, el primer operando es una condición (\$edad > 18), 
el segundo operando es un valor si la condición arroja un booleano True (\"adulto\") y,
un tercer operando es otro valor si la condición arroja un booleano False (\"niño\").\n\n\n\n"; 



echo "9.1.1 OPERADOR CONDICIONAL TERNARIO (? :)\n\n"; 

echo "El OPERADOR CONDICIONAL TERNARIO es la forma abreviada de una estructura if-else. 
Evalúa una expresión booleana y devuelve un valor si es verdadera y otro si es falsa.\n\n\n";


echo "9.1.1.1 SINTAXIS del OPERADOR CONDICIONAL TERNARIO\n\n"; 

echo "La sintaxis del OPERADOR CONDICIONAL TERNARIO (? :) es:
(condicion_a_Evaluar) ? \$valor_si_True : \$valor_si_False;\n\n"; 

echo "Si lo quieres con operador de asignación (=) y asignación a una variable:
\$resultado = (condicion_a_Evaluar) ? \$valor_si_True : \$valor_si_False;\n\n"; 

echo "Ejemplo: \$estadoLegal = \$edad > 18 ? \"Juzgar como adulto\" : \"Juzgar como no adulto\";\n\n\n\n"; 



echo "9.1.1.1.1 OPERADOR CONDICIONAL TERNARIO RECORTADO (\"Short Ternary\")\n\n"; 

echo "Mi recomendación es que ¡¡NO LO OCUPES!!, 
pero como es probable que leas el código de algún loquito que lo ocupó, aquí va.\n\n";

echo "El \"Short Ternary\" (?:) devuelve el valor original de la variable si esta se evalúa como verdadera.\n\n\n"; 


echo "9.1.1.1.1.1 SINTAXIS del \"Short Ternary\"\n\n"; 

echo "La sintaxis del \"Short Ternary\" (?:) es omitir la parte media (\$valor_si_True) de un OPERADOR CONDICIONAL TERNARIO.
Además, de omitir la evaluación de alguna condición y cambiarla por un valor. 
Se devuelve el valor si dicho valor se evalúa como True
(según las reglas de conversión a booleano de PHP), 
de lo contrario devuelve el valor si es False (\$valor_si_False):
\$valor_a_Evaluar ?: \$valor_si_False;\n\n"; 

echo "Si lo quieres con operador de asignación (=) y asignación a una variable:
\$resultado = (condicion) ?: \$valor_si_False;\n\n"; 

echo "Para saber cuándo el operador saltará al segundo valor (\$valor_si_False), debes recordar qué cosas PHP considera \"falsas\":

a) El booleano: False
b) El número entero cero: 0
c) El número flotante cero punto cero: 0.0
d) El string vacío: \"\"    (el string \" \" (espacio(s) en blanco) es True)
e) El string \"0\"  (el string \"0.0\" es True)
f) Un array vacío: []
g) El valor nulo: null\n\n";

echo "Ejemplo: \$nombreUsuario = \$nombreRegistrado ?: \"Invitado\";\n\n";

echo "Entonces, si \$nombreRegistrado es un string vacío (\"\"), el operador saltará a \"Invitado\".\n\n";

echo "Es preciso REMARCAR que \"Short Ternary\" tiene dos problemas: 

PROBLEMA 1. Sí la variable NO ha sido declarada
arroja un error tipo Notice (Variable indefinida)
antes de darte el resultado.
Por tanto, es importante asegurarse de que la variable esté definida antes de usar este operador.

PROBLEMA 2. Si la variable tiene un valor VÁLIDO (por ejemplo: el número 0 o el string \"0\") que se evalúa como False,
el operador saltará al segundo valor (\$valor_si_False)
a pesar de que el valor original de la variable es perfectamente válido para su uso en el programa.\n\n";

echo "En resumen, el \"Short Ternary\" puede ser útil en algunos casos específicos,
pero es importante usarlo con precaución y asegurarse de que
1. la variable esté definida y
2. tenga un valor que no se evalúe como False
si deseas evitar resultados inesperados.\n\n"; 

echo "O puedes ignorar este operador y,
a) usar el OPERADOR CONDICIONAL TERNARIO completo, que es más claro y seguro, o
b) usar el OPERADOR DE COALESCENCIA NULA, que es aún más seguro para manejar variables no definidas o nulas.\n\n\n\n"; 



echo "9.1.2 OPERADOR DE COALESCENCIA NULA (??)\n\n"; 

echo "El OPERADOR DE COALESCENCIA NULA es un operador binario diseñado específicamente
para manejar variables que podrían o no estar definidas, o ser null.\n\n"; 

echo "Este operador devuelve el primer valor SI existe Y NO es null.
Si NO existe el primer valor o su valor es null, devuelve el segundo valor.\n\n\n";


echo "9.1.2.1 SINTAXIS del OPERADOR DE COALESCENCIA NULA\n\n"; 

echo "La sintaxis del OPERADOR DE COALESCENCIA NULA (??) es:
SiExisteYNoEsNULL_UsaEsto ?? SiNOExisteOEsNULL_UsaEsteOtro;\n\n"; 

echo "Si lo quieres con operador de asignación (=) y asignación a una variable:
\$resultado = SiExisteYNoEsNULL_AsignaEsto ?? SiNOExisteOEsNULL_AsignaEsteOtro;\n\n"; 

echo "Ejemplo: \$nombreUsuario = \$nombreRegistrado ?? \"Invitado\";\n\n";

echo "En este ejemplo, si \$nombreRegistrado no está definido o es null, \$nombreUsuario se asignará a \"Invitado\".
Si \$nombreRegistrado tiene cualquier otro valor (incluso un string vacío \"\" o* el número 0),
\$nombreUsuario se asignará a ese valor de \$nombreRegistrado.\n\n";

echo "Además, el OPERADOR DE COALESCENCIA NULA NO lanza un error de tipo \"Notice\" si la variable de la izquierda no ha sido declarada.\n\n"; 

echo "En resumen, el OPERADOR DE COALESCENCIA NULA es una herramienta muy útil para manejar variables que...
a) podrían no estar definidas o,
b) ser null,
y es una alternativa más segura y clara al \"Short Ternary\" en muchos casos.\n\n\n\n";



echo "9.1.2.1.1 OPERADOR DE ASIGNACIÓN DE COALESCENCIA NULA (??=)\n\n"; 

echo "Añadido en PHP 7.4, es una evolución del OPERADOR DE COALESCENCIA NULA (??) 
para simplificar la inicialización de variables.\n\n";

echo "Sintaxis: \$a ??= \$b;\n\n";

echo "Equivalencia: Es lo mismo que hacer: 
\$a = \$a ?? \$b;
Solo asigna el valor de \$b a \$a si \$a es nulo o no está definido.\n\n\n\n";



echo "9.1.3 OPERADORES DE ASIGNACIÓN (=), IGUALDAD DÉBIL (==) E IGUALDAD ESTRICTA (===)\n\n"; 

echo "El OPERADOR DE ASIGNACIÓN (=) se utiliza para asignar un valor a una variable.
Ejemplo: \$x = \"5\"; (asigna la cadena \"5\" a la variable \$x.\n\n";

echo "El OPERADOR DE IGUALDAD DÉBIL (==) compara dos valores y los convierte al mismo tipo antes de compararlos.
Ejemplo: \$x == 5; (compara el valor de \$x con el número 5, convirtiéndolos al mismo tipo si es necesario).
Resultado: True (A la variable \$x se le había asignado la cadena \"5\" y al compararla con el número 5, PHP la convierte al mismo tipo)\n\n";

echo "El OPERADOR DE IGUALDAD ESTRICTA (===) compara dos valores sin convertirlos a un tipo común.
Ejemplo: \$x === 5; (compara el valor de \$x con el número 5, verificando que sean del mismo tipo de dato y valor).
Resultado: False (A la variable \$x se le había asignado la cadena \"5\" y al compararla con el número 5, PHP no la convierte al mismo tipo)\n\n\n\n";



echo "9.1.4 RESUMEN DE OPERADORES\n\n";

echo "En resumen, es importante elegir el operador adecuado según el contexto y las necesidades de tu programa para garantizar que tu código sea claro, seguro y fácil de mantener.\n\n"; 

echo "Faltan muchos más operadores, pero ya me cansé. 
Además, se supone que sólo quería estudiar CONDICIONAL TERNARIO y COALESCENCIA NULA
y me metí a estudiar más a fondo los operadores. Así que ya es todo por hoy. ¡Ciaito!\n\n";