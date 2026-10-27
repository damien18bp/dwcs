<?php

/**
 * Funciones de acceso a la base de datos.
 */

define("DSN", "mysql:host=db;dbname=ejercicio3_1");
define("BD_USER", "usuario");
define("BD_PASS", "abc1234");

/**
 * @return PDO 
 */
function getConnection()
{
    try {
        $bd = new PDO(DSN, BD_USER, BD_PASS);
        return $bd;
    } catch (PDOException $th) {
        error_log("Error accediendo a la base de datos: " . $th->getMessage());
        die();
    }
}

/**
 * Obtiene un usuario por nic
 * @return un array con el usuario o false si no existe el usuario.
 */
function getUserByNic(string $nic): array|false
{
    $usuario = false;
    $sql = "SELECT id, nic, nombre, apellido1, apellido2, contrasena, email FROM usuarios WHERE nic = '$nic'";
    // TODO
    $db = getConnection();
    try {
        $statement = $db->query($sql);
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $th) {
        error_log("Error en la consulta $sql :" . $th->getMessage());
    } finally {
        $statement = null;
        $db = null;
    }

    return $usuario;
}

function addUser(
    string $nic,
    string $email,
    string $contrasena,
    string $nombre,
    string $apellido1,
    ?string $apellido2 = null
): bool {
    $agregado = false;
    if(isset($apellido2)){
        $sql = "INSERT INTO usuarios( nic, email, nombre, apellido1, apellido2, contrasena) VALUES ('$nic','$email','$nombre','$apellido1','$apellido2','$contrasena')";

    }else{
        $sql = "INSERT INTO usuarios( nic, email, nombre, apellido1, contrasena) VALUES ('$nic','$email','$nombre','$apellido1','$contrasena')";

    }
    try {
        $db = getConnection();
        $agregado = $db->exec($sql) === 1;
    } catch (PDOException $th) {
        error_log("Error  al insertar usuario$sql :" . $th->getMessage());
    } finally {
        $db = null;
    }
    return $agregado;
}
