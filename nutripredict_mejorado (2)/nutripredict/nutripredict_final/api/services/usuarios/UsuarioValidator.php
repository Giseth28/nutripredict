<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/usuarios/UsuarioValidator.php — Microservicio: Usuarios
// Capa Validator: verifica formato de datos antes de procesarlos.
// ─────────────────────────────────────────────────────────────────────────────

class UsuarioValidator {

    public function validar(array $data): array {
        $errors = [];
        if (empty(trim($data['nombre'] ?? '')))
            $errors[] = 'El nombre es obligatorio';
        if (empty(trim($data['email'] ?? '')))
            $errors[] = 'El email es obligatorio';
        if (empty(trim($data['rol'] ?? '')))
            $errors[] = 'El rol es obligatorio';
        return $errors;
    }
}
