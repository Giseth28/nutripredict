<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/reportes/ReporteController.php — Microservicio: Reportes
// Capa Controller (Endpoint): recibe HTTP, valida, delega a ReporteService.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/ReporteValidator.php';
require_once __DIR__ . '/ReporteService.php';

class ReporteController extends BaseController {

    private ReporteService   $service;
    private ReporteValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new ReporteService($this->conn);
        $this->validator = new ReporteValidator();
    }

    // GET|POST ?service=reportes&action=nutricional
    public function nutricional(array $params): array {
        // TODO: implementar lógica específica de 'nutricional'
        return $this->ok(message: "Acción 'nutricional' del servicio reportes ejecutada");
    }

    // GET|POST ?service=reportes&action=asistencia
    public function asistencia(array $params): array {
        // TODO: implementar lógica específica de 'asistencia'
        return $this->ok(message: "Acción 'asistencia' del servicio reportes ejecutada");
    }

    // GET|POST ?service=reportes&action=riesgo
    public function riesgo(array $params): array {
        // TODO: implementar lógica específica de 'riesgo'
        return $this->ok(message: "Acción 'riesgo' del servicio reportes ejecutada");
    }

    // GET|POST ?service=reportes&action=exportar
    public function exportar(array $params): array {
        // TODO: implementar lógica específica de 'exportar'
        return $this->ok(message: "Acción 'exportar' del servicio reportes ejecutada");
    }
}
