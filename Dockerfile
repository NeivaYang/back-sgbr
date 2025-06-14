# Etapa 1: Construção da Aplicação Laravel
FROM php:8.3-fpm AS builder

# Definir diretório de trabalho
WORKDIR /var/www

# Instalar dependências do sistema
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    build-essential \
    procps \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    nginx \
    supervisor \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring gd opcache \
    && docker-php-ext-install pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP necessárias (ex.: PDO para PostgreSQL e Zip)
RUN docker-php-ext-install pdo_pgsql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar arquivos do Laravel
COPY . .

RUN mkdir -p /var/www/storage/logs && touch /var/www/storage/logs/worker.log && chown -R www-data:www-data /var/www/storage

# Instalar dependências do Laravel
# RUN composer install --no-dev --optimize-autoloader

# Instalar pacotes do Node.js
# RUN npm install && npm run build

# Ajustar permissões corretas para storage e cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
# Ajusta as permissões (se necessário)
RUN chown -R www-data:www-data /var/www

# Copiar configuração do Supervisor e Nginx
COPY docker/supervisor/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf


# Copiar script de entrada
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expor porta do Nginx
EXPOSE 80

# Definir o ponto de entrada
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["php-fpm"]
