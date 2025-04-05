FROM php:8.4.5-fpm
WORKDIR /var/www
RUN apt update && apt install -y git curl zip unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql