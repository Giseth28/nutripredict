<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/menus/MenuValidator.php — Microservicio: Menus
// Capa Validator: verifica formato de datos antes de procesarlos.
// ─────────────────────────────────────────────────────────────────────────────

class MenuValidator {

    public function validar(array $data): array {
        $errors = [];
        if (empty(trim($data['nombre'] ?? '')))
            $errors[] = 'El nombre del menú es obligatorio';
        if (empty(trim($data['fecha'] ?? '')))
            $errors[] = 'La fecha es obligatorio';
        if (empty(trim($data['id_tipo'] ?? '')))
            $errors[] = 'El tipo de menú es obligatorio';
        return $errors;
    }
}
