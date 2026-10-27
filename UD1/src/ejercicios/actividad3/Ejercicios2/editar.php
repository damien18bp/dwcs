<?php
//se conecta a la base de datos
require 'conexion.php';
$conexion = getConexion();

$id = $_GET["id"] ?? null;
$mensaje = "";

if ($id === null || !is_numeric($id)) {
    header("Location: listar.php");
    exit;
}

$stmt = $conexion->prepare("SELECT * FROM videojuegos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$juego = $stmt->get_result()->fetch_assoc();

if (!$juego) {
    header("Location: listar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $plataforma = trim($_POST["plataforma"]);
    $anio = $_POST["anio_lanzamiento"];
    $genero = trim($_POST["genero"]);

    if (empty($nombre) || empty($plataforma) || empty($anio)) {
        $mensaje = "Nombre, plataforma y año son obligatorios.";
    } elseif (!is_numeric($anio) || $anio < 1950 || $anio > 2100) {
        $mensaje = "El año de lanzamiento no es válido.";
    } else {

        $sql = "UPDATE videojuegos
                SET nombre = ?, plataforma = ?, anio_lanzamiento = ?, genero = ?
                WHERE id = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssisi", $nombre, $plataforma, $anio, $genero, $id);

        if ($stmt->execute()) {
            header("Location: listar.php");
            exit;
        } else {
            $mensaje = "Error al modificar el videojuego.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar videojuego</title>
</head>
<body>

    <h1>Modificar videojuego</h1>

    <?php if ($mensaje != ""): ?>
        <p style="color:red;"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nombre:<br>
            <input type="text" name="nombre" maxlength="255" required
                   value="<?= htmlspecialchars($juego['nombre']) ?>">
        </label>
        <br><br>

        <label>Plataforma:<br>
            <input type="text" name="plataforma" maxlength="100" required
                   value="<?= htmlspecialchars($juego['plataforma']) ?>">
        </label>
        <br><br>

        <label>Año de lanzamiento:<br>
            <input type="number" name="anio_lanzamiento" min="1950" max="2100" required
                   value="<?= $juego['anio_lanzamiento'] ?>">
        </label>
        <br><br>

        <label>Género:<br>
            <input type="text" name="genero" maxlength="100"
                   value="<?= htmlspecialchars($juego['genero']) ?>">
        </label>
        <br><br>

        <button type="submit">Guardar cambios</button>
    </form>

    <p><a href="listar.php">Volver al listado</a></p>

</body>
</html>