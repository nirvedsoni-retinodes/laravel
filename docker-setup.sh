#!/bin/bash

echo "🐳 Setting up Laravel Booking Platform with Docker..."

# Check if .env exists, if not copy from example
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
fi

# Build and start containers
echo "🔨 Building and starting Docker containers..."
docker-compose up --build -d

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 30

# Install Composer dependencies in container
echo "�� Installing Composer dependencies in container..."
docker-compose exec app composer install --no-interaction --optimize-autoloader

# Generate application key
echo "🔑 Generating application key..."
docker-compose exec app php artisan key:generate

# Set proper permissions
echo "🔐 Setting proper permissions..."
docker-compose exec app chmod -R 775 storage bootstrap/cache

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
