ARG PHP_VERSION=""
FROM php:${PHP_VERSION}-apache

LABEL maintainer="daniel.leivas@continuous.team"

# Install packages
RUN apt-get update \
    && apt-get install -y --no-install-recommends iputils-ping git curl vim zlib1g-dev libzip-dev zip unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# enable rewriting url
RUN a2enmod rewrite

# Install composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
       mv composer.phar /usr/local/bin/composer

# Cleaning
RUN rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www