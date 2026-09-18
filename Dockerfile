FROM php:8.4-cli

# Installer les dépendances système et les extensions PHP requises (dont intl)
RUN apt-get update && apt-get install -y \
    libicu-dev \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        intl \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        zip \
        bcmath \
        exif

# Copier Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer Node.js 22.x
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html

COPY . .

# Installer les dépendances PHP et Node.js + compiler les assets (Vite/Tailwind)
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Créer le lien symbolique pour le stockage d'images (important pour Laravel)
RUN php artisan storage:link

# Ajuster les permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

# Commande de démarrage : Réinitialise et remplit la base de données
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
