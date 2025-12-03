# Usamos una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instalamos las extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitamos el módulo rewrite de Apache (útil para URLs amigables)
RUN a2enmod rewrite

# Copiamos los archivos de tu proyecto al servidor
COPY . /var/www/html/

# Le decimos a Render que use el puerto 80
EXPOSE 80