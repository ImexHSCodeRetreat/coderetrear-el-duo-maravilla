FROM php:7.1-apache


RUN apt-get update \
    && apt-get install -y \
    openssl \
    unzip \
    libpq-dev \
    zlib1g-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install opcache \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && pecl install apcu-5.1.12 \
    && docker-php-ext-enable apcu

RUN a2enmod rewrite;
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY config/000-default.conf /etc/apache2/sites-enabled
COPY config/php.ini /usr/local/etc/php/

WORKDIR /var/www/back
