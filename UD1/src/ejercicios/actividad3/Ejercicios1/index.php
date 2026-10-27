<?php
//Se realiza la conexion con la base de datos 
require 'bd.php';

$conexion = getConexion();


$mensaje = "";
$nicCorreo = "";

//comprobamos que se haya enviado el formulario correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //recoge los datos correspondiente a correo y contraseña
    $nicCorreo = trim($_POST["nicCorreo"]);
    $password = $_POST["password"];

    //si alguno de estos esta vacio lo pedira hasta que los dos contengan datos
    if (empty($nicCorreo) || empty($password)) {
        $mensaje = "Introduce tu NIC/correo y contraseña.";
    } else {

        //prepara el programa para buscar dentro de la bs si exsiste el usuario
        $sql = "SELECT nombre, contrasenha
                                FROM usuarios
                WHERE nicUsuario = ? OR correo = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $nicCorreo, $nicCorreo);
        $stmt->execute();

        //obtiene los usuarios
        $usuario = $stmt->get_result()->fetch_assoc();

        //comprueba si algun usuario de la bd se corresponde con lo introducido e inicia sesion
        if ($usuario && password_verify($password, $usuario["contrasenha"])) {
            $_SESSION["nombre"] = $usuario["nombre"];

            echo "<h1>Bienvenido, " . htmlspecialchars($usuario["nombre"]) . "</h1>";
            exit;
        } else {
            $mensaje = "NIC/correo o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h1>Acceso a la web</h1>

    <form action="" method="post">
        <label for="nic">Nombre usuario</label>
        <input for="text" name="nic"><br>
        <label for="pass1">Contraseña</label>
        <input type="password" name="pass"></label>
        <label for="pass2">Repite la contraseña</label>
        <input type="password" name="pass2"></label>
        Ya tienes cuenta? <a href="registro.php">Registrate</a>
        <button type="submit">Acceder</button>
    </form>
</body>
</html>