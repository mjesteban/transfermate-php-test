FROM php:8.3-fpm-alpine
WORKDIR "/transfermate-php-test"

RUN apk update \
    && apk add  \
        postgresql-dev \
        libxml2-dev \
        libxslt-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql xsl

COPY crontab /etc/crontabs/root
RUN mkdir /var/log/cron

CMD ["crond", "-f"]