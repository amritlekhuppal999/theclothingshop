# Use official PHP 8.2 
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath xml

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY /public /var/www/html

# Copy existing application directory permissions fix
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies (composer install) without dev packages and optimize autoloader
RUN composer install --no-dev --optimize-autoloader

# command to run the laravel server
CMD php artisan serve --host=0.0.0.0 --port=80

# Expose port 80
EXPOSE 80


