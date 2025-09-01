#!/bin/bash

echo "🚀 Immediate Fix for 'Class not found' Error..."
echo "=============================================="

# Install Composer dependencies immediately
echo "📦 Installing Composer dependencies..."
docker-compose exec app composer install --no-interaction --optimize-autoloader

# Generate application key
echo "🔑 Generating application key..."
docker-compose exec app php artisan key:generate --force

# Clear all caches
echo "🧹 Clearing caches..."
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear

echo "✅ Immediate fix complete!"
echo "🌐 Try accessing: http://localhost:8080"
