<?php
session_start();

function getConexion()
{
    //1º Tenemos que establecer la conexión entre PHP y la BD.
    $conexion = new mysqli("db", "usuarioBD", "abc123", "mi_base_de_datos", 3306);
    if ($conexion->connect_error) {
        echo "Error de conexión";
        die();
    }
    return $conexion;
}