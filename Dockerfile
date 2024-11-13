# Escolher a imagem base para PHP com Apache
FROM php:8.0-apache

# Instalar extensões PHP necessárias para Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar arquivos do projeto para o diretório padrão do Apache
COPY . /var/www/html

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Instalar as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Dar permissão de escrita para o diretório storage e bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Definir a porta padrão do Apache
EXPOSE 80

# Comando para iniciar o servidor Apache
CMD ["apache2-foreground"]
