<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/nutribot/NutribotService.php — Microservicio: Nutribot
// Capa Service: Business Logic + Data Access.
// ─────────────────────────────────────────────────────────────────────────────


class NutribotService {

    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        // Sin modelo directo — usa consultas propias
    }

    // Implementar métodos de negocio aquí.
    // Cada método representa una operación del dominio de nutribot.
}
