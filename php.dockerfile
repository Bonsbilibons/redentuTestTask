FROM php:8.2-fpm-alpine

ADD php/www.conf /usr/local/etc/php-fpm.d/www.conf

COPY php/laravel.ini /usr/local/etc/php/conf.d/laravel.ini

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN mkdir -p /var/www/html

ADD src /var/www/html

RUN apk update && apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

RUN chown -R laravel:laravel /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
