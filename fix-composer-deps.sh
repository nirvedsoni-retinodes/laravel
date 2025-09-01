#!/bin/bash

echo "🔧 Fixing Composer Dependencies in Running Container..."
echo "====================================================="

# Check if containers are running
echo "🔍 Checking container status..."
docker-compose ps

# Check if app container is running
if ! docker-compose ps | grep -q "laravel_app.*Up"; then
    echo "❌ Laravel app container is not running!"
    echo "Starting containers..."
    docker-compose up -d
    sleep 30
fi

# Check if vendor directory exists
echo "🔍 Checking if Composer dependencies are installed..."
if docker-compose exec app test -d vendor; then
    echo "✅ Vendor directory exists"
else
    echo "❌ Vendor directory missing - installing dependencies..."
fi

# Install Composer dependencies
echo "📦 Installing Composer dependencies..."
docker-compose exec app composer install --no-interaction --optimize-autoloader

# Check if .env exists
echo "🔍 Checking .env file..."
if docker-compose exec app test -f .env; then
    echo "✅ .env file exists"
else
    echo "❌ .env file missing - creating from example..."
    docker-compose exec app cp .env.example .env
fi

# Generate application key
echo "🔑 Generating application key..."
docker-compose exec app php artisan key:generate --force

# Create storage directories
echo "📁 Creating storage directories..."
docker-compose exec app mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

# Set permissions
echo "🔐 Setting permissions..."
docker-compose exec app chmod -R 775 storage bootstrap/cache

# Create storage link
echo "�� Creating storage link..."
docker-compose exec app php artisan storage:link

# Clear cache
echo "🧹 Clearing cache..."
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear

# Run migrations
echo "🗄️ Running migrations..."
docker-compose exec app php artisan migrate:fresh --seed --force

# Test Laravel
echo "🧪 Testing Laravel installation..."
docker-compose exec app php artisan --version

echo ""
echo "✅ Composer dependencies fix complete!"
echo ""
echo "🌐 Access URLs:"
echo "   Main App: http://localhost:8080"
echo "   Installation Wizard: http://localhost:8080/install"
echo "   phpMyAdmin: http://localhost:8081"
echo "   Mailpit: http://localhost:8025"
echo ""
echo "🎯 Your Laravel Booking Platform should now work perfectly!"
