# Usa a imagem oficial do PHP com Apache
FROM php:8.3-apache

# Instala extensões necessárias do PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Ativa o mod_rewrite (usado por frameworks como Laravel)
RUN a2enmod rewrite

# Aplica a configuração personalizada do Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
