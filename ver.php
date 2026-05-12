<?php
include 'config/conexion.php';

$id = $_GET['id'];

$sql = "SELECT p.*, t.nombre AS tipo_nombre, t.imagen AS tipo_imagen
        FROM pokemon p
        JOIN tipo t ON p.tipo_id = t.id
        WHERE p.id = $id";
$resultado = $conexion->query($sql);
$pokemon = $resultado->fetch_assoc();

if (!$pokemon) {
    header('Location: index.php');
    exit;
}

include 'includes/header.php';
?>

<a href="index.php" class="btn btn-secondary mb-3">← Volver al listado</a>

<div class="card bg-white">
    <div class="row g-0">
        <div class="col-md-4 text-center p-3">
            <img src="<?php echo $pokemon['imagen']; ?>" class="img-fluid">
        </div>
        <div class="col-md-8 p-3">
            <h2>#<?php echo $pokemon['numero']; ?> - <?php echo $pokemon['nombre']; ?></h2>

            <p>
                <strong>Tipo:</strong>
                <img src="<?php echo $pokemon['tipo_imagen']; ?>" width="40" title="<?php echo $pokemon['tipo_nombre']; ?>">
                <?php echo $pokemon['tipo_nombre']; ?>
            </p>

            <p><strong>Descripción:</strong></p>
            <p><?php echo $pokemon['descripcion']; ?></p>

            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="modificar.php?id=<?php echo $pokemon['id']; ?>" class="btn btn-warning">Editar</a>
                <a href="baja.php?id=<?php echo $pokemon['id']; ?>" class="btn btn-danger">Borrar</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>