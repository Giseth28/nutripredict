<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/alimentos/AlimentoService.php — Microservicio: Alimentos
// Capa Service: Business Logic + Data Access.
// ─────────────────────────────────────────────────────────────────────────────

require_once dirname(__DIR__, 3) . '/models/AlimentoModel.php';

class AlimentoService {

    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        $this->model = new AlimentoModel($conn);
    }

    // Implementar métodos de negocio aquí.
    // Cada método representa una operación del dominio de alimentos.
}
