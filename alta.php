<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

include 'config/conexion.php';

$tipos = $conexion->query("SELECT * FROM tipo ORDER BY nombre");

$opcionesTipos = '<option value="">-- Elegir tipo --</option>';
while ($t = $tipos->fetch_assoc()) {
    $opcionesTipos .= "<option value=\"{$t['id']}\">{$t['nombre']}</option>\n";
}

include 'includes/header.php';

echo <<<HTML
<h2>Alta de pokémon</h2>

<form action="insertar.php" method="POST" enctype="multipart/form-data" class="bg-white p-4">
    <div class="mb-3">
        <label class="form-label">Número</label>
        <input type="number" name="numero" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipo</label>
        <select name="tipo_id" class="form-select" required>
            $opcionesTipos
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Imagen</label>
        <input type="file" name="imagen" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>
HTML;

include 'includes/footer.php';
?>