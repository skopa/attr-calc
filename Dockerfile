FROM php:7.4-alpine

# Comment this to improve stability on "auto deploy" environments
RUN apk update && apk upgrade

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing PHP
RUN apk add --no-cache php \
    php-common \
    php-fpm \
    php-pdo \
    php-opcache \
    php-zip \
    php-phar \
    php-iconv \
    php-cli \
    php-curl \
    php-openssl \
    php-mbstring \
    php-tokenizer \
    php-fileinfo \
    php-json \
    php-xml \
    php-xmlwriter \
    php-simplexml \
    php-dom \
    php-pdo_mysql \
    php-pdo_sqlite \
    php-tokenizer

# Install dependencies
RUN docker-php-ext-install pdo_mysql bcmath

# Download trusted certs
RUN mkdir -p /etc/ssl/certs && update-ca-certificates

# Install composer
RUN cd /tmp && php -r "readfile('https://getcomposer.org/installer');" | php && \
	mv composer.phar /usr/bin/composer && \
	chmod +x /usr/bin/composer

# Install PHPUnit
RUN curl -sSL -o /usr/bin/phpunit https://phar.phpunit.de/phpunit.phar && chmod +x /usr/bin/phpunit

# Install current LTS node version
RUN apk add -U nodejs-current

# Install latest NPM
RUN curl -s -L npmjs.org/install.sh | sh

# Install Yarn
RUN npm i -g yarn

# Install build dependencies
RUN apk add autoconf automake g++ gcc libpng-dev libtool make nasm python3

# Expose container
WORKDIR /var/www

# Run application
CMD php -S 0.0.0.0:80 -t public

# Expose access
EXPOSE 80

HEALTHCHECK --interval=1m CMD curl -f http://localhost/ || exit 1
