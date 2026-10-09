# -------------------------------------------------------------
# Stage 1: Build Frontend Assets (Vite, Tailwind, JS/CSS)
# -------------------------------------------------------------
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY vite.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build

# -------------------------------------------------------------
# Stage 2: Composer Dependencies (Production only)
# -------------------------------------------------------------
FROM composer:2 AS composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts \
    --ignore-platform-reqs

# -------------------------------------------------------------
# Stage 3: Production PHP-FPM Application
# -------------------------------------------------------------
FROM php:8.5-fpm-alpine

LABEL maintainer="SMP Islam Al-Madinah BSD"

WORKDIR /var/www/html

# Install required system packages and PHP extensions
RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    linux-headers \
    mysql-client \
    shadow \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mysqli \
        gd \
        zip \
        intl \
        bcmath \
        opcache \
        pcntl \
        exif \
    && rm -rf /var/cache/apk/*

# Copy PHP configurations
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom-php.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Copy application source code
COPY . /var/www/html

# Copy vendor dependencies from Composer stage
COPY --from=composer /app/vendor /var/www/html/vendor

# Copy compiled frontend assets from Frontend stage
COPY --from=frontend /app/public/build /var/www/html/public/build

# Copy composer binary
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Setup entrypoint and directory permissions
COPY docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh \
    && composer dump-autoload --optimize --no-dev --no-scripts --ignore-platform-reqs \
    && mkdir -p /var/www/html/storage/app/public \
                /var/www/html/storage/framework/cache \
                /var/www/html/storage/framework/sessions \
                /var/www/html/storage/framework/views \
                /var/www/html/storage/logs \
                /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["php-fpm"]
