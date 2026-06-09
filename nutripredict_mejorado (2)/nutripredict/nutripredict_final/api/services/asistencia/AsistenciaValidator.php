<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/asistencia/AsistenciaValidator.php — Microservicio: Asistencia
// Capa Validator: verifica formato de datos antes de procesarlos.
// ─────────────────────────────────────────────────────────────────────────────

class AsistenciaValidator {

    public function validar(array $data): array {
        $errors = [];
        if (empty(trim($data['id_estudiante'] ?? '')))
            $errors[] = 'El estudiante es obligatorio';
        if (empty(trim($data['fecha'] ?? '')))
            $errors[] = 'La fecha es obligatorio';
        return $errors;
    }
}
