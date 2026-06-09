# ─────────────────────────────────────────────────────────────────────────────
# Dockerfile — NutriPredict Microservicios
# Base: PHP 8.2 con Apache. Incluye extensiones MySQL y curl.
# ─────────────────────────────────────────────────────────────────────────────

FROM php:8.2-apache

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar curl para llamadas a la API de Anthropic (NutriBot)
RUN apt-get update && apt-get install -y libcurl4-openssl-dev \
    && docker-php-ext-install curl \
    && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite para el API Gateway
RUN a2enmod rewrite

# Copiar configuración de Apache
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type f -name "*.php" -exec chmod 644 {} \;

EXPOSE 80

CMD ["apache2-foreground"]
