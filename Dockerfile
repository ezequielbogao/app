# Usar una imagen oficial de PHP con soporte para Composer y extensiones de Laravel
FROM php:8.2-fpm

# Instalación de dependencias necesarias
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# Instalación de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto (si los tienes)
COPY . .

# Instalar dependencias de Laravel
RUN composer install
