<?php
session_start();
include 'config/conexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);
    $u = $resultado->fetch_assoc();

    if ($u && password_verify($password, $u['password'])) {
        $_SESSION['usuario'] = $u['usuario'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos.';
    }
}

include 'includes/header.php';
?>

<h2>Iniciar sesión</h2>

<?php if ($error != ''): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" class="bg-white p-4" style="max-width:400px;">
    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input type="text" name="usuario" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button class="btn btn-primary">Ingresar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php include 'includes/footer.php'; ?>