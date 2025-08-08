# PHP 8.3 CLI is enough for artisan serve
FROM php:8.3-cli

# System deps + SQLite
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev libjpeg-dev libfreetype6-dev libicu-dev \
    sqlite3 libsqlite3-dev \
 && docker-php-ext-install intl pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip \
 && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Install PHP deps (keep dev deps so l5-swagger can generate)
RUN composer install --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www \
 && chmod -R 775 storage bootstrap/cache

# Entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8000
CMD ["/entrypoint.sh"]
