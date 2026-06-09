<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/alertas/AlertaService.php — Microservicio: Alertas
// Capa Service: Business Logic + Data Access.
// ─────────────────────────────────────────────────────────────────────────────

require_once dirname(__DIR__, 3) . '/models/AlertaModel.php';

class AlertaService {

    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        $this->model = new AlertaModel($conn);
    }

    // Implementar métodos de negocio aquí.
    // Cada método representa una operación del dominio de alertas.
}
