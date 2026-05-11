<?php
// =====================================================
// Helper: generar hash de password
// =====================================================
// Si querés cambiar el password del admin (o agregar otro
// usuario), abrí este archivo en el navegador
// (http://localhost/pokedex/generar_hash.php), copiá el
// hash que aparece y pegalo en el INSERT del SQL.
//
// IMPORTANTE: borrá este archivo antes de entregar el TP.
// No es código de producción.
// =====================================================

$password = 'admin123';   // <-- cambiá esto por el password que quieras

$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<h2>Hash generado</h2>";
echo "<p>Password en texto: <code>" . htmlspecialchars($password) . "</code></p>";
echo "<p>Hash para guardar en la base:</p>";
echo "<pre style='background:#eee;padding:10px'>" . htmlspecialchars($hash) . "</pre>";
echo "<p>Verificación: ";
echo password_verify($password, $hash) ? "OK ✓" : "FALLA ✗";
echo "</p>";