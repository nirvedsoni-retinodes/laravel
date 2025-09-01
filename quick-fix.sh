#!/bin/bash

echo "🔧 Quick Fix for Running Containers..."
echo "====================================="

# Check if containers are running
echo "🔍 Checking container status..."
docker-compose ps

# Create directories in the running container
echo "📁 Creating storage directories..."
docker-compose exec app mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

# Set permissions
echo "🔐 Setting permissions..."
docker-compose exec app chmod -R 775 storage bootstrap/cache

# Install dependencies if needed
echo "📦 Installing Composer dependencies..."
docker-compose exec app composer install --no-interaction --optimize-autoloader

# Generate application key if needed
echo "🔑 Generating application key..."
docker-compose exec app php artisan key:generate --force

# Create storage link
echo "🔗 Creating storage link..."
docker-compose exec app php artisan storage:link

# Run migrations
echo "🗄️ Running migrations..."
docker-compose exec app php artisan migrate:fresh --seed --force

echo ""
echo "✅ Quick fix complete!"
echo ""
echo "🌐 Access URLs:"
echo "   Main App: http://localhost:8080"
echo "   Installation Wizard: http://localhost:8080/install"
echo "   phpMyAdmin: http://localhost:8081"
echo "   Mailpit: http://localhost:8025"
echo ""
echo "🎯 Your Laravel Booking Platform should now work perfectly!"
