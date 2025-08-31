#!/bin/bash

echo "�� Starting Laravel Booking Platform..."

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker first."
    exit 1
fi

# Check if make is available
if command -v make &> /dev/null; then
    echo "✅ Using Makefile..."
    make up
else
    echo "✅ Using setup script directly..."
    ./setup.sh
fi

echo ""
echo "🎉 Application started successfully!"
echo "🌐 App: http://localhost:8080"
echo "🗄️  phpMyAdmin: http://localhost:8081"
echo "📧 Mailpit: http://localhost:8025"
