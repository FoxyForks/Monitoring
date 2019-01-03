FROM php:7.1-apache
RUN a2enmod rewrite

RUN apt-get update -y \
&&  docker-php-ext-install pdo_mysql

ENV APACHE_DOCUMENT_ROOT /var/www/html/www
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


RUN apt-get update \
&&      apt-get install -y --no-install-recommends git zip \
&&      apt-get install -y zlib1g-dev \
&&      docker-php-ext-install zip

RUN cd /tmp \
&&      curl --silent --show-error https://getcomposer.org/installer | php \
&&      mv composer.phar /usr/local/bin/composer

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
&&      docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&&      docker-php-ext-install -j$(nproc) gd

RUN echo "memory_limit = -1" > /usr/local/etc/php/php.ini

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install mysqli

# supervisor installation &&
# create directory for child images to store configuration in
RUN apt-get -y install supervisor \
&&  mkdir -p /var/log/supervisor \
&&  mkdir -p /etc/supervisor/conf.d


COPY entrypoint.sh /usr/local/bin/entrypoint
CMD ["entrypoint"]