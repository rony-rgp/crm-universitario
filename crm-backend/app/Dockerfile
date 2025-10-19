# 🧩 Laravel backend (DEV)
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath && \
    rm -rf /var/lib/apt/lists/*

# Copiar composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

# Ahora copiamos todo el resto del proyecto antes de instalar dependencias
COPY . .

# Instalar las dependencias
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generación del archivo .env y permisos
RUN php -r "file_exists('.env') || copy('.env.example', '.env');" \
  && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
  && chown -R www-data:www-data storage bootstrap/cache \
  && chmod -R 775 storage bootstrap/cache \
  && (php artisan key:generate || true)

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

