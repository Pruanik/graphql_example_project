FROM php:7.4-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip vim \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu mongodb \
    && docker-php-ext-enable apcu mongodb \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

### Install Symfony CLI
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install -y symfony-cli
