# Use official PHP with Apache
FROM php:8.2-apache

# Install required PHP extensions for Laravel + GD dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql zip

# Enable Apache mod_rewrite (needed for Laravel routes)
RUN a2enmod rewrite

# Set Apache DocumentRoot to /var/www/html/public (Laravel entry point)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Copy app code
COPY . /var/www/html/

# Create upload folders for image storage
RUN mkdir -p /var/www/html/public/storage/uploads/users \
    && mkdir -p /var/www/html/public/storage/uploads/residents \
    && mkdir -p /var/www/html/public/storage/uploads/applicants \
    && mkdir -p /var/www/html/public/storage/uploads/blotters \
    && mkdir -p /var/www/html/public/storage/uploads/proofs \
    && chown -R www-data:www-data /var/www/html/public/storage \
    && chmod -R 775 /var/www/html/public/storage

# Set working dir
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader
RUN php artisan storage:link

# CLEAR ALL LARAVEL CACHES
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Install Node + npm
RUN apt-get update && apt-get install -y nodejs npm

# Build frontend assets
RUN npm install && npm run build

# Fix Laravel storage permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Expose Render's required port
EXPOSE 10000

# Start Apache
CMD ["apache2-foreground"]
