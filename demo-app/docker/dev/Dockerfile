FROM php:7.3.7-fpm

# Install php extensions
RUN docker-php-ext-install pdo pdo_mysql

# Set default workdir to /app
WORKDIR /app

# Copy application source
COPY . /app
