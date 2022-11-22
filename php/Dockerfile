FROM php:7.2-apache
RUN mkdir -p /var/www/storage && chown -R www-data:www-data /var/www/storage
RUN apt-get update -y && apt-get install -y apache2-utils libaprutil1-dbd-mysql
RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis
RUN a2enmod authn_dbd
RUN docker-php-ext-install mysqli
WORKDIR /var/www/html
