#!/bin/bash

echo "🔧 Fixing Docker Connection Issues..."
echo "====================================="

# Stop all containers
echo "🛑 Stopping all containers..."
docker-compose down

# Remove containers and volumes
echo "🧹 Cleaning up containers and volumes..."
docker-compose down -v
docker system prune -f

# Remove any existing images
echo "🗑️ Removing existing images..."
docker rmi $(docker images -q laravel-booking-platform* 2>/dev/null) 2>/dev/null || true

# Build containers from scratch
echo "🔨 Building containers from scratch..."
docker-compose build --no-cache

# Start containers
echo "🚀 Starting containers..."
docker-compose up -d

# Wait for services to be ready
echo "⏳ Waiting for services to be ready..."
sleep 60

# Check container status
echo "🔍 Checking container status..."
docker-compose ps

# Check if app container is running
echo "🔍 Checking app container logs..."
docker-compose logs app

# Check if PHP-FPM is running in the app container
echo "🔍 Checking PHP-FPM status..."
docker-compose exec app ps aux | grep php-fpm || echo "PHP-FPM not running"

# Install dependencies if needed
echo "📦 Installing Composer dependencies..."
docker-compose exec app composer install --no-interaction --optimize-autoloader

# Generate application key
echo "🔑 Generating application key..."
docker-compose exec app php artisan key:generate --force

# Set permissions
echo "🔐 Setting permissions..."
docker-compose exec app chmod -R 775 storage bootstrap/cache

# Create storage link
echo "🔗 Creating storage link..."
docker-compose exec app php artisan storage:link

# Test database connection
echo "🗄️ Testing database connection..."
docker-compose exec app php artisan tinker --execute="echo 'Database: ' . (DB::connection()->getPdo() ? 'Connected' : 'Failed');"

# Run migrations
echo "🗄️ Running migrations..."
docker-compose exec app php artisan migrate:fresh --seed --force

echo ""
echo "✅ Docker connection fix complete!"
echo ""
echo "🌐 Access URLs:"
echo "   Main App: http://localhost:8080"
echo "   Installation Wizard: http://localhost:8080/install"
echo "   phpMyAdmin: http://localhost:8081"
echo "   Mailpit: http://localhost:8025"
echo ""
echo "🔍 If you still have issues, check:"
echo "   docker-compose logs app"
echo "   docker-compose logs nginx"
echo "   docker-compose ps"
