FROM php:apache
RUN a2enmod authn_dbd
RUN docker-php-ext-install mysqli
RUN apt update && apt-get update && apt-get install -y libaprutil1-dbd-mysql && apt-get install -y git && apt install -y zlib1g-dev libpng-dev libgmp-dev
RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis && docker-php-ext-install gd
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir -p /var/www/storage && chown -R www-data:www-data /var/www/storage
WORKDIR /var/www/
RUN composer require amenadiel/jpgraph
RUN composer require --dev nelmio/alice
#install PHPunit
RUN curl -O https://phar.phpunit.de/phpunit-6.5.0.phar
RUN chmod +x phpunit-6.5.0.phar && mv phpunit-6.5.0.phar /usr/local/bin/phpunit
