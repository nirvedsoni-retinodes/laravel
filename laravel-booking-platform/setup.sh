#!/bin/bash

echo "�� Setting up Laravel Booking Platform..."

# Build and start containers
echo "🔨 Building and starting containers..."
docker-compose up -d --build

# Wait for containers to be ready
echo "⏳ Waiting for containers to be ready..."
sleep 30

# Install Composer dependencies
echo "📦 Installing Composer dependencies..."
docker-compose exec -T app composer install --no-interaction --optimize-autoloader

# Generate application key
echo "🔑 Generating application key..."
docker-compose exec -T app php artisan key:generate

# Run migrations
echo "🗃️  Running database migrations..."
docker-compose exec -T app php artisan migrate --force

# Seed database
echo "🌱 Seeding database..."
docker-compose exec -T app php artisan db:seed --force

# Create storage link
echo "🔗 Creating storage link..."
docker-compose exec -T app php artisan storage:link

# Start queue workers
echo "👷 Starting queue workers..."
docker-compose exec -d app php artisan queue:work --sleep=3 --tries=3 --max-time=3600

# Start scheduler
echo "⏰ Starting scheduler..."
docker-compose exec -d app php artisan schedule:work

echo "✅ Setup complete!"
echo "🌐 App: http://localhost:8080"
echo "🗄️  phpMyAdmin: http://localhost:8081"
echo "📧 Mailpit: http://localhost:8025"
echo ""
echo "Demo credentials:"
echo "Admin: admin@example.com / password"
echo "Manager: manager@example.com / password"
echo "Player: player@example.com / password"
