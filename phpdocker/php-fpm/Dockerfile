FROM phpdockerio/php:8.4-fpm
WORKDIR "/BlogApp"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        git \
        php8.4-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
