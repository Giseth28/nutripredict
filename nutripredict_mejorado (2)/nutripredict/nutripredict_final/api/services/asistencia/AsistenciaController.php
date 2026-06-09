<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/asistencia/AsistenciaController.php — Microservicio: Asistencia
// Capa Controller (Endpoint): recibe HTTP, valida, delega a AsistenciaService.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/AsistenciaValidator.php';
require_once __DIR__ . '/AsistenciaService.php';

class AsistenciaController extends BaseController {

    private AsistenciaService   $service;
    private AsistenciaValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new AsistenciaService($this->conn);
        $this->validator = new AsistenciaValidator();
    }

    // GET|POST ?service=asistencia&action=listar
    public function listar(array $params): array {
        // TODO: implementar lógica específica de 'listar'
        return $this->ok(message: "Acción 'listar' del servicio asistencia ejecutada");
    }

    // GET|POST ?service=asistencia&action=registrar
    public function registrar(array $params): array {
        // TODO: implementar lógica específica de 'registrar'
        return $this->ok(message: "Acción 'registrar' del servicio asistencia ejecutada");
    }

    // GET|POST ?service=asistencia&action=resumen
    public function resumen(array $params): array {
        // TODO: implementar lógica específica de 'resumen'
        return $this->ok(message: "Acción 'resumen' del servicio asistencia ejecutada");
    }
}
