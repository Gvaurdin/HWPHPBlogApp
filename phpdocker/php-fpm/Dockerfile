FROM phpdockerio/php:8.1-fpm
WORKDIR "/BlogApp"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        git \
        php8.1-sqlite3 \
        php8.1-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
