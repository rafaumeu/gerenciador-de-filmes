FROM php:8.3-cli

# Instalar dependências do sistema e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    unzip \
    && docker-php-ext-install pdo pdo_sqlite

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . .

# Expor a porta 8888
EXPOSE 8888

# Inicializar banco se não existir e rodar servidor
CMD php setup_database.php && php -S 0.0.0.0:8888
