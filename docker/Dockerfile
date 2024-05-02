FROM php:8.1

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the init script into the container
COPY laravel_setup_script.sh /start-script.sh

# Set correct permissions on the init script
RUN chmod +x /start-script.sh

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY .. /var/www

RUN composer install

RUN php artisan migrate

RUN php artisan db:seed

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]

EXPOSE 8080
