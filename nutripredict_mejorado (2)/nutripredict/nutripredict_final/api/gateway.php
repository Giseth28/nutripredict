<?php
// ─────────────────────────────────────────────────────────────────────────────
// api/gateway.php — API Gateway de NutriPredict
// Único punto de entrada para todos los microservicios.
// Uso: /api/gateway.php?service=<nombre>&action=<accion>
// ─────────────────────────────────────────────────────────────────────────────

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Pre-flight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); exit;
}

define('BASE_PATH',     dirname(__DIR__));
define('SERVICES_PATH', __DIR__ . '/services');

// ── Registro de servicios disponibles ────────────────────────────────────────
// Formato: 'nombre' => ['file' => ruta, 'class' => NombreClase]
$SERVICE_REGISTRY = [
    'auth'        => ['file' => 'auth/AuthController.php',             'class' => 'AuthController'],
    'estudiantes' => ['file' => 'estudiantes/EstudianteController.php','class' => 'EstudianteController'],
    'menus'       => ['file' => 'menus/MenuController.php',            'class' => 'MenuController'],
    'alimentos'   => ['file' => 'alimentos/AlimentoController.php',    'class' => 'AlimentoController'],
    'asistencia'  => ['file' => 'asistencia/AsistenciaController.php', 'class' => 'AsistenciaController'],
    'alertas'     => ['file' => 'alertas/AlertaController.php',        'class' => 'AlertaController'],
    'predictivo'  => ['file' => 'predictivo/PredictivoController.php', 'class' => 'PredictivoController'],
    'reportes'    => ['file' => 'reportes/ReporteController.php',      'class' => 'ReporteController'],
    'usuarios'    => ['file' => 'usuarios/UsuarioController.php',      'class' => 'UsuarioController'],
    'nutribot'    => ['file' => 'nutribot/NutribotController.php',     'class' => 'NutribotController'],
];

// ── Rutas públicas (no requieren autenticación) ───────────────────────────────
$PUBLIC_ROUTES = ['auth/login', 'auth/status'];

// ── Parsear request ───────────────────────────────────────────────────────────
$service = strtolower(trim($_GET['service'] ?? ''));
$action  = strtolower(trim($_GET['action']  ?? ''));
$route   = "$service/$action";

// Validar parámetros básicos
if (empty($service) || empty($action)) {
    gateway_error(400, 'Parámetros requeridos: service y action');
}

// Validar que el servicio exista en el registro
if (!array_key_exists($service, $SERVICE_REGISTRY)) {
    gateway_error(404, "Servicio '$service' no encontrado. Disponibles: " . implode(', ', array_keys($SERVICE_REGISTRY)));
}

// ── Capa de seguridad: verificar autenticación ────────────────────────────────
if (!in_array($route, $PUBLIC_ROUTES)) {
    session_start();

    $autenticado = isset($_SESSION['usuario_id']);

    // Soporte adicional para token Bearer (útil para clientes móviles o SPA)
    if (!$autenticado) {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        if (str_starts_with($authHeader, 'Bearer ')) {
            $token = trim(substr($authHeader, 7));
            require_once BASE_PATH . '/includes/db.php';
            $stmt = $conn->prepare(
                "SELECT usuario_id FROM api_tokens WHERE token = ? AND expira_en > NOW()"
            );
            $stmt->bind_param('s', $token);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            if ($row) {
                $_SESSION['usuario_id'] = $row['usuario_id'];
                $autenticado = true;
            }
        }
    }

    if (!$autenticado) {
        gateway_error(401, 'No autenticado. Inicia sesión o envía un token Bearer válido.');
    }
}

// ── Leer body JSON (para POST con datos en el cuerpo) ─────────────────────────
$bodyRaw = file_get_contents('php://input');
$body    = (!empty($bodyRaw)) ? (json_decode($bodyRaw, true) ?? []) : [];
$params  = array_merge($_GET, $_POST, $body);

// ── Cargar y ejecutar el controlador del servicio ────────────────────────────
$svc            = $SERVICE_REGISTRY[$service];
$controllerFile = SERVICES_PATH . '/' . $svc['file'];
$controllerClass = $svc['class'];

if (!file_exists($controllerFile)) {
    gateway_error(503, "Servicio '$service' registrado pero aún no implementado.");
}

require_once SERVICES_PATH . '/BaseController.php';
require_once $controllerFile;

if (!class_exists($controllerClass)) {
    gateway_error(500, "Error interno: clase '$controllerClass' no encontrada en el servicio.");
}

$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    gateway_error(404, "Acción '$action' no existe en el servicio '$service'.");
}

// ── Ejecutar y devolver respuesta ─────────────────────────────────────────────
try {
    $response = $controller->$action($params);
    http_response_code(200);
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (Throwable $e) {
    gateway_error(500, 'Error interno del servidor.', $e->getMessage());
}

// ── Helper: terminar con error ────────────────────────────────────────────────
function gateway_error(int $code, string $mensaje, string $detalle = ''): never {
    http_response_code($code);
    $body = ['success' => false, 'error' => $mensaje];
    if ($detalle) $body['detalle'] = $detalle;
    echo json_encode($body, JSON_UNESCAPED_UNICODE);
    exit;
}
