
FROM php:8.3-apache


RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


COPY . /var/www/html/


RUN chown -R www-data:www-data /var/www/html/


RUN composer install --no-interaction --prefer-dist


EXPOSE 80


CMD ["apache2-foreground"]
