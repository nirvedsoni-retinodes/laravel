.PHONY: up down build install migrate seed link start-workers start-scheduler test clean setup

setup:
	@echo "🚀 Running complete setup..."
	@./setup.sh

up: setup
	@echo "🚀 Laravel Booking Platform is ready!"
	@echo "🌐 App: http://localhost:8080"
	@echo "🗄️  phpMyAdmin: http://localhost:8081"
	@echo "📧 Mailpit: http://localhost:8025"

down:
	docker-compose down

build:
	@echo "🔨 Building containers..."
	docker-compose build

install:
	@echo "📦 Installing dependencies..."
	docker-compose exec app composer install --no-interaction --optimize-autoloader

migrate:
	@echo "🗃️  Running migrations..."
	docker-compose exec app php artisan migrate --force

seed:
	@echo "🌱 Seeding database..."
	docker-compose exec app php artisan db:seed --force

link:
	@echo "🔗 Creating storage link..."
	docker-compose exec app php artisan storage:link

start-workers:
	@echo "👷 Starting queue workers..."
	docker-compose exec -d app php artisan queue:work --sleep=3 --tries=3 --max-time=3600

start-scheduler:
	@echo "⏰ Starting scheduler..."
	docker-compose exec -d app php artisan schedule:work

test:
	@echo "🧪 Running tests..."
	docker-compose exec app php artisan test

clean:
	@echo "🧹 Cleaning up..."
	docker-compose down -v
	docker system prune -f