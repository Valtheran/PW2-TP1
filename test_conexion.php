<?php
// =====================================================
// Test rápido: verificar que la conexión y los datos estén OK
// =====================================================
// Abrí http://localhost/pokedex/test_conexion.php y deberías
// ver la cantidad de tipos, pokémon y un usuario admin.
//
// Borrá este archivo antes de entregar.
// =====================================================

require_once 'config/conexion.php';

echo "<h2>Test de conexión a base de datos</h2>";

try {
    // Contar tipos
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM tipo");
    $tipos = $stmt->fetch();
    echo "<p>Tipos cargados: <strong>{$tipos['total']}</strong> (mínimo 4 según consigna)</p>";

    // Contar pokémon
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM pokemon");
    $pokemon = $stmt->fetch();
    echo "<p>Pokémon cargados: <strong>{$pokemon['total']}</strong></p>";

    // Contar usuarios
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuario");
    $usuarios = $stmt->fetch();
    echo "<p>Usuarios admin: <strong>{$usuarios['total']}</strong></p>";

    // Listar pokémon con su tipo (test del JOIN)
    echo "<h3>Pokémon en la base (con su tipo):</h3>";
    $stmt = $pdo->query("
        SELECT p.numero, p.nombre, t.nombre AS tipo
        FROM pokemon p
        INNER JOIN tipo t ON p.tipo_id = t.id
        ORDER BY p.numero
    ");
    echo "<ul>";
    foreach ($stmt as $fila) {
        echo "<li>#{$fila['numero']} - {$fila['nombre']} ({$fila['tipo']})</li>";
    }
    echo "</ul>";

    echo "<p style='color:green'><strong>✓ Todo funciona correctamente.</strong></p>";

} catch (PDOException $e) {
    echo "<p style='color:red'><strong>✗ Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}