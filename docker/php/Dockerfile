FROM php:8.2-fpm-alpine

ARG USER_ID=1000
ARG GROUP_ID=$USER_ID

RUN apk add --no-cache \
    curl \
    git \
    bash \
    autoconf \
    shadow \
    build-base \
    linux-headers \
    && docker-php-ext-install pdo_mysql \
    && usermod -u ${USER_ID} www-data \
    && groupmod -g ${GROUP_ID} www-data \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER www-data

WORKDIR /var/www

# Composer

CMD php-fpm