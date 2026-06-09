<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/reportes/ReporteService.php — Microservicio: Reportes
// Capa Service: Business Logic + Data Access.
// ─────────────────────────────────────────────────────────────────────────────

require_once dirname(__DIR__, 3) . '/models/ReporteModel.php';

class ReporteService {

    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        $this->model = new ReporteModel($conn);
    }

    // Implementar métodos de negocio aquí.
    // Cada método representa una operación del dominio de reportes.
}
