FROM php:8.0.0rc1-fpm

# Install system dependencies
RUN apt-get update

RUN apt-get install -y \
    libzip-dev \ 
    zip 

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip


# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www