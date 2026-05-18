<?php
include 'config/conexion.php';
include 'includes/header.php';

$buscarTexto = '';
if (isset($_GET['buscar']) == true) {
    $buscarTexto = trim($_GET['buscar']);
}

$mensaje = '';
if ($buscarTexto == '') {
//  Si no hay busquedas, hay que traer todos los pokemones.
    $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
            FROM pokemon p
            JOIN tipo t ON p.tipo_id = t.id
            ORDER BY p.numero";
    $resultado = $conexion->query($sql);
} else {
//  Buscar por nombre, tipo o número.
    $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
            FROM pokemon p
            JOIN tipo t ON p.tipo_id = t.id
            WHERE p.nombre LIKE '%$buscarTexto%'
               OR t.nombre LIKE '%$buscarTexto%'
               OR p.numero LIKE '%$buscarTexto%'
            ORDER BY p.numero";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 0) {
//      Si no se encuentra ningun pokemon, entonces se muestran todos.
        $mensaje = 'Pokémon no encontrado. Pokemones disponibles:';

        $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
                FROM pokemon p
                JOIN tipo t ON p.tipo_id = t.id
                ORDER BY p.numero";
        $resultado = $conexion->query($sql);
    }
}

$pokemones = $resultado->fetch_all(MYSQLI_ASSOC); // Convertir todo en un array asociativo.
?>

    <style>
        a.navbar-brand {
            font-size: 25px;
            text-shadow: 0.3px 0px 0px white;
        }

        input.form-control::placeholder {
            color: #00000030;
        }

        input.form-control {
            border: 1.7px solid #00000030;
            box-shadow: 0px 0px 5px #00000029;
        }

        button.btn.btn-primary {
            text-shadow: 0.3px 0 0px white;
            box-shadow: 0.3px 0px 0px #0d6efd, inset -3px 0px 0px #00000020;
        }

        tr {
            text-align: center;
            text-shadow: 0.3px 0px 0px white;
        }

        th {
            border: none;
        }

        a.btn.btn-outline-light.btn-sm {
            font-size: 20px;
            padding: 0px 25px 5px 25px;
            text-shadow: 0.3px 0px 0px white;
            box-shadow: 1px 1px 0px #ffffff70;
        }

        a.btn.btn-warning.btn-sm {
            box-shadow: 2px 2px 0px black;
            padding-right: 15px;
            padding-left: 15px;
            text-shadow: 0.3px 0px 0px black;
            margin-right: 5px;
        }

        a.btn.btn-danger.btn-sm {
            box-shadow: 2px 2px 0px black;
            padding-right: 15px;
            padding-left: 15px;
            text-shadow: 0.3px 0px 0px white;
            margin-left: 5px;
        }

        a.btn.btn-success.btn-sm {
            box-shadow: 0.3px 0px 0px #198754;
            text-shadow: 0.3px 0px 0px white;
            font-size: 20px;
            padding: 0px 25px 5px 25px;
        }
    </style>

    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Ingrese el nombre, tipo o número de pokémon: " value="<?php echo $buscarTexto; ?>">
            <button class="btn btn-primary">¿Quién es este pokémon?</button>
        </div>
    </form>

<?php
if ($mensaje != '') {
    echo '<div class="alert alert-warning">' . $mensaje . '</div>';
}
?>

    <table class="table table-hover bg-white">
        <thead class="table-dark">
        <tr>
            <th>Imagen</th>
            <th>Tipo</th>
            <th>Número</th>
            <th>Nombre</th>

            <?php
            if (isset($_SESSION['usuario'])) {
                echo '<th>Acciones</th>';
            }
            ?>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($pokemones as $p): ?>
            <tr>
                <td><img src="<?php echo $p['imagen']; ?>" width="60"></td>
                <td><img src="<?php echo $p['tipo_imagen']; ?>" width="50" title="<?php echo $p['tipo_nombre']; ?>"></td>
                <td><?php echo $p['numero']; ?></td>
                <td><a style="text-shadow: 0.3px 0px 0px #0d6efd" href="ver.php?id=<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></a></td>

                <?php
                if (isset($_SESSION['usuario']) == true) {
                    echo '<td>
                    <a href="modificar.php?id=' . $p['id'] . '" class="btn btn-warning btn-sm">Editar</a>
                    <a href="baja.php?id=' . $p['id'] . '" class="btn btn-danger btn-sm">Borrar</a>
                    </td>';
                }
                ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php include 'includes/footer.php'; ?>