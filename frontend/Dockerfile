FROM php:8.1-apache

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && a2enmod rewrite headers expires mime

# Install Composer
RUN curl -sS https://getcomposer.org/installer  | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Aktifkan mod_rewrite untuk Apache
RUN a2enmod rewrite

# Clone repo Laravel
RUN git clone https://github.com/AlfitoAdityaProtic/FE-PBF-KRS.git  .

# Tandai direktori sebagai "safe" untuk Git
RUN git config --global --add safe.directory /var/www/html

# Instal ekstensi GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd

# Instal ekstensi ZIP
RUN docker-php-ext-install -j$(nproc) zip

# Install dependencies
RUN composer install

# Salin .env.example & generate key
COPY .env /var/www/html/.env
RUN php artisan key:generate

# Setup permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Atur dokumen root ke folder /public
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/' /etc/apache2/sites-available/000-default.conf


EXPOSE 80

CMD ["apache2-foreground"]