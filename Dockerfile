FROM php:7.4-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y git curl libzip-dev

# Install PHP dependencies
RUN docker-php-ext-install pdo pdo_mysql zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

CMD ["php-fpm"]