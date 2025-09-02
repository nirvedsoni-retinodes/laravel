@echo off
echo ========================================
echo Laravel Booking Platform - XAMPP Setup
echo Windows 11 Compatible
echo ========================================
echo.

REM Check if we're in the right directory
if not exist "composer.json" (
    echo ❌ Error: composer.json not found!
    echo Please run this script from the Laravel project root directory.
    pause
    exit /b 1
)

echo ✅ Found Laravel project files
echo.

REM Check if PHP is available
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP is not installed or not in PATH
    echo Please install XAMPP and add PHP to your PATH
    echo Or run this from XAMPP command prompt
    pause
    exit /b 1
)

echo ✅ PHP is available
php --version

REM Check if Composer is available
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Composer is not installed or not in PATH
    echo Please install Composer from https://getcomposer.org/
    pause
    exit /b 1
)

echo ✅ Composer is available
composer --version

echo.
echo 🚀 Starting Laravel Booking Platform Setup...
echo.

REM Install Composer dependencies
echo 📦 Installing Composer dependencies...
composer install --no-interaction --optimize-autoloader
if %errorlevel% neq 0 (
    echo ❌ Failed to install Composer dependencies
    pause
    exit /b 1
)

REM Copy .env file if it doesn't exist
if not exist .env (
    if exist .env.example (
        echo 📝 Creating .env file...
        copy .env.example .env
    ) else (
        echo ❌ .env.example file not found
        pause
        exit /b 1
    )
)

REM Generate application key
echo 🔑 Generating application key...
php artisan key:generate --force
if %errorlevel% neq 0 (
    echo ❌ Failed to generate application key
    pause
    exit /b 1
)

REM Create storage directories
echo 📁 Creating storage directories...
if not exist storage mkdir storage
if not exist storage\app mkdir storage\app
if not exist storage\app\public mkdir storage\app\public
if not exist storage\framework mkdir storage\framework
if not exist storage\framework\cache mkdir storage\framework\cache
if not exist storage\framework\sessions mkdir storage\framework\sessions
if not exist storage\framework\views mkdir storage\framework\views
if not exist storage\logs mkdir storage\logs
if not exist bootstrap\cache mkdir bootstrap\cache

REM Create storage link
echo �� Creating storage link...
php artisan storage:link
if %errorlevel% neq 0 (
    echo ⚠️ Warning: Could not create storage link
)

REM Clear caches
echo 🧹 Clearing caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo ✅ XAMPP setup completed successfully!
echo.
echo 🌐 Access your application:
echo    Main App: http://localhost/cognic/laravel
echo    Installation Wizard: http://localhost/cognic/laravel/install
echo    Install File: http://localhost/cognic/laravel/install.php
echo    Test Installation: http://localhost/cognic/laravel/test-installation.php
echo.
echo 📋 Demo Credentials:
echo    Admin: admin@example.com / password
echo    Manager: manager@example.com / password
echo    Player: player@example.com / password
echo.
echo 🎯 Next Steps:
echo 1. Make sure XAMPP Apache and MySQL are running
echo 2. Access http://localhost/cognic/laravel/test-installation.php
echo 3. Follow the installation wizard
echo 4. Configure your database settings
echo.
echo 🎉 Your Laravel Booking Platform is ready!
pause
