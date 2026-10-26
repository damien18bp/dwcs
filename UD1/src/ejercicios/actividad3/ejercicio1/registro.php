<?php
require_once "bd.php";
//Controlo cuando entra por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Valido campos
    $nic = $_POST['nic'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass1 = $_POST['pass1'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $apellido1 = $_POST['apellido1'] ?? '';
    $apellido2 = $_POST['apellido2'] ?? '';

    $error = [];
    if (empty($nic)) {
        $error[] = "El campo nic es obligatorio.";
    }
    if (empty($email)) {
        $error[] = "El campo email es obligatorio.";
    }
    if (empty($nombre)) {
        $error[] = "El campo nombre es obligatorio.";
    }
    if (empty($apellido1)) {
        $error[] = "El campo apellido1 es obligatorio.";
    }
    if (empty($pass1) || empty($pass2)) {
        $error[] = "Las contraseñas son obligatorias.";
    }
    if ($pass1 !== $pass2) {
        $error[] = "Las contraseñas no coinciden.";
    }
    $apellido2 = empty($apellido2)?null:$apellido2;

    if (count($error) == 0) {
        // Hasheo contrasena
        $pass1 = sha1($pass1);
        // Agrego a la base de datos
        addUser($nic, $email, $pass1, $nombre, $apellido1, $apellido2 );
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <h1>Registro</h1>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre"><br>
        <label for="apellido1">Apellido</label>
        <input type="text" name="apellido1"><br>
        <label for="apellido2">Apellido</label>
        <input type="text" name="apellido2"><br>
        <label for="email">Correo</label>
        <input type="email" name="email"><br>
        <label for="nic">Nomrbe usuario</label>
        <input type="text" name="nic"><br>
        <label for="pass1">Contraseña</label>
        <input type="password" name="pass1"><br>
        <label for="pass2">Repita la contraseña</label>
        <input type="password" name="pass2"><br>
        <button type="submit">Guardar</button>
    </form>
    <?php
    if (isset($error) && count($error) > 0) {
        echo "<div>";
        echo "<h2>No se ha podido realizar el alta</h2><ul>";
        foreach ($error as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul></div>";
    }
    ?>
    Ya tienes cuenta? <a href="index.php">Accede</a>
</body>

</html>