FROM php:7.3-alpine

RUN docker-php-ext-install pdo_mysql

COPY ./root /etc/crontabs/root

CMD ["/usr/sbin/crond", "-f"]