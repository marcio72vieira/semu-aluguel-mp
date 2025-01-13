FROM php:8.3-fpm

LABEL maintainer="ATI <contato@ati.ma.gov.br>" \
      version="1.0.0"

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    ghostscript \
    unzip && \

    # Install PHP extensions
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets intl zip && \

    # composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \

    # Clear cache
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html
# ENTRYPOINT ["/var/www/html/docker/entrypoint.sh"]

CMD ["php-fpm"]

EXPOSE 9000
