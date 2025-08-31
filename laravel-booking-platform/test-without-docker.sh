#!/bin/bash

echo "🧪 Testing Laravel Booking Platform Code Structure..."

echo ""
echo "📁 Checking project structure..."
if [ -d "app" ] && [ -d "config" ] && [ -d "database" ] && [ -d "resources" ] && [ -d "routes" ]; then
    echo "✅ Project structure is correct"
else
    echo "❌ Project structure is incomplete"
    exit 1
fi

echo ""
echo "📦 Checking required files..."
required_files=(
    "composer.json"
    "artisan"
    "bootstrap/app.php"
    "public/index.php"
    "docker-compose.yml"
    "Dockerfile"
    "Makefile"
    "setup.sh"
    ".env.example"
    "README.md"
)

for file in "${required_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "🔧 Checking configuration files..."
config_files=(
    "config/app.php"
    "config/database.php"
    "config/auth.php"
    "config/cache.php"
    "config/queue.php"
    "config/session.php"
    "config/services.php"
    "config/permission.php"
)

for file in "${config_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "📊 Checking database migrations..."
migration_count=$(find database/migrations -name "*.php" | wc -l)
if [ "$migration_count" -ge 6 ]; then
    echo "✅ Found $migration_count migration files"
else
    echo "❌ Insufficient migration files (found $migration_count, need at least 6)"
    exit 1
fi

echo ""
echo "🌱 Checking database seeders..."
seeder_files=(
    "database/seeders/DatabaseSeeder.php"
    "database/seeders/RoleSeeder.php"
    "database/seeders/UserSeeder.php"
    "database/seeders/VenueSeeder.php"
    "database/seeders/FacilitySeeder.php"
    "database/seeders/ScheduleSeeder.php"
    "database/seeders/BookingSeeder.php"
)

for file in "${seeder_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "🎭 Checking models..."
model_files=(
    "app/Models/User.php"
    "app/Models/Venue.php"
    "app/Models/Facility.php"
    "app/Models/Schedule.php"
    "app/Models/Booking.php"
)

for file in "${model_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "🎮 Checking controllers..."
controller_files=(
    "app/Http/Controllers/Controller.php"
    "app/Http/Controllers/BookingController.php"
    "app/Http/Controllers/AdminController.php"
    "app/Http/Controllers/VenueController.php"
    "app/Http/Controllers/FacilityController.php"
    "app/Http/Controllers/ProfileController.php"
    "app/Http/Controllers/Auth/AuthenticatedSessionController.php"
    "app/Http/Controllers/Auth/RegisteredUserController.php"
)

for file in "${controller_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "🔧 Checking services..."
service_files=(
    "app/Services/BookingService.php"
    "app/Services/RazorpayService.php"
    "app/Services/WhatsAppService.php"
)

for file in "${service_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "🌐 Checking routes..."
route_files=(
    "routes/web.php"
    "routes/api.php"
    "routes/auth.php"
    "routes/console.php"
)

for file in "${route_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "🎨 Checking views..."
view_dirs=(
    "resources/views/layouts"
    "resources/views/auth"
    "resources/views/components"
)

for dir in "${view_dirs[@]}"; do
    if [ -d "$dir" ]; then
        echo "✅ $dir exists"
    else
        echo "❌ $dir missing"
        exit 1
    fi
done

echo ""
echo "🧪 Checking tests..."
test_files=(
    "tests/TestCase.php"
    "tests/CreatesApplication.php"
    "tests/Feature/BookingTest.php"
    "Pest.php"
    "phpunit.xml"
)

for file in "${test_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "📚 Checking documentation..."
doc_files=(
    "README.md"
    "DEPLOYMENT_READY.md"
    "openapi.yaml"
    "postman_collection.json"
)

for file in "${doc_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
        exit 1
    fi
done

echo ""
echo "🎉 All tests passed! The Laravel Booking Platform is properly structured."
echo ""
echo "🚀 To run the application:"
echo "   1. Install Docker and Docker Compose"
echo "   2. Run: ./start.sh"
echo "   3. Or run: make up"
echo ""
echo "📖 For detailed setup instructions, see README.md"
