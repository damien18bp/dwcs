<?php
//se conecta a la base de datos
require 'conexion.php';
$conexion = getConexion();

$id = $_GET["id"] ?? null;

if ($id === null || !is_numeric($id)) {
    header("Location: listar.php");
    exit;
}

$stmt = $conexion->prepare("DELETE FROM videojuegos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: listar.php");
exit;