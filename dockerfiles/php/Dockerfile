# FROM php:7.4-fpm-alpine3.13
# FROM php:8.0-fpm-alpine
FROM php:8.1.5-fpm-alpine3.14

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="20000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="256" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

RUN apk add --no-cache bash curl gd gd-dev zip libzip-dev libxpm libxpm-dev libpng libpng-dev libjpeg-turbo libjpeg-turbo-dev freetype freetype-dev imagemagick imagemagick-dev 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN docker-php-ext-install pdo_mysql

RUN apk add $PHPIZE_DEPS
RUN pecl install redis
RUN docker-php-ext-configure zip 
RUN docker-php-ext-configure gd --enable-gd --with-webp --with-jpeg --with-xpm --with-freetype
RUN docker-php-ext-install zip opcache
RUN docker-php-ext-install -j$(nproc) gd 
RUN docker-php-ext-enable redis 

RUN apk del --purge autoconf g++ make
RUN apk del --no-cache freetype-dev libjpeg-turbo-dev libpng-dev gd-dev libzip-dev libxpm-dev

RUN rm -rf /tmp/*

WORKDIR /var/www

COPY ./dockerfiles/php/php.ini /usr/local/etc/php/php.ini
COPY ./dockerfiles/php/php-fpm-pool.conf /usr/local/etc/php-fpm.d
COPY ./dockerfiles/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY ./app/ /var/www

RUN PATH=$PATH:/var/www/bin:bin

RUN composer install

CMD ["php-fpm", "-F"]