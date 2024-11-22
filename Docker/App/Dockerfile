# Usa la imagen base php:apache
FROM php:apache
# Instala las extensiones necesarias para MySQL/MariaDB
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html
COPY . /var/www/html 