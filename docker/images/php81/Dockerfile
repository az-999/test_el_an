FROM php:8.1-cli-alpine

WORKDIR /app

COPY files/php/php.ini /usr/local/etc/php/conf.d/99-custom.ini

RUN apk --no-cache upgrade && \
    apk --no-cache add bash git curl libzip-dev oniguruma-dev autoconf g++ make brotli-dev linux-headers && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN pecl channel-update pecl.php.net && \
    printf '\n\n\n\n\n\n\n\n\n\n\n' | pecl install swoole-5.1.7 && \
    docker-php-ext-install mbstring pdo pdo_mysql bcmath zip pcntl && \
    docker-php-ext-enable swoole mbstring pdo pdo_mysql bcmath zip pcntl

COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8000
ENTRYPOINT ["/start.sh"]
