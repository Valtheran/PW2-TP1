<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

include 'config/conexion.php';

$id           = $_POST['id'];
$numero       = $_POST['numero'];
$nombre       = $_POST['nombre'];
$descripcion  = $_POST['descripcion'];
$tipo_id      = $_POST['tipo_id'];
$imagenActual = $_POST['imagen_actual'];

// Si subió una imagen nueva, reemplazar; si no, dejar la actual
$rutaImagen = $imagenActual;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
$imagen = $_FILES['imagen'];
$rutaImagen = 'img/pokemones/' . $imagen['name'];
move_uploaded_file($imagen['tmp_name'], $rutaImagen);
}

$sql = "UPDATE pokemon SET
        numero = $numero,
        nombre = '$nombre',
        descripcion = '$descripcion',
        imagen = '$rutaImagen',
        tipo_id = $tipo_id
        WHERE id = $id";

$conexion->query($sql);

$conexion->close();
header('location: index.php');
exit();