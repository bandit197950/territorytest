FROM php:8.2-fpm

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

RUN apt-get update -y --fix-missing \
    && apt-get upgrade -y \
    && apt-get install -y \
        apt-utils \
    && apt-get install -y \
        libcurl4-gnutls-dev \
        libpq-dev \
        libzip-dev \
        libpng-dev \
        libldb-dev \
        libldap2-dev \
        libssl-dev \
        gpg \
        gnupg2 \
        software-properties-common \
        apt-transport-https \
        lsb-release \
        ca-certificates \
        gnupg \
        git \
        procps

RUN curl --silent --show-error https://getcomposer.org/installer | php \
	&& mkdir -p /usr/local/bin \
	&& mv composer.phar /usr/local/bin/composer \
	&& chmod +x  /usr/local/bin/composer


RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR /home/territorytest/code

RUN mkdir -p /home/composer && chmod 777 /home/composer

COPY ./docker/php/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

RUN composer install

ENTRYPOINT ["/entrypoint.sh"]
