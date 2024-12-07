# Use the official PHP image with CLI
FROM php:8.2-cli

# Install required extensions and tools
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Copy Composer into the image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/whatcompstack-BE

# Copy application files
COPY . /var/www/whatcompstack-BE

# Add Git safe directory to avoid "dubious ownership" errors
RUN git config --global --add safe.directory /var/www/whatcompstack-BE

# Create .env file if it doesn't exist
RUN cp .env.example .env || true

# Run Composer to install dependencies
RUN composer install

# Run npm to install frontend dependencies
RUN npm install

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/whatcompstack-BE \
    && chmod -R 775 /var/www/whatcompstack-BE/storage \
    && chmod -R 775 /var/www/whatcompstack-BE/bootstrap/cache

# Run Laravel commands
RUN php artisan key:generate

# Expose Laravel's default port
EXPOSE 8000

# Command to start Laravel's built-in development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
