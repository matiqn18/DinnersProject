FROM php:8.1-apache

RUN apt-get update && apt-get install -y libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql mysqli

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite \
    && sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]

