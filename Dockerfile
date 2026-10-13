FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip curl ca-certificates \
    libzip-dev libpng-dev libjpeg62-turbo-dev \
    libfreetype6-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
       pdo_mysql mbstring bcmath exif pcntl gd zip intl \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN git config --global --add safe.directory /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN npm install

EXPOSE 8002

CMD ["composer", "run", "dev"]
