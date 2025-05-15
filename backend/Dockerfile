FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && a2enmod rewrite headers expires mime

WORKDIR /var/www/html

# Clone repo CodeIgniter dari GitHub
RUN git clone https://github.com/azkaxfannx/be-krs  .

# Setup permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]