<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/estudiantes/EstudianteController.php — Microservicio: Estudiantes
// Capa Controller (Endpoint): recibe HTTP, valida auth, delega a Service.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/EstudianteValidator.php';
require_once __DIR__ . '/EstudianteService.php';

class EstudianteController extends BaseController {

    private EstudianteService   $service;
    private EstudianteValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new EstudianteService($this->conn);
        $this->validator = new EstudianteValidator();
    }

    // ── GET ?service=estudiantes&action=listar ────────────────────────────────
    // Params opcionales: q (búsqueda), riesgo (filtro: alto|medio|bajo|sin_riesgo)
    public function listar(array $params): array {
        $buscar = $this->getString($params, 'q');
        $riesgo = $this->getString($params, 'riesgo');
        $data   = $this->service->listar($buscar, $riesgo);
        return $this->ok($data, count($data) . ' estudiantes encontrados');
    }

    // ── GET ?service=estudiantes&action=obtener&id=X ──────────────────────────
    public function obtener(array $params): array {
        $id = $this->getId($params);
        if (!$id) return $this->fail('ID de estudiante requerido');

        $estudiante = $this->service->obtenerPorId($id);
        return $estudiante
            ? $this->ok($estudiante)
            : $this->fail("Estudiante con ID $id no encontrado");
    }

    // ── POST ?service=estudiantes&action=crear ────────────────────────────────
    // Body: { nombre, apellido, fecha_nac, genero, id_grado, peso_kg, talla_cm }
    public function crear(array $params): array {
        $errors = $this->validator->validarCreacion($params);
        if ($errors) return $this->fail('Datos inválidos', $errors);

        $ok = $this->service->crear($params);
        return $ok
            ? $this->ok(message: 'Estudiante registrado correctamente')
            : $this->fail('Error al guardar. Verifica los datos e inténtalo de nuevo.');
    }

    // ── POST ?service=estudiantes&action=editar&id=X ──────────────────────────
    public function editar(array $params): array {
        $id = $this->getId($params);
        if (!$id) return $this->fail('ID de estudiante requerido');

        $errors = $this->validator->validarEdicion($params);
        if ($errors) return $this->fail('Datos inválidos', $errors);

        $ok = $this->service->actualizar($id, $params);
        return $ok
            ? $this->ok(message: 'Estudiante actualizado correctamente')
            : $this->fail('Error al actualizar.');
    }

    // ── POST ?service=estudiantes&action=eliminar&id=X ────────────────────────
    public function eliminar(array $params): array {
        $id = $this->getId($params);
        if (!$id) return $this->fail('ID de estudiante requerido');

        $this->service->eliminar($id);
        return $this->ok(message: 'Estudiante eliminado');
    }

    // ── GET ?service=estudiantes&action=resumen ───────────────────────────────
    // Devuelve conteos rápidos para el dashboard
    public function resumen(array $params): array {
        return $this->ok($this->service->resumen());
    }

    // ── GET ?service=estudiantes&action=grados ────────────────────────────────
    public function grados(array $params): array {
        return $this->ok($this->service->listarGrados());
    }
}
