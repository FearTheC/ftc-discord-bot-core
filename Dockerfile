FROM php:7.2-fpm-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir /app

WORKDIR /app

COPY ./composer.* /app/

RUN composer update

CMD ["php-fpm"]
