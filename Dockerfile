FROM php:8.2-fpm-alpine

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy project files
COPY . /var/www/html

# Install composer packages
RUN composer install --no-dev --optimize-autoloader

WORKDIR /var/www/html

EXPOSE 9000