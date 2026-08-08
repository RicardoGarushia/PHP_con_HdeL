<?php
header("Content-Type: text/plain");

echo "42. Métodos Mágicos: __call() & __callStatic()\n\n";

echo "42.1 ¿Qué son los métodos mágicos?\n\n";

echo "Vease \"40.__get(),__set().php\"\n\n\n\n";


echo "42.2 ¿Para qué sirven los métodos mágicos?\n\n";

echo "Vease \"40.__get(),__set().php\"\n\n\n\n";


echo "42.3 Métodos mágicos __call() y __callStatic()\n\n";

echo "Los métodos mágicos __call() y __callStatic() 
permiten gestionar el comportamiento de las funciones call() y callstatic() cuando se aplican a MÉTODOS:
    a) INEXISTENTES. Es decir, nunca fueron declaradas en la clase.
    b) EXISTENTES, PERO NO ACCESIBLES. Es decir, fueron declaradas como \"private\" o \"protected\". 
Estos métodos permiten definir un comportamiento personalizado cuando 
se intenta INVOCAR un MÉTODO DE INSTANCIA (no estático) con call()
o cuando se intenta INVOCAR UN MÉTODO ESTÁTICO con callStatic().\n\n\n\n";



echo "42.4 Breviario: Métodos de Instancia (No Estáticos) y Métodos Estáticos\n\n";

echo "42.4.1 Métodos de Instancia (No Estáticos)\n\n";

echo "Un método de instancia es una función que está ligada a un objeto específico de una clase. 
Para poder llamarlo, primero debes crear una instancia de esa clase (usando new).
    a) Identificador: No usa la palabra clave static.
    b) Acceso al Estado: Tiene acceso al estado interno del objeto mediante la variable \$this 
    (que representa ese objeto específico). Puede leer y modificar las propiedades del objeto.
    c) Propósito: Realizar operaciones que dependen o modifican el estado de una instancia individual.\n\n";

echo "<?php
class CalculadoraX {
    // Propiedad de Instancia
    public int \$ultimoResultado = 0;

    // Método de Instancia (Multiplica)
    public function multiplicarInstancia(int \$a, int \$b): int {
        \$producto = \$a * \$b;
        // Sólo el método de instancia puede guardar el resultado en el objeto.
        \$this->ultimoResultado = \$producto; 
        return \$producto;
    }
}

// Llamada al Método de Instancia
\$miObjeto = new Calculadora();
\$productoInstancia = \$miObjeto->multiplicarInstancia(10, 5);
echo \"IMPRESIÓN. Producto Instancia: \" . \$productoInstancia . \"\\n\"; // Salida: 50
?>\n\n";

class CalculadoraInstancia
{
    // Propiedad de Instancia
    public int $ultimoResultado = 0;

    // Método de Instancia (Multiplica)
    public function multiplicarInstancia(int $a, int $b): int
    {
        $producto = $a * $b;
        // Sólo el método de instancia puede guardar el resultado en el objeto.
        $this->ultimoResultado = $producto;
        return $producto;
    }
}

// Llamada al Método de Instancia
$miObjeto = new CalculadoraInstancia();
$productoInstancia = $miObjeto->multiplicarInstancia(10, 5);
echo "IMPRESIÓN. Producto Instancia: " . $productoInstancia . "\n\n"; // Salida: 50

echo "Como se observa en el ejemplo, la función modifica la propiedad \$ultimoResultado\n\n\n\n";


echo "42.4.2 Métodos Estáticos\n\n";

echo "Un método estático es una función que pertenece a la clase misma, no a un objeto específico de esa clase.
Puedes llamarlo directamente usando el nombre de la clase (sin crear una instancia).
    a) Identificador: Debe usar la palabra clave static.
    b) Acceso al Estado: No puede usar \$this porque no está asociado a un objeto.
    Solo puede acceder a otras propiedades estáticas o a otros métodos estáticos.
    c) Propósito: Realizar operaciones que no dependen del estado de ningún objeto
    (funciones de utilidad, helpers o inicialización).\n\n";

echo "<?php
class CalculadoraZ {
    // Método Estático (Multiplica)
    public static function multiplicarEstatico(int \$a, int \$b): int {
        // Operación limpia, sin acceso al estado del objeto.
        return \$a * \$b;
    }
}

// Llamada al Método Estático
\$productoEstatico = CalculadoraZ::multiplicarEstatico(5, 4);
echo \"IMPRESIÓN. Producto Estático: \" . \$productoEstatico . \"\\n\"; // Salida: 20
?>\n\n";

class CalculadoraEstatico
{
    // Método Estático (Multiplica)
    public static function multiplicarEstatico(int $a, int $b): int
    {
        // Operación limpia, sin acceso al estado del objeto.
        return $a * $b;
    }
}

// Llamada al Método Estático
$productoEstatico = CalculadoraEstatico::multiplicarEstatico(5, 4);
echo "IMPRESIÓN. Producto Estático: " . $productoEstatico . "\n\n"; // Salida: 20

echo "Como se observa en el ejemplo, la función \"multiplicarEstatico\"
es un método estático que puede ser invocado directamente en la clase CalculadoraZ 
usando el operador de resolución de ámbito (::),
sin necesidad de crear una instancia u objeto de esa clase 
(\$productoEstatico = CalculadoraZ::multiplicarEstatico(5, 4))\n\n\n\n";



echo "42.3.1 Definición y sintaxis de __call()n\n";

echo "El método mágico __call() se define dentro de una clase y se invoca automáticamente
cuando se intenta invocar a un método de instancia (no estático)
que es inaccesible (por ser private o protected) o que no existe en la clase.\n\n";

echo "Su principal utilidad es permitirte interceptar llamadas a métodos desconocidos
y delegarlas a otro objeto o definir una lógica de fallback.\n\n";

echo "public function __call(string \$nombreMetodo, array \$argumentos): mixed {
    // Lógica personalizada para INVOCAR el MÉTODO de la INSTANCIA (que o no existe o es innacesible)
}\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo <<<CODIGO_PHP
<?php
class CalculadoraX1 {
    // Propiedad de Instancia
    public int \$ultimoResultado = 0;

    // Método de Instancia (Multiplica)
    public function multiplicarInstancia(int \$a, int \$b): int {
        \$producto = \$a * \$b;
        // Sólo el método de instancia puede guardar el resultado en el objeto.
        \$this->ultimoResultado = \$producto; 
        return \$producto;
    }

    // MÉTODOS MÁGICOS: __call() Intercepta las llamadas a métodos de instancia inexistentes
    public function __call(string \$nombreMetodo, array \$argumentos): mixed {
        echo "--> __call() interceptó la llamada al método: '\$nombreMetodo'\\n";
        
        // La lógica de extensión:
        // 1. Verificamos si el nombre llamado (ej. 'multiplicarDinamico') 
        //    corresponde al método REAL que queremos ejecutar ('multiplicarInstancia').
        if (\$nombreMetodo === 'multiplicarDinamico') {
            
            // 2. Ejecutamos el método REAL, pasándole los argumentos.
            //    Usamos call_user_func_array para llamar al método privado con los argumentos
            //    que vinieron en el array \$argumentos.
            return call_user_func_array([\$_this, 'multiplicarInstancia'], \$argumentos);
        }

        // Si no es el método que esperábamos, lanzamos una excepción
        throw new \BadMethodCallException("El método '\$nombreMetodo' no existe ni se puede delegar.");
    }
}

// Llamada al Método de Instancia
\$otroObjeto = new CalculadoraX1();
\$productoInstancia1 = \$otroObjeto->multiplicarInstancia(10, 5);    // No llama a __call()
echo "IMPRESIÓN. Producto Instancia: " . \$productoInstancia1 . "\\n\\n"; // Salida: 50
\$productoInstancia1 = \$otroObjeto->multiplicarDinamico(10, 10);     // Llama a __call()
echo "IMPRESIÓN. Producto Instancia: " . \$productoInstancia1 . "\\n\\n"; // Salida: 100
?>\n\n
CODIGO_PHP;


class CalculadoraInstanciaX
{
    // Propiedad de Instancia
    public int $ultimoResultado = 0;

    // Método de Instancia (Multiplica)
    public function multiplicarInstancia(int $a, int $b): int
    {
        $producto = $a * $b;
        // Sólo el método de instancia puede guardar el resultado en el objeto.
        $this->ultimoResultado = $producto;
        return $producto;
    }

    // MÉTODOS MÁGICOS: __call() Intercepta las llamadas a métodos de instancia inexistentes
    public function __call(string $nombreMetodo, array $argumentos): mixed
    {
        echo "--> __call() interceptó la llamada al método: '$nombreMetodo'\n
        con los argumentos: " . implode(", ", $argumentos) . "\n";

        // La lógica de extensión:
        // 1. Verificamos si el nombre llamado (ej. 'multiplicarDinamico') 
        //    corresponde al método REAL que queremos ejecutar ('multiplicarInstancia').
        if ($nombreMetodo === 'multiplicarDinamico') {

            // 2. Ejecutamos el método REAL, pasándole los argumentos.
            //    Usamos call_user_func_array para llamar al método privado con los argumentos
            //    que vinieron en el array $argumentos.
            return call_user_func_array([$this, 'multiplicarInstancia'], $argumentos);
        }

        // Si no es el método que esperábamos, lanzamos una excepción
        throw new \BadMethodCallException("El método '$nombreMetodo' no existe ni se puede delegar.");
    }
}

// Llamada al Método de Instancia
$otroObjeto = new CalculadoraInstanciaX();
$productoInstancia1 = $otroObjeto->multiplicarInstancia(10, 5);    // No llama a __call()
echo "IMPRESIÓN. Producto Instancia: " . $productoInstancia1 . "\n\n"; // Salida: 50
$productoInstancia1 = $otroObjeto->multiplicarDinamico(10, 10);     // Llama a __call()
echo "IMPRESIÓN. Producto Instancia: " . $productoInstancia1 . "\n\n"; // Salida: 50



echo "\n\n42.3.2 Definición y sintaxis de __callStatic()\n\n";

echo "El método mágico __callStatic() se define dentro de una clase y se invoca automáticamente
cuando se intenta invocar a un método estático (static)
que es inaccesible (por ser private o protected) o que no existe en la clase.\n\n";

echo "Su principal utilidad es permitirte implementar 
métodos de fachada o crear llamadas dinámicas en el contexto de clases estáticas.\n\n";

echo "public static function __callStatic(string \$nombreMetodo, array \$argumentos): mixed {
    // Lógica personalizada para INVOCAR el MÉTODO ESTÁTICO (que o no existe o es innacesible)
}\n\n";

echo "Retomando la sintaxis básica para declarar una clase (20.POOClasesObjetos.php):\n\n";

echo <<<CODE
<?php
class CalculadoraEstaticoX {
    // Método Estático REAL (Multiplica)
    public static function multiplicarEstatico(int \$a, int \$b): int {
        // Operación limpia, sin acceso al estado del objeto.
        return \$a * \$b;
    }

    // MÉTODO MÁGICO: __callStatic()
    // Intercepta las llamadas a MÉTODOS ESTÁTICOS INEXISTENTES.
    public static function __callStatic(string \$nombreMetodo, array \$argumentos): mixed {
 
        echo "--> __callStatic() interceptó la llamada al método estático: '{\\\$nombreMetodo}'\\n";

        // Lógica de extensión: Verificamos si el nombre llamado corresponde al método REAL
        if (\$nombreMetodo === 'multiplicarDinamicoEstatico') {
 
            // 2. Ejecutamos el método REAL (multiplicarEstatico), pasándole los argumentos.
            //    Usamos call_user_func_array para llamar al método estático.
            //    Nota: Se usa self:: para referirse al método estático.
            return call_user_func_array(['self', 'multiplicarEstatico'], \$argumentos);
        }

        // Si no es el método que esperábamos, lanzamos una excepción
        throw new \BadMethodCallException("El método estático '{\\\$nombreMetodo}' no existe ni se puede delegar.");
    }
}

// -----------------------------------------------------
## PRUEBAS

// 1. Llamada al Método Estático REAL (NO se llama a __callStatic)
\$productoEstatico1 = CalculadoraEstaticoX::multiplicarEstatico(5, 4);
echo "IMPRESIÓN. Producto Estático REAL: " . \$productoEstatico1 . "\\n\\n"; // Salida: 20

// 2. Llamada al Método Estático INEXISTENTE (SÍ se llama a __callStatic)
\$productoEstatico2 = CalculadoraEstaticoX::multiplicarDinamicoEstatico(10, 3);
echo "IMPRESIÓN. Producto Estático DELEGADO: " . \$productoEstatico2 . "\\n\\n"; // Salida: 30

// 3. Llamada que causaría una excepción si no se delega a otro método (Ej: CalculadoraEstatico::sumarEstatico(1, 1))
// Descomenta la siguiente línea para probar el error:
// \$productoEstatico3 = CalculadoraEstaticoX::sumarEstatico(1, 1);
?>
CODE;


class CalculadoraEstaticoX
{
    // Método Estático REAL (Multiplica)
    public static function multiplicarEstatico(int $a, int $b): int
    {
        // Operación limpia, sin acceso al estado del objeto.
        return $a * $b;
    }

    // MÉTODO MÁGICO: __callStatic()
    // Intercepta las llamadas a MÉTODOS ESTÁTICOS INEXISTENTES.
    public static function __callStatic(string $nombreMetodo, array $argumentos): mixed
    {

        echo "--> __callStatic() interceptó la llamada al método estático: '{$nombreMetodo}'\n
        con los argumentos: " . implode(', ', $argumentos) . "\n";

        // Lógica de extensión: Verificamos si el nombre llamado corresponde al método REAL
        if ($nombreMetodo === 'multiplicarDinamicoEstatico') {

            // 2. Ejecutamos el método REAL (multiplicarEstatico), pasándole los argumentos.
            //    Usamos call_user_func_array para llamar al método estático.
            //    Nota: Se usa self:: para referirse al método estático.
            return call_user_func_array(['self', 'multiplicarEstatico'], $argumentos);
        }

        // Si no es el método que esperábamos, lanzamos una excepción
        throw new \BadMethodCallException("El método estático '{$nombreMetodo}' no existe ni se puede delegar.");
    }
}

// -----------------------------------------------------
## PRUEBAS

// 1. Llamada al Método Estático REAL (NO se llama a __callStatic)
$productoEstatico1 = CalculadoraEstaticoX::multiplicarEstatico(5, 4);
echo "IMPRESIÓN. Producto Estático REAL: " . $productoEstatico1 . "\n\n"; // Salida: 20

// 2. Llamada al Método Estático INEXISTENTE (SÍ se llama a __callStatic)
$productoEstatico2 = CalculadoraEstaticoX::multiplicarDinamicoEstatico(10, 3);
echo "IMPRESIÓN. Producto Estático DELEGADO: " . $productoEstatico2 . "\n\n"; // Salida: 30

// 3. Llamada que causaría una excepción si no se delega a otro método (Ej: CalculadoraEstatico::sumarEstatico(1, 1))
// Descomenta la siguiente línea para probar el error:
// $productoEstatico3 = CalculadoraEstatico::sumarEstatico(1, 1);


echo "\n\n42.3.3 Ejemplo práctico: Creación de un log para registrar la NO ejecución de funciones INSTANCIADAS y ESTÁTICAS\n\n";

class AventureroRPG
{
    // Propiedades: Se definen como strings y se les asigna un valor por defecto (rutas de archivo).
    private string $logDeErroresDeFuncionesInstanciadas = 'log_instancia.txt';
    private static string $logDeErroresDeFuncionesEstaticas = 'log_estatico.txt';

    // Constructor explícito: Recibe la RUTA (string), no un array.
    public function __construct(string $rutaLogInstanciado)
    {
        $this->logDeErroresDeFuncionesInstanciadas = $rutaLogInstanciado;
    }

    // --- Métodos Mágicos ---
    // 1. __call()
    public function __call(string $nombreMetodo, array $arregloDeErrores): void
    {
        // Se usa json_encode() para serializar todos los argumentos, incluyendo arrays anidados.
        $argumentosString = json_encode($arregloDeErrores, JSON_UNESCAPED_UNICODE);

        echo "Intento de invocación del método INSTANCIADO '$nombreMetodo' con los argumentos: "
            . $argumentosString . "\n";

        // El resto del código que usa $argumentosString ahora es seguro
        $mensajeDeError = "Occurió un error con el método: '$nombreMetodo' \n";
        $mensajeDeError .= "Sus argumentos eran: $argumentosString \n";
        $mensajeDeError .= date("Y-m-d H:i:s") . "\n";

        if (!file_exists($this->logDeErroresDeFuncionesInstanciadas)) {
            file_put_contents($this->logDeErroresDeFuncionesInstanciadas, "");
        }
        file_put_contents($this->logDeErroresDeFuncionesInstanciadas, $mensajeDeError, FILE_APPEND);
    }

    // 2. __callStatic()
    public static function __callStatic(string $nombreMetodo, array $arregloDeErrores): void
    {

        // Se usa json_encode() aquí también para manejo robusto de argumentos.
        $argumentosString = json_encode($arregloDeErrores, JSON_UNESCAPED_UNICODE);

        echo "Intento de invocación del método ESTÁTICO '$nombreMetodo' con los argumentos: "
            . $argumentosString . "\n";

        $mensajeDeError = "Occurió un error con el método: '$nombreMetodo' \n";
        $mensajeDeError .= "Sus argumentos eran: $argumentosString \n";
        $mensajeDeError .= date("Y-m-d H:i:s") . "\n";

        if (!file_exists(self::$logDeErroresDeFuncionesEstaticas)) {
            file_put_contents(self::$logDeErroresDeFuncionesEstaticas, "");
        }
        file_put_contents(self::$logDeErroresDeFuncionesEstaticas, $mensajeDeError, FILE_APPEND);
    }
}

// --- Ejemplo de Uso ---

// 1. Instanciación: Pasamos la ruta del archivo como string
$heroe = new AventureroRPG("mi_aventura_log.txt");

// 2. Llamada a método de instancia inexistente (llama a __call)
$heroe->usarHabilidad('CorteMortal', ['Enemigo: Troll', 500, 'Critico']);

// 3. Llamada a método estático inexistente (llama a __callStatic)
AventureroRPG::guardarEstado('Guardado rápido', ['Jugador', 'Mapa 3']);