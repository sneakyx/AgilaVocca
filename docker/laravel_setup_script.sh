#!/bin/bash

# Navigate to the Laravel application directory
cd /var/www/html

# Install Composer dependencies
composer install

# Run database migrations
php artisan migrate

# Seed the database
php artisan db:seed

# install javascript/typescript stuff
npm install
# compile js and other stuff
npm run build

# create application key
php artisan key:generate
