FROM php:8.1-fpm

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y libzip-dev zip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo_mysql

COPY --chown=www-data:www-data ./ ./

# Executar o composer install para instalar as dependências
RUN composer install

EXPOSE 8000

CMD ["php-fpm"]
