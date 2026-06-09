<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/auth/AuthValidator.php — Microservicio: Autenticación
// Capa Validator: verifica que los datos tengan formato correcto ANTES de
// procesarlos. Evita que datos malformados lleguen a la lógica de negocio.
// ─────────────────────────────────────────────────────────────────────────────

class AuthValidator {

    public function validarLogin(array $data): array {
        $errors = [];

        $email = trim($data['email'] ?? '');
        if (empty($email)) {
            $errors[] = 'El email es obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El email no tiene un formato válido';
        }

        if (empty($data['password'] ?? '')) {
            $errors[] = 'La contraseña es obligatoria';
        }

        return $errors;
    }
}
