FROM php:8.3-fpm
WORKDIR "/transfermate-php-test"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        git \
        curl \
        wget \
        libpq-dev \
        libxml2-dev \
        libxslt-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql xsl

RUN pecl install xmldiff