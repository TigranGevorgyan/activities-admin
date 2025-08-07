# Use PHP 8.3 instead of 8.2 (required by openspout)
FROM php:8.3-fpm

# Install system dependencies and required PHP extensions
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev libjpeg-dev libfreetype6-dev libicu-dev \
    && docker-php-ext-install intl pdo_mysql mbstring exif pcntl bcmath gd zip

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy Laravel app
COPY . .

# Install composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
