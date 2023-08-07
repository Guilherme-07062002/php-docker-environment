# Imagem base contendo o PHP
FROM php:latest

# Instalar extensões PHP necessárias (se aplicável)
# RUN docker-php-ext-install <nome_da_extensão>

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Copiar o código do projeto para o contêiner
COPY . /var/www/html

# Executar servidor web (por exemplo, para desenvolvimento local)
CMD ["php", "-S", "0.0.0.0:8000"]
