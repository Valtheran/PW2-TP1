<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokédex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Pokédex</a>
        <?php if (isset($_SESSION['usuario'])): ?>
            <div>
                <span class="text-light">Usuario <strong><?php echo $_SESSION['usuario']; ?></strong></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm ms-2">Cerrar sesión</a>
            </div>
        <?php else: ?>
            <a href="login.php" class="btn btn-outline-light btn-sm">Ingresar</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">