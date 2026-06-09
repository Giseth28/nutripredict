<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/estudiantes/EstudianteValidator.php — Microservicio: Estudiantes
// Capa Validator: verifica formato y presencia de campos ANTES de procesar.
// Principio: datos sucios nunca llegan a la lógica de negocio.
// ─────────────────────────────────────────────────────────────────────────────

class EstudianteValidator {

    public function validarCreacion(array $data): array {
        return $this->validar($data);
    }

    public function validarEdicion(array $data): array {
        return $this->validar($data, edicion: true);
    }

    private function validar(array $data, bool $edicion = false): array {
        $errors = [];

        // Campos de texto obligatorios
        if (empty(trim($data['nombre'] ?? '')))
            $errors[] = 'El nombre es obligatorio';

        if (empty(trim($data['apellido'] ?? '')))
            $errors[] = 'El apellido es obligatorio';

        // Fecha de nacimiento
        if (empty($data['fecha_nac'] ?? '')) {
            $errors[] = 'La fecha de nacimiento es obligatoria';
        } elseif (!$this->esFechaValida($data['fecha_nac'])) {
            $errors[] = 'La fecha de nacimiento debe tener formato YYYY-MM-DD';
        } else {
            $nacimiento = new DateTime($data['fecha_nac']);
            $hoy        = new DateTime();
            $edad       = $hoy->diff($nacimiento)->y;
            if ($edad < 1 || $edad > 25)
                $errors[] = 'La edad calculada ($edad años) no parece válida para un estudiante';
        }

        // Grado
        if (empty($data['id_grado'] ?? '')) {
            $errors[] = 'El grado es obligatorio';
        } elseif (!ctype_digit((string)$data['id_grado']) || (int)$data['id_grado'] <= 0) {
            $errors[] = 'El grado debe ser un identificador numérico positivo';
        }

        // Género (opcional, pero si viene debe ser válido)
        if (!empty($data['genero']) && !in_array($data['genero'], ['M', 'F'])) {
            $errors[] = "El género debe ser 'M' o 'F'";
        }

        // Peso y talla (opcionales, pero si vienen deben ser numéricos positivos)
        if (!empty($data['peso_kg'])) {
            if (!is_numeric($data['peso_kg']) || (float)$data['peso_kg'] <= 0)
                $errors[] = 'El peso debe ser un número positivo (en kg)';
            elseif ((float)$data['peso_kg'] > 300)
                $errors[] = 'El peso ingresado supera el rango válido';
        }

        if (!empty($data['talla_cm'])) {
            if (!is_numeric($data['talla_cm']) || (float)$data['talla_cm'] <= 0)
                $errors[] = 'La talla debe ser un número positivo (en cm)';
            elseif ((float)$data['talla_cm'] > 250)
                $errors[] = 'La talla ingresada supera el rango válido';
        }

        // En edición: nivel_riesgo debe ser válido si se envía
        if ($edicion && !empty($data['nivel_riesgo'])) {
            $nivelesValidos = ['sin_riesgo', 'bajo', 'medio', 'alto'];
            if (!in_array($data['nivel_riesgo'], $nivelesValidos))
                $errors[] = 'Nivel de riesgo inválido. Valores permitidos: ' . implode(', ', $nivelesValidos);
        }

        return $errors;
    }

    private function esFechaValida(string $fecha): bool {
        $d = DateTime::createFromFormat('Y-m-d', $fecha);
        return $d && $d->format('Y-m-d') === $fecha;
    }
}
