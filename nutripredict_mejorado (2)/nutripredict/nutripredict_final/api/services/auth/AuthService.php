<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/services/auth/AuthService.php — Microservicio: Autenticación
// Capa Service: lógica de negocio + acceso a datos.
// Maneja login, tokens y perfiles de usuario.
// ─────────────────────────────────────────────────────────────────────────────

class AuthService {

    private mysqli $conn;
    private const TOKEN_EXPIRA_HORAS = 8;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    // ── Login: valida credenciales y genera token ─────────────────────────────
    public function login(string $email, string $password): ?array {
        $stmt = $this->conn->prepare(
            "SELECT id, nombre, apellido, email, password, rol, activo
             FROM usuarios WHERE email = ? LIMIT 1"
        );
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $usuario = $stmt->get_result()->fetch_assoc();

        if (!$usuario || !$usuario['activo']) return null;
        if (!password_verify($password, $usuario['password'])) return null;

        // Crear token de acceso
        $token = $this->crearToken($usuario['id']);

        // Guardar en sesión (para compatibilidad con vistas PHP existentes)
        if (!session_id()) session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario']    = [
            'id'       => $usuario['id'],
            'nombre'   => $usuario['nombre'],
            'apellido' => $usuario['apellido'],
            'email'    => $usuario['email'],
            'rol'      => $usuario['rol'],
        ];

        // No devolver el hash de contraseña
        unset($usuario['password']);

        return ['usuario' => $_SESSION['usuario'], 'token' => $token];
    }

    // ── Logout: invalida token y destruye sesión ──────────────────────────────
    public function logout(?string $token, ?int $usuarioId): void {
        if ($token) {
            $stmt = $this->conn->prepare("DELETE FROM api_tokens WHERE token = ?");
            $stmt->bind_param('s', $token);
            $stmt->execute();
        }

        if (session_id()) {
            session_destroy();
        }
    }

    // ── Obtener perfil del usuario autenticado ────────────────────────────────
    public function obtenerPerfil(int $id): ?array {
        $stmt = $this->conn->prepare(
            "SELECT id, nombre, apellido, email, rol FROM usuarios WHERE id = ? AND activo = 1"
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    // ── Generar y guardar token en BD ─────────────────────────────────────────
    private function crearToken(int $usuarioId): string {
        $token   = bin2hex(random_bytes(32)); // 64 chars hex
        $expira  = date('Y-m-d H:i:s', strtotime('+' . self::TOKEN_EXPIRA_HORAS . ' hours'));

        // Eliminar tokens anteriores del usuario (un token activo por usuario)
        $del = $this->conn->prepare("DELETE FROM api_tokens WHERE usuario_id = ?");
        $del->bind_param('i', $usuarioId);
        $del->execute();

        // Insertar nuevo token
        $ins = $this->conn->prepare(
            "INSERT INTO api_tokens (token, usuario_id, expira_en) VALUES (?, ?, ?)"
        );
        $ins->bind_param('sis', $token, $usuarioId, $expira);
        $ins->execute();

        return $token;
    }
}
