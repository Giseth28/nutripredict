<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/auth/AuthController.php — Microservicio: Autenticación
// Capa Controller (Endpoint): recibe peticiones HTTP, delega a AuthService.
// ─────────────────────────────────────────────────────────────────────────────

require_once __DIR__ . '/AuthValidator.php';
require_once __DIR__ . '/AuthService.php';

class AuthController extends BaseController {

    private AuthService   $service;
    private AuthValidator $validator;

    public function __construct() {
        parent::__construct();
        $this->service   = new AuthService($this->conn);
        $this->validator = new AuthValidator();
    }

    // ── POST /gateway.php?service=auth&action=login ───────────────────────────
    // Body: { "email": "...", "password": "..." }
    public function login(array $params): array {
        $errors = $this->validator->validarLogin($params);
        if ($errors) return $this->fail('Datos inválidos', $errors);

        $result = $this->service->login(
            $this->getString($params, 'email'),
            $params['password'] ?? ''
        );

        if (!$result) return $this->fail('Credenciales incorrectas o usuario inactivo');

        return $this->ok([
            'usuario' => $result['usuario'],
            'token'   => $result['token'],
        ], 'Sesión iniciada');
    }

    // ── POST /gateway.php?service=auth&action=logout ──────────────────────────
    public function logout(array $params): array {
        $token = $this->getString($params, 'token');
        $this->service->logout($token, $this->getUsuarioId());
        return $this->ok(message: 'Sesión cerrada');
    }

    // ── GET /gateway.php?service=auth&action=status (ruta pública) ───────────
    public function status(array $params): array {
        if (!session_id()) session_start();
        $autenticado = isset($_SESSION['usuario_id']);
        return $this->ok([
            'autenticado' => $autenticado,
            'usuario'     => $autenticado ? ($_SESSION['usuario'] ?? null) : null,
        ]);
    }

    // ── GET /gateway.php?service=auth&action=perfil ───────────────────────────
    public function perfil(array $params): array {
        $id = $this->getUsuarioId();
        if (!$id) return $this->fail('No autenticado');
        $perfil = $this->service->obtenerPerfil($id);
        return $perfil ? $this->ok($perfil) : $this->fail('Usuario no encontrado');
    }
}
