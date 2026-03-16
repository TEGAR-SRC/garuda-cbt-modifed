FROM php:8.1-apache

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo_mysql zip intl mbstring xml bcmath calendar

# Fix PHP Environment Variables visibility
RUN echo 'variables_order = "EGPCS"' >> /usr/local/etc/php/conf.d/docker-vars.ini

# Enable Apache modules
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/application/config \
    && chmod -R 777 /var/www/html/application/logs \
    && chmod -R 777 /var/www/html/uploads \
    && chmod -R 777 /var/www/html/backups

# Copy custom database config (Optional, if we want to bypass installer)
# We can use a script to replace placeholders in application/config/database.php

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]

