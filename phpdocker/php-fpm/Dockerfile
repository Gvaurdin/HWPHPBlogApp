FROM phpdockerio/php:8.4-fpm
WORKDIR "/BlogApp"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        git \
        php8.4-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN apt-get update && apt-get install -y --no-install-recommends \
    php8.4-mysql \
    php8.4-pgsql \
    php8.4-sqlite3 \
    php8.4-cli \
    php8.4-common \
    php8.4-pdo \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
