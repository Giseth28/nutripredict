<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/asistencia/AsistenciaService.php — Microservicio: Asistencia
// Capa Service: Business Logic + Data Access.
// ─────────────────────────────────────────────────────────────────────────────

require_once dirname(__DIR__, 3) . '/models/AsistenciaModel.php';

class AsistenciaService {

    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        $this->model = new AsistenciaModel($conn);
    }

    // Implementar métodos de negocio aquí.
    // Cada método representa una operación del dominio de asistencia.
}
