FROM php:8.3-fpm

ENV DEBIAN_FRONTEND noninteractive

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
    curl \
    git \
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
    libonig-dev \
    zip; \
    rm -rf /var/lib/apt/lists/*

RUN pecl install redis

RUN set -eux; \
    docker-php-ext-install pdo_mysql; \
    docker-php-ext-install pdo_pgsql; \
    docker-php-ext-configure gd \
    --prefix=/usr \
    --with-jpeg \
    --with-webp \
    --with-xpm \
    --with-freetype; \
    docker-php-ext-install gd && \
    docker-php-ext-enable redis; 

COPY ./config/php.ini /usr/local/etc/php/php.ini
COPY ./config/php-fpm-pool.conf /usr/local/etc/php-fpm.d
COPY ./config/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN PATH=$PATH:/var/www/bin:bin

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www 

CMD php-fpm -F