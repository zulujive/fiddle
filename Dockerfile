FROM php:8.2-fpm-alpine

# For easy install of php extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd

USER 1001

WORKDIR /var/www/html

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


# Copy project files
COPY --chown=1001:0 public ./public
COPY --chown=1001:0 src ./src
COPY --chown=1001:0 dev.php .
RUN mkdir "./templates"

COPY --chown=1001:0 .env.example .env

COPY --chown=1001:0 composer.json .
COPY --chown=1001:0 composer.lock .


# Install composer packages
RUN composer install --no-dev --optimize-autoloader


EXPOSE 9000