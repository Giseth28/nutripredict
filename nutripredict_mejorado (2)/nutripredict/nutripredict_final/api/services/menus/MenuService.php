<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/menus/MenuService.php — Microservicio: Menus
// Capa Service: Business Logic + Data Access.
// ─────────────────────────────────────────────────────────────────────────────

require_once dirname(__DIR__, 3) . '/models/MenuModel.php';

class MenuService {

    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        $this->model = new MenuModel($conn);
    }

    // Implementar métodos de negocio aquí.
    // Cada método representa una operación del dominio de menus.
}
