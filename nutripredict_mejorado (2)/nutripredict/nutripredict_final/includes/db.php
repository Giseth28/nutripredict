<?php
// ─────────────────────────────────────────────────────────────────────────────
// includes/db.php — Conexión a la base de datos
// Compatible con variables de entorno de Docker (getenv) y con configuración
// local directa como fallback. NO cambiar los valores por defecto para Docker.
// ─────────────────────────────────────────────────────────────────────────────

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'nutripredict_db');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    $isApi = str_contains($_SERVER['REQUEST_URI'] ?? '', '/api/');
    if ($isApi) {
        header('Content-Type: application/json');
        die(json_encode(['success' => false, 'error' => 'Error de conexión a la base de datos']));
    } else {
        die('<h3 style="color:red">Error de conexión: ' . htmlspecialchars($conn->connect_error) . '</h3>');
    }
}
