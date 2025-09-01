FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    procps

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy all application files
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Create necessary directories if they don't exist
RUN mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

# Create a startup script
RUN echo '#!/bin/bash\n\
echo "Starting Laravel application..."\n\
\n\
# Wait for database to be ready\n\
echo "Waiting for database..."\n\
while ! nc -z db 3306; do\n\
  sleep 1\n\
done\n\
echo "Database is ready!"\n\
\n\
# Install Composer dependencies if vendor doesn\'t exist\n\
if [ ! -d "vendor" ]; then\n\
  echo "Installing Composer dependencies..."\n\
  composer install --no-interaction --optimize-autoloader\n\
fi\n\
\n\
# Generate application key if not exists\n\
if [ -z "$(grep APP_KEY .env | cut -d = -f2)" ] || [ "$(grep APP_KEY .env | cut -d = -f2)" = "" ]; then\n\
  echo "Generating application key..."\n\
  php artisan key:generate --force\n\
fi\n\
\n\
# Set proper permissions\n\
chmod -R 775 storage bootstrap/cache\n\
\n\
# Start PHP-FPM\n\
echo "Starting PHP-FPM..."\n\
exec php-fpm' > /usr/local/bin/start.sh

RUN chmod +x /usr/local/bin/start.sh

# Install netcat for database connectivity check
RUN apt-get update && apt-get install -y netcat-openbsd && apt-get clean

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["/usr/local/bin/start.sh"]
