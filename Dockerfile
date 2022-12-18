FROM php:7.4-fpm

WORKDIR /var/www/html

COPY . /var/www/html/

RUN apt-get update && apt-get install -y git curl libzip-dev

# Install PHP dependencies
RUN docker-php-ext-install pdo pdo_mysql zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install composer dependencies
RUN composer install

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
RUN chown -R www:www /var/www/html

# Grant read/write access to the bootstrap and storage folders
RUN chmod -R 777 /var/www/html/bootstrap /var/www/html/storage

EXPOSE 9000

CMD ["php-fpm"]