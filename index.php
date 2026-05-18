<?php
include 'config/conexion.php';
include 'includes/header.php';

// Tomar el texto de búsqueda
$busqueda = '';
if (isset($_GET['buscar'])) {
    $busqueda = trim($_GET['buscar']);
}

$mensaje = '';

if ($busqueda == '') {
    // Sin búsqueda: traer todos
    $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
            FROM pokemon p
            JOIN tipo t ON p.tipo_id = t.id
            ORDER BY p.numero";
    $resultado = $conexion->query($sql);
} else {
    // Buscar por nombre, tipo o número
    $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
            FROM pokemon p
            JOIN tipo t ON p.tipo_id = t.id
            WHERE p.nombre LIKE '%$busqueda%'
               OR t.nombre LIKE '%$busqueda%'
               OR p.numero LIKE '%$busqueda%'
            ORDER BY p.numero";
    $resultado = $conexion->query($sql);

    // Si no encontró nada, mostrar todos
    if ($resultado->num_rows == 0) {
        $mensaje = 'Pokémon no encontrado. Mostrando todos:';
        $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
                FROM pokemon p
                JOIN tipo t ON p.tipo_id = t.id
                ORDER BY p.numero";
        $resultado = $conexion->query($sql);
    }
}

$pokemones = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<form method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="buscar" class="form-control"
               placeholder="Ingrese el nombre, tipo o número de pokémon"
               value="<?php echo $busqueda; ?>">
        <button class="btn btn-primary">¿Quién es este pokémon?</button>
    </div>
</form>

<?php if ($mensaje != ''): ?>
    <div class="alert alert-warning"><?php echo $mensaje; ?></div>
<?php endif; ?>

<table class="table table-hover bg-white">
    <thead class="table-dark">
        <tr>
            <th>Imagen</th>
            <th>Tipo</th>
            <th>Número</th>
            <th>Nombre</th>
            <?php if (isset($_SESSION['usuario'])): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pokemones as $p): ?>
            <tr>
                <td><img src="<?php echo $p['imagen']; ?>" width="100"></td>
                <td><img src="<?php echo $p['tipo_imagen']; ?>" width="40" style="padding-top: 1.5rem;" title="<?php echo $p['tipo_nombre']; ?>"></td>
                <td style="padding-top: 2.5rem;"><?php echo $p['numero']; ?></td>
                <td style="padding-top: 2.5rem;"><a href="ver.php?id=<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></a></td>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <td>
                        <a href="modificar.php?id=<?php echo $p['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="baja.php?id=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm">Borrar</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>