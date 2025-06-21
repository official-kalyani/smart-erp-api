#!/usr/bin/env bash

# ✅ Copy SQLite DB to writable directory
cp database/database.sqlite /tmp/database.sqlite

# ✅ Set correct environment variable for Laravel
export DB_CONNECTION=sqlite
export DB_DATABASE=/tmp/database.sqlite

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "Clearing old caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force
