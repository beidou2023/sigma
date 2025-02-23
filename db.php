<?php
$host = "localhost";
$usuario = "root";
$password = "";
$db = "sigma";

$conexion = new mysqli($host, $usuario, $password, $db);
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
