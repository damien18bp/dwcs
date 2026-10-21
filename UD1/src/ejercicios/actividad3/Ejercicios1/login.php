<?php
require 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nicCorreo = trim($_POST["nicCorreo"]);
    $password = $_POST["password"];

    $sql = "SELECT id, nombre, password_hash 
            FROM usuarios 
            WHERE nic = ? OR correo = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nicCorreo, $nicCorreo);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($password, $usuario["password_hash"])) {
        $_SESSION["id_usuario"] = $usuario["id"];
        $_SESSION["nombre"] = $usuario["nombre"];

        echo "<h1>Bienvenido, " . htmlspecialchars($usuario["nombre"]) . "</h1>";
        echo "<a href='login.php'>Cerrar sesión</a>";
        exit;
    } else {
        $mensaje = "NIC/correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h1>Login</h1>

    <?php if ($mensaje != ""): ?>
        <p style="color:red;"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="nicCorreo" placeholder="NIC o correo" required>
        <br><br>

        <input type="password" name="password" placeholder="Contraseña" required>
        <br><br>

        <button type="submit">Entrar</button>
    </form>

    <p><a href="registro.php">No tengo cuenta</a></p>

</body>
</html>