<?php
// api/services/nutribot/NutribotController.php — Microservicio: NutriBot IA
// Capa Controller: adapta nutribot.php al patrón de microservicios.
// NOTA: nutribot.php ya era un "microservicio natural" (recibía/devolvía JSON).

require_once __DIR__ . '/NutribotValidator.php';
require_once __DIR__ . '/NutribotService.php';

class NutribotController extends BaseController {

    private NutribotService   $service;
    private NutribotValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new NutribotService($this->conn);
        $this->validator = new NutribotValidator();
    }

    // POST ?service=nutribot&action=chat
    // Body: { "mensaje": "...", "historial": [...] }
    public function chat(array $params): array {
        $errors = $this->validator->validar($params);
        if ($errors) return $this->fail('Datos inválidos', $errors);

        $mensaje   = trim($params['mensaje']);
        $historial = is_array($params['historial'] ?? null) ? $params['historial'] : [];

        $respuesta = $this->service->chat($mensaje, $historial);
        return $respuesta
            ? $this->ok(['respuesta' => $respuesta])
            : $this->fail('Error al procesar el mensaje');
    }
}
