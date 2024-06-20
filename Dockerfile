#FROM 339713191041.dkr.ecr.eu-north-1.amazonaws.com/seifeddine.jeddey:php

FROM php:8.3-fpm

# Set Environment Variables
RUN apt-get update && apt-get install -y --no-install-recommends vim curl locales apt-utils unzip
RUN apt-get install -y libzip-dev \
     && docker-php-ext-install zip

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libonig-dev; \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    # Install the PHP pdo_mysql extention
    docker-php-ext-install pdo_mysql; \
    # Install the PHP pdo_pgsql extention
    docker-php-ext-install pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd; \
    php -r 'var_dump(gd_info());' \
    \
RUN docker-php-ext-configure zip

COPY . /var/www/html
WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN set -eux; \
	composer install --prefer-dist --no-dev --no-scripts --no-progress; \
	composer clear-cache

COPY docker/php8/local-entrypoint.sh /usr/local/bin/local-entrypoint
RUN chmod +x /usr/local/bin/local-entrypoint
ENTRYPOINT ["local-entrypoint"]
CMD ["php-fpm"]

