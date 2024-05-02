#!/bin/bash

# Navigate to the Laravel application directory
cd /path/to/laravel/application

# Install Composer dependencies
composer install

# Run database migrations
php artisan migrate

# Seed the database
php artisan db:seed

# Start the Laravel application
php artisan serve