FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk --no-cache add \
    zlib-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Remove default www-data user (UID 82) and create a new one with UID 33
RUN deluser www-data && addgroup -g 33 www-data && adduser -D -u 33 -G www-data www-data

COPY package.json package-lock.json /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install Composer (Laravel's dependency manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and NPM
RUN npm install && npm run build

# Copy your Laravel project into the container
COPY . /var/www/html

EXPOSE 9003

CMD ["php-fpm"]
