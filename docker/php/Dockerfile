FROM php:8.3-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y --no-install-recommends \
    zlib1g-dev \
    libzip-dev \
    curl \
    unzip \
    libfreetype6-dev  \
    libjpeg62-turbo-dev  \
    libpng-dev \
    libicu-dev \
    libmagickwand-dev

RUN pecl install imagick; \
    docker-php-ext-enable imagick;

RUN docker-php-ext-install soap sockets zip mysqli pdo pdo_mysql;

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd;

RUN docker-php-ext-configure intl \
	&& docker-php-ext-install intl;

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && php composer-setup.php --install-dir=/usr/local/bin --filename=composer;

COPY ./php.ini /usr/local/etc/php/php.ini

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY --chown=www:www . /var/www/html

USER www

EXPOSE 9000

CMD ["php-fpm"]
