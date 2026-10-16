<?php

function getConnection(){
    //1º Tenemos que establecer la conexion entre PHP y la BD.
    $conexion = new mysqli("db", "usuarioBD", "abc123", "mi_base_de_datos", 3306);
    if ($conexion -> connect_error){
        echo "Error de conexion";
        die();
    }
}

/**
 * Agregar un cliente a la base de datos mi_base_de_datos 
 * utilizando la libreria mysqli
 */

function addcLiente(string $nombre, string $telf){

    //1º Tenemos que establecer la conexion entre PHP y la BD.
    $conexion = new mysqli("db", "usuarioBD", "abc123", "mi_base_de_datos", 3306);
    if ($conexion -> connect_error){
        echo "Error de conexion";
        die();
    }

    $sql = "INSERT INTO clientes(nombre, telefono) VALUES ('$nombre','$telf')";
    echo "COnsulta ejecutada: <br><span>$sql</span>";

    $conexion->query($sql);
    $conexion->close();
}

function getCLientes(): array{
    $toret = [];
    $conexion = 
}

if($_SERVER['REQUEST_METHOD']== "POST"){
    addcLiente($_POST['nombre'], $_POST['telefono']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar cliente</title>
</head>
<body>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre"><br>
        <label for="telefono">Telefono</label>
        <input type="text" name="telefono"><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>