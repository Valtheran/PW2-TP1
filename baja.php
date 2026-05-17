<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

include 'config/conexion.php';

$id = $_GET['id'];

$statement = $conexion->prepare("DELETE FROM pokemon WHERE id = ?");
$statement->bind_param("i", $id);
$statement->execute();
$statement->close();

$conexion->close();
header('location: index.php');
exit();