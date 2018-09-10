FROM php:7.1.8-fpm-alpine

# Timezone and locale
ENV TIMEZONE Europe/Moscow
ENV TZ Europe/Moscow
ENV LIBSODIUM_VERSION 1.0.6

RUN apk update \
    && apk add mysql libxml2-dev tzdata zlib-dev curl-dev \
    && docker-php-ext-install mysqli pdo opcache pdo_mysql soap \
    && docker-php-ext-install zip curl mbstring tokenizer \
    && cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime  \
    && echo "${TIMEZONE}" > /etc/timezone \
    && apk del tzdata \
    && apk del mysql \
    && apk add libpq

RUN apk add --update wget ca-certificates autoconf gcc g++ binutils make libsodium-dev \
    && pecl install libsodium-${LIBSODIUM_VERSION} \
    && echo "extension=libsodium.so" >> /usr/local/etc/php/php.ini \
    && apk del wget ca-certificates autoconf gcc g++ binutils make


# add app user
RUN adduser -D -u 1000 appuser \
    && addgroup appuser www-data \
    && addgroup www-data appuser

# add composer
RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php \
#    && php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) === '7228c001f88bee97506740ef0888240bd8a760b046ee16db8f4095c0d8d525f2367663f22a46b48d072c816e7fe19959') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    && echo 'date.timezone = ${TIMEZONE}' >> /usr/local/etc/php/php.ini
USER 1000

env PATH /home/appuser/.composer/vendor/bin/:$PATH

WORKDIR /app/htdocs
