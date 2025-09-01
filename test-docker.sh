#!/bin/bash

echo "🧪 Testing Docker Setup..."

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker Desktop."
    exit 1
fi

echo "✅ Docker is running"

# Check if docker-compose is available
if ! command -v docker-compose &> /dev/null; then
    echo "❌ docker-compose not found. Please install Docker Compose."
    exit 1
fi

echo "✅ docker-compose is available"

# Check if .env exists
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
fi

echo "✅ .env file exists"

# Build containers
echo "🔨 Building containers..."
docker-compose up --build -d

# Wait for services
echo "⏳ Waiting for services to be ready..."
sleep 45

# Check container status
echo "�� Checking container status..."
docker-compose ps

# Test Laravel
echo "🧪 Testing Laravel installation..."
docker-compose exec app php artisan --version

# Test Composer
echo "🧪 Testing Composer..."
docker-compose exec app composer --version

# Test database connection
echo "🧪 Testing database connection..."
docker-compose exec app php artisan tinker --execute="echo 'Database: ' . (DB::connection()->getPdo() ? 'Connected' : 'Failed');"

echo "✅ Docker setup test complete!"
echo ""
echo "🌐 Access URLs:"
echo "   Main App: http://localhost:8080"
echo "   Installation Wizard: http://localhost:8080/install"
echo "   phpMyAdmin: http://localhost:8081"
echo "   Mailpit: http://localhost:8025"
