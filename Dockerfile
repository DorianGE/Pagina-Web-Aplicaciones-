# Usamos una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instalamos extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitamos mod_rewrite
RUN a2enmod rewrite

# Copiamos los archivos del proyecto
COPY . /var/www/html/

# Damos permisos correctos al servidor web
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Establecemos el directorio base
WORKDIR /var/www/html

# Exponer puerto 80
EXPOSE 80
