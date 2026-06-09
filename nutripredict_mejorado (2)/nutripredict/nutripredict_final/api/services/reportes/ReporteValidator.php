<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/reportes/ReporteValidator.php — Microservicio: Reportes
// Capa Validator: verifica formato de datos antes de procesarlos.
// ─────────────────────────────────────────────────────────────────────────────

class ReporteValidator {

    public function validar(array $data): array {
        $errors = [];
        if (empty(trim($data['tipo'] ?? '')))
            $errors[] = 'El tipo de reporte es obligatorio';
        return $errors;
    }
}
