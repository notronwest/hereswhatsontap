
FROM php:7.2.1-apache

MAINTAINER Pierre-Henri Bourdeau

# Debian dep
RUN apt-get update
RUN apt-get install -y nano

# Mysql
RUN apt-get install -y mysql-client && rm -rf /var/lib/apt

# Install php extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && chmod +x /usr/local/bin/composer

# Install debugger
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

# Bashrc
RUN rm /root/.bashrc
ADD .bashrc /root/.bashrc

# Cleaning
RUN rm -rf /etc/apache2/sites-available/* && rm -rf /etc/apache2/sites-enabled/*
RUN rm -rf /var/www/*

# Conf Apache2
RUN mkdir /var/www/app
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
ADD app.conf /etc/apache2/sites-available/app.conf
RUN usermod -u 1000 www-data
RUN a2ensite app.conf
RUN update-rc.d apache2 defaults && \
    a2enmod rewrite && \
    a2enmod ssl
RUN service apache2 restart

# PHP conf
ADD php.ini /usr/local/etc/php/php.ini
WORKDIR /var/www/app


EXPOSE 80