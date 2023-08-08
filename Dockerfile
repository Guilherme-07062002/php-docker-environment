# Imagem base contendo o PHP
FROM php:latest

# Instalar extensões PHP necessárias (se aplicável)
# RUN docker-php-ext-install <nome_da_extensão>

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configurar diretório de trabalho
WORKDIR /app

# Executar servidor web para desenvolvimento local
CMD ["php", "-S", "0.0.0.0:8000"]
