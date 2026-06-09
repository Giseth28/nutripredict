<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/alimentos/AlimentoValidator.php — Microservicio: Alimentos
// Capa Validator: verifica formato de datos antes de procesarlos.
// ─────────────────────────────────────────────────────────────────────────────

class AlimentoValidator {

    public function validar(array $data): array {
        $errors = [];
        if (empty(trim($data['nombre'] ?? '')))
            $errors[] = 'El nombre del alimento es obligatorio';
        if (empty(trim($data['grupo'] ?? '')))
            $errors[] = 'El grupo alimentario es obligatorio';
        return $errors;
    }
}
