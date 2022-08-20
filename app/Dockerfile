FROM php:8.1-fpm-buster

ARG APP_PATH_CODE

# Copy composer.lock and composer.json
COPY ./$APP_PATH_CODE/composer.lock ./$APP_PATH_CODE/composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    libzip-dev \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    vim \
    unzip \
    git \
    curl \
    libcurl4-openssl-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# --------------------------------------
# Install extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Redis
RUN pecl install redis
RUN docker-php-ext-enable redis

RUN docker-php-ext-install soap

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# ADD USER
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# BORRAR
# Copy existing application directory contents
COPY ./$APP_PATH_CODE/ /var/www

# Copy existing application directory permissions
COPY --chown=www:www ./$APP_PATH_CODE/ /var/www
COPY --chown=www:www ./app/start.sh /usr/local/bin/start
RUN chmod u+x /usr/local/bin/start

# Change current user to www
USER www

CMD ["/usr/local/bin/start"]
