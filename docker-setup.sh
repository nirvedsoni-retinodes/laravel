#!/bin/bash

echo "🐳 Setting up Laravel Booking Platform with Docker..."

# Check if .env exists, if not copy from example
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
fi

# Stop any existing containers
echo "🛑 Stopping existing containers..."
docker-compose down

# Remove any existing volumes to start fresh
echo "🧹 Cleaning up existing volumes..."
docker-compose down -v

# Build and start containers
echo "🔨 Building and starting Docker containers..."
docker-compose up --build -d

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 45

# Check if containers are running
echo "🔍 Checking container status..."
docker-compose ps

# Install Composer dependencies in container (if not already installed)
echo "📦 Installing Composer dependencies in container..."
docker-compose exec app composer install --no-interaction --optimize-autoloader

# Generate application key
echo "🔑 Generating application key..."
docker-compose exec app php artisan key:generate

# Set proper permissions
echo "🔐 Setting proper permissions..."
docker-compose exec app chmod -R 775 storage bootstrap/cache

# Create storage link
echo "🔗 Creating storage link..."
docker-compose exec app php artisan storage:link

# Run migrations and seeders
echo "🗄️ Running database migrations and seeders..."
docker-compose exec app php artisan migrate:fresh --seed --force

echo "✅ Docker setup complete!"
echo ""
echo "🌐 Access your application:"
echo "   Main App: http://localhost:8080"
echo "   Installation Wizard: http://localhost:8080/install"
echo "   phpMyAdmin: http://localhost:8081"
echo "   Mailpit: http://localhost:8025"
echo ""
echo "📋 Demo Credentials:"
echo "   Admin: admin@example.com / password"
echo "   Manager: manager@example.com / password"
echo "   Player: player@example.com / password"
echo ""
echo "🎯 Your Laravel Booking Platform is ready!"
