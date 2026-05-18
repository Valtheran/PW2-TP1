<?php
$conexion = new mysqli("127.0.0.1", "root", "", "pokedex", 3400);
$conexion->set_charset("utf8mb4");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
