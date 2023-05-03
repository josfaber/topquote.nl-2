# # FROM php:7.4-fpm-alpine3.13
# # FROM php:8.0-fpm-alpine
# FROM php:8.1.5-fpm-alpine3.14

# ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
#     PHP_OPCACHE_MAX_ACCELERATED_FILES="20000" \
#     PHP_OPCACHE_MEMORY_CONSUMPTION="256" \
#     PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

# RUN apk add --no-cache --virtual \
#     bash \
#     curl \
#     freetype \
#     freetype-dev \
#     gd \
#     gd-dev \
#     git \
#     imagemagick \
#     imagemagick-dev \
#     libjpeg-turbo \
#     libjpeg-turbo-dev \
#     libpng \
#     libpng-dev \
#     libxpm \
#     libxpm-dev \
#     libzip-dev \
#     php-gd \
#     zip 

# RUN docker-php-ext-install pdo_mysql

# RUN apk add $PHPIZE_DEPS
# # RUN pecl install redis
# RUN docker-php-ext-configure zip && \
#     # docker-php-ext-configure gd --prefix=/usr --enable-gd --with-webp --with-jpeg --with-xpm --with-freetype
#     docker-php-ext-configure gd --enable-gd --with-webp --with-jpeg --with-xpm --with-freetype && \
#     docker-php-ext-install zip opcache && \
#     docker-php-ext-install gd 
# # RUN docker-php-ext-install -j$(nproc) gd 
# # RUN docker-php-ext-enable redis 

# RUN apk del --purge autoconf g++ make
# # RUN apk del --no-cache \
# #     freetype-dev \
# #     libjpeg-turbo-dev \
# #     libpng-dev \
# #     gd-dev \
# #     libzip-dev \
# #     libxpm-dev

# RUN rm -rf \
#     /tmp/* \
#     /var/cache/apk/* 
#     # /usr/src/php*

# WORKDIR /var/www

# COPY ./config/php.ini /usr/local/etc/php/php.ini
# COPY ./config/php-fpm-pool.conf /usr/local/etc/php-fpm.d
# COPY ./config/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# COPY . .

# RUN PATH=$PATH:/var/www/bin:bin

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
#     composer install

# CMD ["php-fpm", "-F"]




FROM php:8.1-fpm

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

CMD ["php-fpm", "-F"]