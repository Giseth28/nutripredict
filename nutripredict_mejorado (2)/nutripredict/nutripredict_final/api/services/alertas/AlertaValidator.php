<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/alertas/AlertaValidator.php — Microservicio: Alertas
// Capa Validator: verifica formato de datos antes de procesarlos.
// ─────────────────────────────────────────────────────────────────────────────

class AlertaValidator {

    public function validar(array $data): array {
        $errors = [];
        if (empty(trim($data['id_estudiante'] ?? '')))
            $errors[] = 'El estudiante es obligatorio';
        if (empty(trim($data['tipo'] ?? '')))
            $errors[] = 'El tipo de alerta es obligatorio';
        return $errors;
    }
}
