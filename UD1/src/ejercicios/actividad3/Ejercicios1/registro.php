<?php
require 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $apellido1 = trim($_POST["apellido1"]);
    $apellido2 = trim($_POST["apellido2"]);
    $nic = trim($_POST["nic"]);
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    // Validaciones básicas
    if (
        empty($nombre) || empty($apellido1) || empty($nic) ||
        empty($correo) || empty($password)
    ) {
        $mensaje = "Faltan campos obligatorios.";
    } elseif (
        strlen($nombre) > 60 ||
        strlen($apellido1) > 100 ||
        strlen($apellido2) > 100 ||
        strlen($nic) > 30 ||
        strlen($correo) > 320
    ) {
        $mensaje = "Alguno de los campos supera la longitud permitida.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo no es válido.";
    } else {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios 
                (nombre, apellido1, apellido2, nic, correo, password_hash)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param(
            "ssssss",
            $nombre,
            $apellido1,
            $apellido2,
            $nic,
            $correo,
            $passwordHash
        );

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            if ($conexion->errno == 1062) {
                $mensaje = "El NIC o el correo ya están registrados.";
            } else {
                $mensaje = "Error al registrar el usuario.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

    <h1>Registro</h1>

    <?php if ($mensaje != ""): ?>
        <p style="color:red;"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="nombre" placeholder="Nombre" maxlength="60" required>
        <br><br>

        <input type="text" name="apellido1" placeholder="Primer apellido" maxlength="100" required>
        <br><br>

        <input type="text" name="apellido2" placeholder="Segundo apellido" maxlength="100">
        <br><br>

        <input type="text" name="nic" placeholder="NIC" maxlength="30" required>
        <br><br>

        <input type="email" name="correo" placeholder="Correo" maxlength="320" required>
        <br><br>

        <input type="password" name="password" placeholder="Contraseña" required>
        <br><br>

        <button type="submit">Registrarse</button>
    </form>

    <p><a href="login.php">Ya tengo cuenta</a></p>

</body>
</html>