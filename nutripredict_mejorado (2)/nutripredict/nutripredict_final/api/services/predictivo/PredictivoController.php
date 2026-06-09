<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/predictivo/PredictivoController.php — Microservicio: Predictivo
// Capa Controller (Endpoint): recibe HTTP, valida, delega a PredictivoService.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/PredictivoValidator.php';
require_once __DIR__ . '/PredictivoService.php';

class PredictivoController extends BaseController {

    private PredictivoService   $service;
    private PredictivoValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new PredictivoService($this->conn);
        $this->validator = new PredictivoValidator();
    }

    // GET|POST ?service=predictivo&action=ejecutar
    public function ejecutar(array $params): array {
        // TODO: implementar lógica específica de 'ejecutar'
        return $this->ok(message: "Acción 'ejecutar' del servicio predictivo ejecutada");
    }

    // GET|POST ?service=predictivo&action=listar
    public function listar(array $params): array {
        // TODO: implementar lógica específica de 'listar'
        return $this->ok(message: "Acción 'listar' del servicio predictivo ejecutada");
    }

    // GET|POST ?service=predictivo&action=detalle
    public function detalle(array $params): array {
        // TODO: implementar lógica específica de 'detalle'
        return $this->ok(message: "Acción 'detalle' del servicio predictivo ejecutada");
    }
}
