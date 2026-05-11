<?php
include 'config/conexion.php';
include 'includes/header.php';

// Tomar el texto de búsqueda
$busqueda = '';
if (isset($_GET['buscar'])) {
    $busqueda = trim($_GET['buscar']);
}

$mensaje = '';
$pokemones = [];

if ($busqueda == '') {
    // No buscó nada: mostrar todos
    $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
            FROM pokemon p
            JOIN tipo t ON p.tipo_id = t.id
            ORDER BY p.numero";
    $resultado = $pdo->query($sql);
    $pokemones = $resultado->fetchAll();
} else {
    // Buscar por nombre, tipo o número
    $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
            FROM pokemon p
            JOIN tipo t ON p.tipo_id = t.id
            WHERE p.nombre LIKE ? OR t.nombre LIKE ? OR p.numero LIKE ?
            ORDER BY p.numero";
    $consulta = $pdo->prepare($sql);
    $valor = '%' . $busqueda . '%';
    $consulta->execute([$valor, $valor, $valor]);
    $pokemones = $consulta->fetchAll();

    // Si no encontró nada: mostrar mensaje y todos los pokémon
    if (count($pokemones) == 0) {
        $mensaje = 'Pokémon no encontrado. Mostrando todos:';
        $sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
                FROM pokemon p
                JOIN tipo t ON p.tipo_id = t.id
                ORDER BY p.numero";
        $resultado = $pdo->query($sql);
        $pokemones = $resultado->fetchAll();
    }
}
?>

<form method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="buscar" class="form-control"
               placeholder="Ingrese el nombre, tipo o número de pokémon"
               value="<?php echo htmlspecialchars($busqueda); ?>">
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
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pokemones as $p): ?>
            <tr>
                <td><img src="<?php echo $p['imagen']; ?>" width="60"></td>
                <td><img src="<?php echo $p['tipo_imagen']; ?>" width="50" title="<?php echo $p['tipo_nombre']; ?>"></td>
                <td><?php echo $p['numero']; ?></td>
                <td><a href="ver.php?id=<?php echo $p['id']; ?>"><?php echo $p['nombre']; ?></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>