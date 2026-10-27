<?php
//se conecta a la base de datos
require 'conexion.php';
$conexion = getConexion();


$resultado = $conexion->query("SELECT * FROM videojuegos ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Videojuegos registrados</title>
</head>
<body>

    <h1>Videojuegos registrados</h1>

    <p><a href="alta.php">Añadir videojuego</a></p>

    <table border="1" cellpadding="8">
        <tr>
            <th>Nombre</th>
            <th>Plataforma</th>
            <th>Año</th>
            <th>Género</th>
            <th>Acciones</th>
        </tr>

        <?php while ($juego = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($juego['nombre']) ?></td>
                <td><?= htmlspecialchars($juego['plataforma']) ?></td>
                <td><?= $juego['anio_lanzamiento'] ?></td>
                <td><?= htmlspecialchars($juego['genero']) ?></td>
                <td>
                    <a href="editar.php?id=<?= $juego['id'] ?>">Editar</a>
                    |
                    <a href="borrar.php?id=<?= $juego['id'] ?>"
                       onclick="return confirm('¿Seguro que quieres eliminar este videojuego?');">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>

</body>
</html>