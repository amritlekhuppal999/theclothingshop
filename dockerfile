###################################################################

FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# 1. Install system-level dependencies (before PHP builds)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install zip

# 2. Install required PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    bcmath \
    mbstring \
    xml

# removed `tokenizer` package/extension 

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Copy Laravel files
COPY . .

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader



# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Run migrations or queue workers here if needed in entrypoint


# Expose port (Render uses 80 by default)
EXPOSE 8000

# Start Laravel using PHP’s built-in server
CMD php artisan serve --host=0.0.0.0 --port=8000