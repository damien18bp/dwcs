<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "primera_base");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}