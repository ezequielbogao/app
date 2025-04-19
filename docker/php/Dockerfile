FROM php:8.3-cli

#==========================================
# Cheycron Dockerfile for Laravel Apps
# Support at cheycron[at]gmail(dot)com
#==========================================

ENV PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"
ENV DEBIAN_FRONTEND="noninteractive"

# Arguments defined in docker-compose.yml
ARG USER=www-data
ARG UID=33
ARG GID=33

# Install system dependencies
USER root
RUN apt-get update -q \
	&& apt-get install -qq -y \
	curl \
	git \
	zip unzip \
	libpng-dev \
	libonig-dev \
	libxml2-dev \
	qpdf

# Install Node and NPM Package Manager
COPY --from=node:22-slim /usr/local/bin /usr/local/bin
COPY --from=node:22-slim /usr/local/lib/node_modules /usr/local/lib/node_modules

# Install PHP extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && install-php-extensions \
	bcmath bz2 calendar exif \
	gd intl ldap memcached \
	mysqli opcache pdo_mysql \
	pdo_pgsql pgsql redis  \
	soap xsl zip sockets pcov \
	imap msgpack swoole pcntl \
	igbinary xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cleanup
RUN apt-get -y autoremove \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copy PHP config files
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Set working directory
WORKDIR /var/www
# COPY . /var/www
EXPOSE 9000
VOLUME /var/www
USER ${USER}