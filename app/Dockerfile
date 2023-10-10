FROM php:8.1-fpm

ENV DEBIAN_FRONTEND noninteractive

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
    # cron \
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

# RUN touch /var/log/cron.log; \
#     echo "* * * * * SHELL=/usr/bin/bash ; BASH_ENV=/container.env ; bash -c \"/usr/local/bin/php /var/www/bin/sitemap.php \" >> /var/log/cron.log 2>&1 " >> /etc/cron.d/sitemap; \
#     chmod 0644 /etc/cron.d/sitemap; \
#     crontab /etc/cron.d/sitemap;

RUN PATH=$PATH:/var/www/bin:bin

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www 

# CMD /usr/bin/bash -c "declare -p | grep -E 'DB_NAME|DB_USER|DB_HOST|DB_PASSWORD' > /container.env" ; \
#     /etc/init.d/cron start ; \
#     php-fpm -F

CMD php-fpm -F