FROM php:8.0.0rc1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y git libzip-dev zlib1g-dev unzip nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

CMD php -S 0.0.0.0:8080 -t public