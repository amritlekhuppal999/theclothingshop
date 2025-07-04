# Use the official PHP 8.2 image with required extensions
FROM php:8.2-fpm-alpine

# Set working directory inside container
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN set -ex && apk add --no-cache \
    postgresql-dev \
    zip \
    bash \
    curl \
    git \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    zlib-dev \
    icu-dev \
    oniguruma-dev \
    autoconf \
    gcc \
    g++ \
    make \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        zip \
        intl \
        mbstring \
        exif \
        pcntl \
        bcmath

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Copy existing app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Set environment variables
# ENV APP_ENV=production \
#     APP_DEBUG=false

# Expose port (Render uses 80 by default)
EXPOSE 8000

# Start Laravel using PHP’s built-in server
CMD php artisan serve --host=0.0.0.0 --port=8000
