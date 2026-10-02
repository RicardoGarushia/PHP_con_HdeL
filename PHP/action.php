<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procesando Formulario</title>
</head>
<body>

    Hola <?php echo htmlspecialchars($_POST['nombre']); ?>.
    Tiene <?php echo (int) $_POST['edad']; ?> años.

</body>
</html>