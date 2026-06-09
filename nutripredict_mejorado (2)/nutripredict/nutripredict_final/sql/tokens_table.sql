-- ─────────────────────────────────────────────────────────────────────────────
-- sql/tokens_table.sql
-- Tabla requerida por el microservicio Auth para la gestión de tokens de sesión.
-- Se ejecuta automáticamente al iniciar el contenedor Docker.
-- ─────────────────────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS api_tokens (
    id         INT          PRIMARY KEY AUTO_INCREMENT,
    token      VARCHAR(128) NOT NULL UNIQUE COMMENT 'Token hex de 64 chars (bin2hex 32 bytes)',
    usuario_id INT          NOT NULL,
    creado_en  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    expira_en  TIMESTAMP    NOT NULL,
    INDEX idx_token      (token),
    INDEX idx_usuario_id (usuario_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tokens de sesión para el API Gateway';

-- Nota: la FK a usuarios se agrega solo si la tabla usuarios ya existe.
-- Si el schema principal ya fue cargado, puedes agregar:
-- ALTER TABLE api_tokens ADD CONSTRAINT fk_token_usuario
--     FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE;
