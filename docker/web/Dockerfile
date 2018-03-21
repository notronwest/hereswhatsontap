FROM php:7.1-apache

ENV WWW_UID 1000
ENV WWW_GID 1000

RUN apt-get update && apt-get -y install \
        apache2 \
        curl \
        git \
        zip \
        nano \
        mysql-client \
    && apt-get clean

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN docker-php-ext-install pdo pdo_mysql

COPY vhost.conf /etc/apache2/sites-available/000-default.conf
COPY xdebug.ini /etc/php/7.1/mods-available/xdebug.ini
COPY php.ini /usr/local/etc/php/

RUN usermod -u $WWW_UID www-data -s /bin/bash \
    && groupmod -g $WWW_GID www-data

RUN update-rc.d apache2 defaults && \
    a2enmod rewrite && \
    a2enmod ssl

WORKDIR /var/www/symfony

EXPOSE 80 443

ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
