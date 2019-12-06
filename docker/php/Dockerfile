FROM php:7.2-fpm

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

USER 1000:1000
