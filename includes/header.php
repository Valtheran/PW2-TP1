<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Si hay un usuario logueado, muestro los botones de admin. Si no, solo el de ingresar.
$navUsuario = '';
if (isset($_SESSION['usuario'])) {
    $navUsuario = <<<NAV
    <div class="nav-acciones">
        <a href="alta.php" class="btn btn-success btn-sm">+ Nuevo pokémon</a>
        <a href="logout.php" class="btn btn-outline-light btn-sm ms-2">Cerrar sesión</a>
    </div>
    NAV;
} else {
    $navUsuario = '<a href="login.php" class="btn btn-outline-light btn-sm">Ingresar</a>';
}

echo <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokédex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #ee1515 !important;  
            border-bottom: 4px solid #ffcb05;     
        }

        a.navbar-brand {
            font-size: 26px;
            font-weight: 700;
            color: white !important;
            text-shadow: 1px 1px 0px #00000040;
        }

        input.form-control::placeholder {
            color: #00000030;
        }

        input.form-control {
            border: 1.7px solid #00000030;
        }

        tr {
            text-align: center;
        }

        th {
            border: none;
        }

        /* Botón de ingresar / cerrar sesión */
        a.btn.btn-outline-light.btn-sm {
            font-size: 20px;
            padding: 0px 25px 5px 25px;
            text-shadow: 0.3px 0px 0px white;
            box-shadow: 1px 1px 0px #ffffff70;
        }

        /* Botón de editar (amarillo) */
        a.btn.btn-warning.btn-sm {
            box-shadow: 2px 2px 0px black;
            padding-right: 15px;
            padding-left: 15px;
            text-shadow: 0.3px 0px 0px black;
            margin-right: 5px;
        }

        /* Botón de borrar (rojo) */
        a.btn.btn-danger.btn-sm {
            box-shadow: 2px 2px 0px black;
            padding-right: 15px;
            padding-left: 15px;
            text-shadow: 0.3px 0px 0px white;
            margin-left: 5px;
        }

        /* Botón de nuevo pokémon (verde) */
        a.btn.btn-success.btn-sm {
            font-size: 18px;
            padding: 0px 25px 5px 25px;
        }

        /*Tablet*/
        @media (max-width: 768px) {
            a.navbar-brand {
                font-size: 20px;
            }

            a.btn.btn-outline-light.btn-sm,
            a.btn.btn-success.btn-sm {
                font-size: 16px;
                padding: 0px 15px 3px 15px;
            }

            a.btn.btn-warning.btn-sm,
            a.btn.btn-danger.btn-sm {
                padding-right: 10px;
                padding-left: 10px;
                margin-right: 2px;
                margin-left: 2px;
            }
        }

        /* Celular */
        @media (max-width: 576px) {
            /* navbar en columna y centrado */
            .navbar .container {
                flex-direction: column;
                gap: 10px;
            }

            .nav-acciones {
                display: flex;
                justify-content: center;
            }

            a.navbar-brand {
                font-size: 18px;
            }

            tr {
                font-size: 13px;
            }

            a.btn.btn-outline-light.btn-sm,
            a.btn.btn-success.btn-sm {
                font-size: 14px;
                padding: 0px 10px 2px 10px;
            }

            a.btn.btn-warning.btn-sm,
            a.btn.btn-danger.btn-sm {
                padding-right: 6px;
                padding-left: 6px;
                font-size: 12px;
                height: 30px;
            }

            /* input arriba, botón abajo */
            .input-group {
                flex-direction: column;
            }

            .input-group .form-control,
            .input-group .btn {
                width: 100%;
                border-radius: 6px !important;
            }

            .input-group .form-control {
                margin-bottom: 8px;
            }
        }
    </style>
</head>
<body class="bg-light">

<!-- Barra de navegación de arriba -->
<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Pokédex</a>
        $navUsuario
    </div>
</nav>

<div class="container">
HTML;
