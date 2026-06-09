<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/estudiantes/EstudianteService.php — Microservicio: Estudiantes
// Capa Service: lógica de negocio + acceso a datos (Data Access).
// Reutiliza EstudianteModel ya existente y agrega lógica de formateo.
// ─────────────────────────────────────────────────────────────────────────────

// Reutilizamos el Model existente del proyecto (no se reescribe lógica)
require_once dirname(__DIR__, 3) . '/models/EstudianteModel.php';

class EstudianteService {

    private EstudianteModel $model;

    public function __construct(mysqli $conn) {
        $this->model = new EstudianteModel($conn);
    }

    // ── Listar estudiantes con filtros ────────────────────────────────────────
    public function listar(string $buscar = '', string $filtroRiesgo = ''): array {
        $result   = $this->model->obtenerTodos($buscar, $filtroRiesgo);
        $lista    = [];
        while ($row = $result->fetch_assoc()) {
            $lista[] = $this->formatear($row);
        }
        return $lista;
    }

    // ── Obtener uno por ID ────────────────────────────────────────────────────
    public function obtenerPorId(int $id): ?array {
        $row = $this->model->obtenerPorId($id);
        return $row ? $this->formatear($row) : null;
    }

    // ── Crear estudiante ──────────────────────────────────────────────────────
    public function crear(array $datos): bool {
        return (bool) $this->model->crear($datos);
    }

    // ── Actualizar estudiante ─────────────────────────────────────────────────
    public function actualizar(int $id, array $datos): bool {
        return (bool) $this->model->actualizar($id, $datos);
    }

    // ── Eliminar (soft delete) ────────────────────────────────────────────────
    public function eliminar(int $id): void {
        $this->model->eliminar($id);
    }

    // ── Resumen estadístico para dashboard ────────────────────────────────────
    public function resumen(): array {
        return [
            'total'     => (int) $this->model->contarTotal(),
            'en_riesgo' => (int) $this->model->contarEnRiesgo(),
        ];
    }

    // ── Listar grados disponibles ─────────────────────────────────────────────
    public function listarGrados(): array {
        $result = $this->model->obtenerGrados();
        $grados = [];
        while ($g = $result->fetch_assoc()) {
            $grados[] = $g;
        }
        return $grados;
    }

    // ── Formatear fila de BD → objeto limpio para la API ─────────────────────
    // Business Logic: enriquece los datos con IMC calculado y etiquetas legibles
    private function formatear(array $row): array {
        $edad    = (int)($row['edad'] ?? 10);
        $imcData = EstudianteModel::calcularIMC(
            $row['peso_kg']  ?? 0,
            $row['talla_cm'] ?? 0,
            $edad
        );

        return [
            'id'               => (int)    $row['id'],
            'nombre'           =>           $row['nombre'],
            'apellido'         =>           $row['apellido'],
            'nombre_completo'  =>           "{$row['nombre']} {$row['apellido']}",
            'fecha_nac'        =>           $row['fecha_nac'],
            'edad'             => $edad,
            'genero'           =>           $row['genero'],
            'genero_label'     =>           $row['genero'] === 'M' ? 'Masculino' : 'Femenino',
            'grado'            =>           $row['grado'],
            'id_grado'         => (int)    $row['id_grado'],
            'peso_kg'          => (float)  $row['peso_kg'],
            'talla_cm'         => (float)  $row['talla_cm'],
            'imc'              => $imcData ? (float) $imcData['imc'] : null,
            'imc_clasificacion'=> $imcData ? $imcData['clasificacion'] : ($row['imc_clasificacion'] ?? null),
            'nivel_riesgo'     =>           $row['nivel_riesgo'] ?? 'sin_riesgo',
            'nivel_riesgo_label' => $this->etiquetaRiesgo($row['nivel_riesgo'] ?? 'sin_riesgo'),
        ];
    }

    private function etiquetaRiesgo(string $nivel): string {
        return match($nivel) {
            'alto'       => 'Riesgo Alto',
            'medio'      => 'Riesgo Medio',
            'bajo'       => 'Riesgo Bajo',
            'sin_riesgo' => 'Sin Riesgo',
            default      => ucfirst($nivel),
        };
    }
}
