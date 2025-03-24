# Stage 1: Build assets
FROM node:20.14.0 AS build

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package.json package-lock.json ./

# Stage 2: PHP-FPM runtime
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    curl \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install npm dependencies
RUN npm install && npm run build

# Copy built assets from the build stage
COPY --from=build /app/public/build /var/www/html/public/build

# Set permissions for Laravel storage and bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9003 for PHP-FPM
EXPOSE 9003

# Start PHP-FPM
CMD ["php-fpm"]
