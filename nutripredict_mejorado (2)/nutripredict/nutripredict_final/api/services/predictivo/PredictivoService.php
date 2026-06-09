<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/predictivo/PredictivoService.php — Microservicio: Predictivo
// Capa Service: Business Logic + Data Access.
// ─────────────────────────────────────────────────────────────────────────────


class PredictivoService {

    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        // Sin modelo directo — usa consultas propias
    }

    // Implementar métodos de negocio aquí.
    // Cada método representa una operación del dominio de predictivo.
}
