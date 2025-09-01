#!/bin/bash

echo "�� Setting up Laravel Booking Platform..."

# Check if .env exists, if not copy from example
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
fi

# Install Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-interaction --optimize-autoloader

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate

# Set proper permissions
echo "🔐 Setting proper permissions..."
chmod -R 775 storage bootstrap/cache

echo "✅ Setup complete!"
echo "🌐 Access the installation wizard at: http://localhost/laravel-booking-platform/install"
echo ""
echo "📋 Next steps:"
echo "1. Make sure XAMPP is running (Apache + MySQL)"
echo "2. Open: http://localhost/laravel-booking-platform/install"
echo "3. Follow the installation wizard"
echo "4. Enjoy your booking platform!"
