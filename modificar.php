<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

include 'config/conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM pokemon WHERE id = $id";
$resultado = $conexion->query($sql);
$pokemon = $resultado->fetch_assoc();

if (!$pokemon) {
    header('Location: index.php');
    exit;
}

$tipos = $conexion->query("SELECT * FROM tipo ORDER BY nombre");

$opcionesTipos = '';
while ($t = $tipos->fetch_assoc()) {
    $selected = ($t['id'] == $pokemon['tipo_id']) ? 'selected' : '';
    $opcionesTipos .= "<option value=\"{$t['id']}\" $selected>{$t['nombre']}</option>\n";
}

include 'includes/header.php';

echo <<<HTML
<h2>Modificar pokémon</h2>

<form action="actualizar.php" method="POST" enctype="multipart/form-data" class="bg-white p-4">
    <input type="hidden" name="id" value="{$pokemon['id']}">
    <input type="hidden" name="imagen_actual" value="{$pokemon['imagen']}">

    <div class="mb-3">
        <label class="form-label">Número</label>
        <input type="number" name="numero" class="form-control"
               value="{$pokemon['numero']}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control"
               value="{$pokemon['nombre']}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control" rows="3">{$pokemon['descripcion']}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipo</label>
        <select name="tipo_id" class="form-select" required>
            $opcionesTipos
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Imagen actual</label><br>
        <img src="{$pokemon['imagen']}" width="80">
    </div>
    <div class="mb-3">
        <label class="form-label">Cambiar imagen (opcional)</label>
        <input type="file" name="imagen" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-warning">Guardar cambios</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>
HTML;

include 'includes/footer.php';
?>