<?php

function getConexion()
{
    //1º Tenemos que establecer la conexión entre PHP y la BD.
    $dsn = "mysql:host=db;dbname=mi_base_de_datos";
    try {
        $conexion = new PDO($dsn, "usuarioBD", "abc123");
    } catch (PDOException $e) {
        echo "Error en la conexion con la BD.";
        die();
    }

    return $conexion;
}
/**
 * Agrega un cliente a la base de datos mi_base_de_datos utilizando
 * la PDO
 */
function addCliente(string $nombre, string $telf)
{


    $sql = "INSERT INTO clientes( nombre, telefono) VALUES ('$nombre','$telf')";
    $conexion = getConexion();
    echo "Consulta ejecutada: <br><span>$sql</span><br>";
    try {
        $filasAfectadas = $conexion->exec($sql);
        echo "Se ha agregado $filasAfectadas cliente(s)<br>";
    } catch (PDOException $th) {
        echo "Algo ha fallado en la consulta.<br>";
    }


    $conexion = null;
}

function getClientes(): array
{
    $toret = [];
    $conexion = getConexion();

    $sql = "SELECT * FROM clientes";
    $resultado = $conexion->query($sql);
    // while ($fila = $resultado->fetch()) {
    //     $toret[] = $fila; //["nombre"=>"pedro","telefono"=>"9893213" ];
    //     $fila["nombre"];
    // }
    $toret = $resultado->fetchAll();
    $conexion = null;
    return $toret;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    addCliente($_POST['nombre'], $_POST['telefono']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar clientes</title>
</head>

<body>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre"><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono"><br>
        <button type="submit">Agregar</button>
    </form>

    <?php
    //Obtengo clientes actuales
    $clientes = getClientes();
    if(count($clientes)>0){

        echo "<h1>Clientes</h1><ul>";
        foreach($clientes as $cliente){
            echo "<li>".$cliente["nombre"]."- ".$cliente["telefono"]."</li>";
        }
        echo "</ul>";
    }
    ?>
</body>

</html>