<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/usuarios/UsuarioController.php — Microservicio: Usuarios
// Capa Controller (Endpoint): recibe HTTP, valida, delega a UsuarioService.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/UsuarioValidator.php';
require_once __DIR__ . '/UsuarioService.php';

class UsuarioController extends BaseController {

    private UsuarioService   $service;
    private UsuarioValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new UsuarioService($this->conn);
        $this->validator = new UsuarioValidator();
    }

    // GET|POST ?service=usuarios&action=listar
    public function listar(array $params): array {
        // TODO: implementar lógica específica de 'listar'
        return $this->ok(message: "Acción 'listar' del servicio usuarios ejecutada");
    }

    // GET|POST ?service=usuarios&action=obtener
    public function obtener(array $params): array {
        // TODO: implementar lógica específica de 'obtener'
        return $this->ok(message: "Acción 'obtener' del servicio usuarios ejecutada");
    }

    // GET|POST ?service=usuarios&action=crear
    public function crear(array $params): array {
        // TODO: implementar lógica específica de 'crear'
        return $this->ok(message: "Acción 'crear' del servicio usuarios ejecutada");
    }

    // GET|POST ?service=usuarios&action=editar
    public function editar(array $params): array {
        // TODO: implementar lógica específica de 'editar'
        return $this->ok(message: "Acción 'editar' del servicio usuarios ejecutada");
    }

    // GET|POST ?service=usuarios&action=eliminar
    public function eliminar(array $params): array {
        // TODO: implementar lógica específica de 'eliminar'
        return $this->ok(message: "Acción 'eliminar' del servicio usuarios ejecutada");
    }
}
