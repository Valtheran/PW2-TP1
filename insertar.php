<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

include 'config/conexion.php';

$numero      = $_POST['numero'];
$nombre      = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$tipo_id     = $_POST['tipo_id'];

// Procesar la imagen subida
$imagen = $_FILES['imagen'];
$rutaImagen = 'img/pokemones/' . $imagen['name'];
move_uploaded_file($imagen['tmp_name'], $rutaImagen);

$sql = "INSERT INTO pokemon (numero, nombre, descripcion, imagen, tipo_id)
        VALUES ($numero, '$nombre', '$descripcion', '$rutaImagen', $tipo_id)";

$conexion->query($sql);

$conexion->close();
header('location: index.php');
exit();