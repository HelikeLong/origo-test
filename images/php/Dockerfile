FROM php:7.4-fpm-alpine
# lumen packages
RUN docker-php-ext-install tokenizer mysqli pdo_mysql
ADD . /var/www
RUN chown -R www-data:www-data /var/www