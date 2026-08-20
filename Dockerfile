ARG PHP_VERSION=8.2

FROM php:${PHP_VERSION}-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite \
    && sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}/!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && printf '%s\n' \
        '#!/bin/sh' \
        'set -e' \
        ': "${PORT:=10000}"' \
        'sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf' \
        'sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf' \
        'exec apache2-foreground' \
        > /usr/local/bin/render-start \
    && chmod +x /usr/local/bin/render-start

EXPOSE 10000

CMD ["render-start"]
