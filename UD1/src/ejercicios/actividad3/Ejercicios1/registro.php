<?php
//realiza la conexión con la base de datos
require 'bd.php';
$conexion = getConexion();


$mensaje = "";

//Comprueba que el formulario se ha enviado correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // recoge todos los datos introducidos. trim (quita espacios)
    $nombre = trim($_POST["nombre"]);
    $apellido1 = trim($_POST["apellido1"]);
    $apellido2 = trim($_POST["apellido2"]);
    $nicUsuario = trim($_POST["nicUsuario"]);
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    if (
        //si hay alguna variable vacia salta un error
        empty($nombre) || empty($apellido1) ||
        empty($nicUsuario) || empty($correo) || empty($password)
    ) {
        $mensaje = "Faltan campos obligatorios.";
    } elseif (
        //si hay alguna variable con mas caracteres de los permitidos lo informa
        strlen($nombre) > 60 ||
        strlen($apellido1) > 100 ||
        strlen($apellido2) > 100 ||
        strlen($nicUsuario) > 30 ||
        strlen($correo) > 320
    ) {
        $mensaje = "Alguno de los campos supera la longitud permitida.";
        
        //comprueba que el correo este en un formato valido
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo electrónico no es válido.";
    } else {
        //convierte la contraeña en formato hash
        $hash = password_hash($password, PASSWORD_DEFAULT);


        //prepara la base para insertar los nuevos datos creados
        $sql = "INSERT INTO usuarios 
                (nombre, apellido1, apellido2, nicUsuario, correo, contrasenha)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param(
            "ssssss",
            $nombre,
            $apellido1,
            $apellido2,
            $nicUsuario,
            $correo,
            $hash
        );

        //comprueba que todo este correcto y que funcione
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

    <h1>Registro de usuario</h1>

    <?php if ($mensaje != ""): ?>
        <p style="color:red;"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nombre:<br>
            <input type="text" name="nombre" maxlength="60" required>
        </label>
        <br><br>

        <label>Primer apellido:<br>
            <input type="text" name="apellido1" maxlength="100" required>
        </label>
        <br><br>

        <label>Segundo apellido:<br>
            <input type="text" name="apellido2" maxlength="100">
        </label>
        <br><br>

        <label>NIC de usuario:<br>
            <input type="text" name="nicUsuario" maxlength="30" required>
        </label>
        <br><br>

        <label>Correo electrónico:<br>
            <input type="email" name="correo" maxlength="320" required>
        </label>
        <br><br>

        <label>Contraseña:<br>
            <input type="password" name="password" required>
        </label>
        <br><br>

        <button type="submit">Registrarme</button>
    </form>

    <p><a href="login.php">Ya tengo cuenta</a></p>

</body>
</html>