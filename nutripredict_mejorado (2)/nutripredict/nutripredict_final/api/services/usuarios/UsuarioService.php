<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/usuarios/UsuarioService.php — Microservicio: Usuarios
// Capa Service: Business Logic + Data Access.
// ─────────────────────────────────────────────────────────────────────────────

require_once dirname(__DIR__, 3) . '/models/UsuarioModel.php';

class UsuarioService {

    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        $this->model = new UsuarioModel($conn);
    }

    // Implementar métodos de negocio aquí.
    // Cada método representa una operación del dominio de usuarios.
}
