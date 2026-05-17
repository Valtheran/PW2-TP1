<?php
// =====================================================
// Generador de hash para contraseñas de admin
// =====================================================
// Uso: abrir este archivo en el navegador
// (http://localhost/pokedex/generar_hash.php)
// Te imprime el hash de la contraseña indicada abajo.
// Después lo copiás y pegás en la tabla 'usuario' de la base.
// =====================================================

$passwordPlana = 'admin123';
echo password_hash($passwordPlana, PASSWORD_DEFAULT);
?>