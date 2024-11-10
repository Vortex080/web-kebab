# Usa la imagen base php:apache
FROM php:apache
# Instala las extensiones necesarias para MySQL/MariaDB
RUN docker-php-ext-install pdo pdo_mysql

# Opcional: Instala ping para pruebas de red
RUN apt-get update && apt-get install -y iputils-ping
