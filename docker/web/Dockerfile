FROM php:7.1-apache

ENV WWW_UID 1000
ENV WWW_GID 1000

RUN apt-get update && apt-get -y install \
        apache2 \
        curl \
        git \
        zip \
        nano \
    && apt-get clean

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
