FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    curl \
    git \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install mongodb && docker-php-ext-enable mongodb

WORKDIR /var/www/covid

COPY . /var/www/covid

RUN composer install

