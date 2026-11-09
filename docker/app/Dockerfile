# Entorno original: Laravel 5.5 requiere PHP 7.0-7.3
FROM php:7.2-apache

# La imagen se basa en Debian buster, ya movido a archive.debian.org
RUN printf 'deb http://archive.debian.org/debian buster main\ndeb http://archive.debian.org/debian-security buster/updates main\n' > /etc/apt/sources.list

# Extensiones: pdo_mysql (BD), gd y zip (dompdf / composer)
RUN apt-get update \
 && apt-get install -y --no-install-recommends libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git \
 && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr --with-freetype-dir=/usr \
 && docker-php-ext-install pdo_mysql gd zip \
 && rm -rf /var/lib/apt/lists/*

# Composer 1: symfony/thanks v1.0.5 del composer.lock no es compatible con Composer 2
RUN curl -fsSL https://getcomposer.org/download/latest-1.x/composer.phar -o /usr/local/bin/composer \
 && chmod +x /usr/local/bin/composer

# Apache sirve /public y permite las URLs amigables de Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
 && a2enmod rewrite

# www-data con el mismo UID/GID del usuario local, para que los archivos
# creados en el proyecto montado (vendor, storage) queden a su nombre
ARG UID=1000
ARG GID=1000
RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data

WORKDIR /var/www/html
