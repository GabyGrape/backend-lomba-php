FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libsqlite3-dev libpng-dev libonig-dev libxml2-dev zip unzip nginx

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY . /var/www

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Setup Nginx and Permissions
# RUN chown -R www-data:www-data /var/www/storage /var/www/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
# (Pastikan kamu punya file nginx.conf sederhana atau gunakan command untuk menjalankan php artisan serve)

# Pastikan entrypoint bisa dijalankan
RUN chmod +x entrypoint.sh

# CMD php artisan serve --host=0.0.0.0 --port=$PORT
CMD ["sh", "entrypoint.sh"]