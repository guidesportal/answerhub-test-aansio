FROM php:8.4.12RC1-cli-alpine3.21
LABEL authors="francescble"

RUN apk add --no-cache php84-dev autoconf g++ make gcc sudo
RUN apk add --no-cache \
    zip unzip curl libxml2-dev oniguruma-dev libzip-dev
RUN docker-php-ext-install mbstring pdo pdo_mysql xml simplexml bcmath zip
WORKDIR /home/app
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY . .
COPY infra/php/sudoers.d /etc/sudoers.d
COPY infra/php/entrypoint.sh /entrypoint
RUN chmod 755 /entrypoint
RUN adduser -D -h /home/app appuser && adduser appuser wheel && chmod 440 /etc/sudoers.d/*
RUN chown appuser -R /home/app
USER appuser
RUN composer install --no-interaction --prefer-dist
USER root
RUN ln -s /home/app/vendor/bin/php-cs-fixer /usr/sbin/php-cs-fixer
ENTRYPOINT ["/entrypoint"]
USER appuser
RUN php artisan config:clear

EXPOSE 8000
EXPOSE 8001
