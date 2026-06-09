<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/nutribot/NutribotValidator.php — Microservicio: Nutribot
// Capa Validator: verifica formato de datos antes de procesarlos.
// ─────────────────────────────────────────────────────────────────────────────

class NutribotValidator {

    public function validar(array $data): array {
        $errors = [];
        if (empty(trim($data['mensaje'] ?? '')))
            $errors[] = 'El mensaje es obligatorio';
        return $errors;
    }
}
