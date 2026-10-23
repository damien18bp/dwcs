<?php

/**
 * Funciones de acceso a la base de datos.
 */

define("DSN", "mysql:host=db;dbname=ejercicio3_1");
define("BD_USER", "usuario");
define("BD_PASS", "abc1234");

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
function getUserByNic(string $nic):array|false{
    $sql = "SELECT id, nic, nombre, apellido1, apellido2, contrasena, email FROM usuarios;";
    // TODO
}
