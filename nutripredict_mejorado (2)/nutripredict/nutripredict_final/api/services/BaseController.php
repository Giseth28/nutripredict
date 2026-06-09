<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/BaseController.php
// Clase base que todos los controladores de microservicios extienden.
// Provee: conexión DB, helpers de respuesta y acceso a sesión.
// ─────────────────────────────────────────────────────────────────────────────

abstract class BaseController {

    protected mysqli $conn;

    public function __construct() {
        // Cada microservicio abre su propia conexión (aislamiento)
        require_once dirname(__DIR__, 2) . '/includes/db.php';
        $this->conn = $conn;
    }

    // ── Helpers de respuesta JSON ─────────────────────────────────────────────

    protected function ok(mixed $data = null, string $message = 'OK'): array {
        $r = ['success' => true, 'message' => $message];
        if ($data !== null) $r['data'] = $data;
        return $r;
    }

    protected function fail(string $error, array $details = []): array {
        $r = ['success' => false, 'error' => $error];
        if ($details) $r['details'] = $details;
        return $r;
    }

    // ── Helpers de parámetros ─────────────────────────────────────────────────

    protected function getId(array $params): int {
        return (int)($params['id'] ?? 0);
    }

    protected function getString(array $params, string $key, string $default = ''): string {
        return trim($params[$key] ?? $default);
    }

    // ── Acceso al usuario en sesión ───────────────────────────────────────────

    protected function getUsuarioId(): ?int {
        return isset($_SESSION['usuario_id']) ? (int)$_SESSION['usuario_id'] : null;
    }

    protected function getUsuario(): ?array {
        return $_SESSION['usuario'] ?? null;
    }
}
