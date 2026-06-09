<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/menus/MenuController.php — Microservicio: Menus
// Capa Controller (Endpoint): recibe HTTP, valida, delega a MenuService.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/MenuValidator.php';
require_once __DIR__ . '/MenuService.php';

class MenuController extends BaseController {

    private MenuService   $service;
    private MenuValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new MenuService($this->conn);
        $this->validator = new MenuValidator();
    }

    // GET|POST ?service=menus&action=listar
    public function listar(array $params): array {
        // TODO: implementar lógica específica de 'listar'
        return $this->ok(message: "Acción 'listar' del servicio menus ejecutada");
    }

    // GET|POST ?service=menus&action=obtener
    public function obtener(array $params): array {
        // TODO: implementar lógica específica de 'obtener'
        return $this->ok(message: "Acción 'obtener' del servicio menus ejecutada");
    }

    // GET|POST ?service=menus&action=crear
    public function crear(array $params): array {
        // TODO: implementar lógica específica de 'crear'
        return $this->ok(message: "Acción 'crear' del servicio menus ejecutada");
    }

    // GET|POST ?service=menus&action=editar
    public function editar(array $params): array {
        // TODO: implementar lógica específica de 'editar'
        return $this->ok(message: "Acción 'editar' del servicio menus ejecutada");
    }

    // GET|POST ?service=menus&action=eliminar
    public function eliminar(array $params): array {
        // TODO: implementar lógica específica de 'eliminar'
        return $this->ok(message: "Acción 'eliminar' del servicio menus ejecutada");
    }

    // GET|POST ?service=menus&action=deldia
    public function deldia(array $params): array {
        // TODO: implementar lógica específica de 'deldia'
        return $this->ok(message: "Acción 'deldia' del servicio menus ejecutada");
    }
}
