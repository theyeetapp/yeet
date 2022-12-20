FROM php:7.4-fpm

USER root

WORKDIR /var/www

RUN apt-get update && apt-get install -y git curl nginx libzip-dev

# Install PHP dependencies
RUN docker-php-ext-install pdo pdo_mysql zip

COPY . /var/www

COPY ./nginx.conf /etc/nginx/nginx.conf

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install composer dependencies
RUN composer install

# Grant read/write access to the bootstrap and storage folders
RUN chmod -R 777 /var/www/bootstrap /var/www/storage

RUN php artisan optimize

RUN php artisan route:clear

RUN php artisan route:cache

RUN php artisan config:clear

RUN php artisan config:cache

RUN php artisan view:clear

RUN php artisan view:cache

EXPOSE 80

RUN ["chmod", "+x", "/var/www/run.sh"]

CMD ["sh", "/var/www/run.sh"]