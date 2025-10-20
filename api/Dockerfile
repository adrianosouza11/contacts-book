FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx supervisor \
    git \
    unzip \
    p7zip-full \
    libzip-dev \
    libicu-dev \
    zlib1g-dev \
    g++ \
    autoconf \
    make \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    nodejs \
    npm \
    --no-install-recommends \
            && rm -rf /var/lib/apt/lists/* # Limpa o cache do apt após a instalação

# Instala e habilita a extensão bcmath (já estava no seu arquivo)
RUN docker-php-ext-install bcmath && \
    docker-php-ext-enable bcmath

# --- Seção para as extensões GD e ZIP ---
# É crucial que as libs libpng-dev, libjpeg-dev, libfreetype6-dev e libzip-dev
# já estejam instaladas antes desses comandos.
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip

WORKDIR /var/www/html

COPY . .

# Limpar diretórios específicos do Laravel
RUN rm -rf /var/www/html/storage/* /var/www/html/bootstrap/cache/*

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Gera a chave da aplicação Laravel (se ainda não tiver uma)
#RUN php artisan key:generate

# Define permissões para o Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

# Define permissão para cache e storage (redundante com a linha acima, mas mantido para clareza)
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

COPY nginx.conf /etc/nginx/sites-available/default

# Expor as portas para Nginx e PHP-FPM
EXPOSE 80 9000

# Comando para iniciar o Nginx e PHP-FPM
CMD service nginx start && php-fpm
