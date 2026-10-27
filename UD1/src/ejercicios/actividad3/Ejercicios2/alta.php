<?php
//se conecta a la base de datos
require 'conexion.php';
$conexion = getConexion();

$mensaje = "";

//comprobamos que se haya enviado el formulario correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // recoge todos los datos introducidos. trim (quita espacios)
    $nombre = trim($_POST["nombre"]);
    $plataforma = trim($_POST["plataforma"]);
    $anio = $_POST["anio_lanzamiento"];
    $genero = trim($_POST["genero"]);

    //Comprueba si nombre, paltaforma o anio esta vacio (son obligatorios)
    if (empty($nombre) || empty($plataforma) || empty($anio)) {
        $mensaje = "Nombre, plataforma y año son obligatorios.";
    //Comprueba que el año se encuentra dentro de los valores permitidos 
    } elseif (!is_numeric($anio) || $anio < 1950 || $anio > 2100) {
        $mensaje = "El año de lanzamiento no es válido.";
    } else {

        //insertamos los valores dados a la base de datos
        $sql = "INSERT INTO videojuegos (nombre, plataforma, anio_lanzamiento, genero)
                VALUES (?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssis", $nombre, $plataforma, $anio, $genero);

        if ($stmt->execute()) {
            header("Location: listar.php");
            exit;
        } else {
            $mensaje = "Error al insertar el videojuego.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir videojuego</title>
</head>
<body>

    <h1>Añadir videojuego</h1>

    <?php if ($mensaje != ""): ?>
        <p style="color:red;"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nombre:<br>
            <input type="text" name="nombre" maxlength="255" required>
        </label>
        <br><br>

        <label>Plataforma:<br>
            <input type="text" name="plataforma" maxlength="100" required>
        </label>
        <br><br>

        <label>Año de lanzamiento:<br>
            <input type="number" name="anio_lanzamiento" min="1950" max="2100" required>
        </label>
        <br><br>

        <label>Género:<br>
            <input type="text" name="genero" maxlength="100">
        </label>
        <br><br>

        <button type="submit">Guardar</button>
    </form>

    <p><a href="listar.php">Volver al listado</a></p>

</body>
</html>