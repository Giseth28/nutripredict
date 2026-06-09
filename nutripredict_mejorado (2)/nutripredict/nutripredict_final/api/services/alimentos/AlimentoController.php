<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/alimentos/AlimentoController.php — Microservicio: Alimentos
// Capa Controller (Endpoint): recibe HTTP, valida, delega a AlimentoService.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/AlimentoValidator.php';
require_once __DIR__ . '/AlimentoService.php';

class AlimentoController extends BaseController {

    private AlimentoService   $service;
    private AlimentoValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new AlimentoService($this->conn);
        $this->validator = new AlimentoValidator();
    }

    // GET|POST ?service=alimentos&action=listar
    public function listar(array $params): array {
        // TODO: implementar lógica específica de 'listar'
        return $this->ok(message: "Acción 'listar' del servicio alimentos ejecutada");
    }

    // GET|POST ?service=alimentos&action=obtener
    public function obtener(array $params): array {
        // TODO: implementar lógica específica de 'obtener'
        return $this->ok(message: "Acción 'obtener' del servicio alimentos ejecutada");
    }

    // GET|POST ?service=alimentos&action=crear
    public function crear(array $params): array {
        // TODO: implementar lógica específica de 'crear'
        return $this->ok(message: "Acción 'crear' del servicio alimentos ejecutada");
    }

    // GET|POST ?service=alimentos&action=editar
    public function editar(array $params): array {
        // TODO: implementar lógica específica de 'editar'
        return $this->ok(message: "Acción 'editar' del servicio alimentos ejecutada");
    }

    // GET|POST ?service=alimentos&action=eliminar
    public function eliminar(array $params): array {
        // TODO: implementar lógica específica de 'eliminar'
        return $this->ok(message: "Acción 'eliminar' del servicio alimentos ejecutada");
    }
}
