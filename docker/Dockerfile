FROM php:7.2.6-fpm-stretch

WORKDIR /var/www/html/app

RUN echo "deb http://httpredir.debian.org/debian stretch-backports main non-free" >> /etc/apt/sources.list \
    && echo "deb-src http://httpredir.debian.org/debian stretch-backports main non-free" >> /etc/apt/sources.list \
    && apt-get update

RUN apt-get install -y \
        acl \
        nginx \
        vim \
        git \
        cron \
    --no-install-recommends

RUN docker-php-ext-install pdo_mysql

RUN apt-get install -y \
        libintl-perl \
        libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN apt-get install -y \
        libzip-dev \
        unzip \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

RUN apt-get install -y \
        libmcrypt-dev \
    && pecl install mcrypt-1.0.0 \
    && docker-php-ext-enable mcrypt

RUN apt-get install -y \
        libpng-dev \
    && docker-php-ext-install gd

# Configure nginx
RUN rm -rf /etc/nginx/conf.d/* \
    rm -f /etc/nginx/nginx.conf

ADD ./nginx/nginx.conf /etc/nginx/
ADD "./nginx/4yousee-php.conf" /etc/nginx/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get purge --auto-remove -y \
    && apt-get clean \
    && rm -rf /root/.composer/cache/* \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /usr/src/php*

RUN usermod -u 1000 www-data

ADD start.sh /scripts/start.sh

RUN chmod -Rf 755 /scripts

EXPOSE 80

CMD ["/scripts/start.sh"]