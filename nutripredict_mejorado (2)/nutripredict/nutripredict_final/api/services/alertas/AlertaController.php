<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/alertas/AlertaController.php — Microservicio: Alertas
// Capa Controller (Endpoint): recibe HTTP, valida, delega a AlertaService.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/AlertaValidator.php';
require_once __DIR__ . '/AlertaService.php';

class AlertaController extends BaseController {

    private AlertaService   $service;
    private AlertaValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new AlertaService($this->conn);
        $this->validator = new AlertaValidator();
    }

    // GET|POST ?service=alertas&action=listar
    public function listar(array $params): array {
        // TODO: implementar lógica específica de 'listar'
        return $this->ok(message: "Acción 'listar' del servicio alertas ejecutada");
    }

    // GET|POST ?service=alertas&action=obtener
    public function obtener(array $params): array {
        // TODO: implementar lógica específica de 'obtener'
        return $this->ok(message: "Acción 'obtener' del servicio alertas ejecutada");
    }

    // GET|POST ?service=alertas&action=crear
    public function crear(array $params): array {
        // TODO: implementar lógica específica de 'crear'
        return $this->ok(message: "Acción 'crear' del servicio alertas ejecutada");
    }

    // GET|POST ?service=alertas&action=resolver
    public function resolver(array $params): array {
        // TODO: implementar lógica específica de 'resolver'
        return $this->ok(message: "Acción 'resolver' del servicio alertas ejecutada");
    }

    // GET|POST ?service=alertas&action=resumen
    public function resumen(array $params): array {
        // TODO: implementar lógica específica de 'resumen'
        return $this->ok(message: "Acción 'resumen' del servicio alertas ejecutada");
    }
}
