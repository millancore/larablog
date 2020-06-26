FROM php:7.3-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS

RUN docker-php-ext-install pdo_mysql
RUN pecl install redis && docker-php-ext-enable redis

