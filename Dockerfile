# Imagem base contendo o PHP
FROM php:latest

# Instalar extensões PHP necessárias (se aplicável)
# RUN docker-php-ext-install <nome_da_extensão>

# Instalar extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    zip \
    git

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar o Laravel CLI
RUN composer global require laravel/installer
ENV PATH "$PATH:/root/.composer/vendor/bin"

# Configurar diretório de trabalho
WORKDIR /app

# Executar servidor web para desenvolvimento local
CMD ["php", "-S", "0.0.0.0:8000"]
