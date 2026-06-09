# NutriPredict — Capa de Microservicios

Documentación de la arquitectura de microservicios implementada sobre NutriPredict.

---

## ¿Qué se agregó?

La carpeta `api/` es la nueva capa de microservicios. El resto del proyecto
(vistas, presenters, models) continúa funcionando igual.

```
ANTES (monolito):          DESPUÉS (microservicios):
──────────────────         ────────────────────────────────────
estudiantes.php   ─────→   api/gateway.php
  └─ EstudiantePresenter       └─ api/services/estudiantes/
  └─ EstudianteModel               ├─ EstudianteController.php  (Endpoint)
  └─ views/                        ├─ EstudianteValidator.php   (Validación)
                                   └─ EstudianteService.php     (Lógica + Datos)
```

---

## Estructura de la capa API

```
api/
├── gateway.php                     ← Punto único de entrada (API Gateway)
└── services/
    ├── BaseController.php          ← Clase base compartida
    ├── auth/                       ← Microservicio: Autenticación (COMPLETO)
    │   ├── AuthController.php
    │   ├── AuthValidator.php
    │   └── AuthService.php
    ├── estudiantes/                ← Microservicio: Estudiantes (COMPLETO)
    │   ├── EstudianteController.php
    │   ├── EstudianteValidator.php
    │   └── EstudianteService.php
    ├── menus/                      ← Microservicio: Menús (estructura lista)
    ├── alimentos/
    ├── asistencia/
    ├── alertas/
    ├── predictivo/
    ├── reportes/
    ├── usuarios/
    └── nutribot/                   ← Microservicio: NutriBot IA (adaptado)
```

---

## Cómo usar el API Gateway

**URL base:** `http://localhost:8080/api/gateway.php`

### Autenticación
```bash
# Login (ruta pública — no requiere token)
POST /api/gateway.php?service=auth&action=login
Body: { "email": "admin@nutripredict.com", "password": "admin123" }

# Respuesta:
{ "success": true, "data": { "usuario": {...}, "token": "abc123..." } }
```

### Estudiantes
```bash
# Listar todos
GET /api/gateway.php?service=estudiantes&action=listar
Header: Authorization: Bearer <token>

# Buscar por nombre
GET /api/gateway.php?service=estudiantes&action=listar&q=Juan

# Filtrar por nivel de riesgo
GET /api/gateway.php?service=estudiantes&action=listar&riesgo=alto

# Obtener uno
GET /api/gateway.php?service=estudiantes&action=obtener&id=5

# Crear
POST /api/gateway.php?service=estudiantes&action=crear
Body: { "nombre": "Juan", "apellido": "Pérez", "fecha_nac": "2012-05-15",
        "id_grado": 3, "genero": "M", "peso_kg": 35, "talla_cm": 140 }

# Editar
POST /api/gateway.php?service=estudiantes&action=editar&id=5
Body: { "nombre": "Juan", "apellido": "Pérez", ... }

# Eliminar
POST /api/gateway.php?service=estudiantes&action=eliminar&id=5

# Resumen para dashboard
GET /api/gateway.php?service=estudiantes&action=resumen
```

### NutriBot IA
```bash
POST /api/gateway.php?service=nutribot&action=chat
Body: { "mensaje": "¿Cuántos estudiantes en riesgo hay hoy?",
        "historial": [] }
```

---

## Estructura interna de cada microservicio

Cada microservicio tiene exactamente 3 capas (según el diagrama del profesor):

```
HTTP Request
    ↓
[Controller]   → Recibe la petición, verifica auth, llama al Validator
    ↓
[Validator]    → Verifica que los datos tengan formato correcto
    ↓
[Service]      → Business Logic + Data Access (usa los Models existentes)
    ↓
[MySQL DB]     → Base de datos (propia por servicio en producción)
```

---

## Levantar con Docker

```bash
# 1. Copiar variables de entorno
cp .env.example .env
# Editar .env y agregar ANTHROPIC_API_KEY

# 2. Levantar todos los servicios
docker-compose up -d

# 3. Verificar que esté corriendo
docker-compose ps

# Accesos:
# App:        http://localhost:8080
# phpMyAdmin: http://localhost:8081
```

---

## CI/CD (DevOps — GitHub Actions)

El archivo `.github/workflows/ci.yml` define el pipeline:

| Etapa | Cuándo | Qué hace |
|-------|--------|----------|
| **CI** | Todo push/PR | Verifica sintaxis PHP, carga BD de prueba, prueba conexión |
| **CD** | Push a `main` | Construye imagen Docker, la sube a Docker Hub |

Secrets requeridos en GitHub:
- `DOCKER_USERNAME` — usuario de Docker Hub
- `DOCKER_PASSWORD` — token de Docker Hub

---

## Requisitos de cada microservicio (según el profesor)

| Requisito | Implementado en |
|-----------|----------------|
| Cumplir una sola función | Cada servicio maneja solo su dominio |
| Ser autónomo | Cada servicio tiene su Controller/Validator/Service |
| Estar aislado | Conexión DB propia, sin dependencias cruzadas directas |
| API Gateway | `api/gateway.php` — único punto de entrada |
| Docker container | `docker-compose.yml` + `Dockerfile` |
| CI/CD (DevOps) | `.github/workflows/ci.yml` |
