FROM php:7.4.13-apache

USER root

WORKDIR /var/www/html

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y \
        libpng-dev zlib1g-dev libxml2-dev libzip-dev libonig-dev libpq-dev\
        zip unzip git \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-install zip \
    && docker-php-source delete \
    && pecl install -f xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite