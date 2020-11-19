# FROM php:7.2-fpm
# https://qiita.com/lucaspoppy/items/9c31e03dae9a1995814c

FROM php:7.3-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
    && apt-get install -y \
                zlib1g-dev \
                libzip-dev \
                mariadb-client \
                git \
                zip \
                libfreetype6-dev \ 
                libjpeg62-turbo-dev \
                libpng-dev \
                libjpeg-dev \
    && docker-php-ext-install \
                pdo_mysql \
                bcmath \
                gd \
    && docker-php-ext-configure gd \
                --with-freetype-dir=/usr/include/ \
                --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Composer install
COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer

# rootでのcomposerコマンド実行を許可
ENV COMPOSER_ALLOW_SUPERUSER 1

# composerのグローバルパッケージがインストールされるディレクトリの指定
ENV COMPOSER_HOME /composer

# # composer使用時のみ、メモリ使用を無制限に設定
# ENV COMPOSER_MEMORY_LIMIT -1

# composerのパスを通す
ENV PATH $PATH:/composer/vendor/bin

# laravelインストール
RUN composer global require "laravel/installer"

# Node.js LTS/Latestのインストール
RUN curl -SL https://deb.nodesource.com/setup_12.x | bash
RUN apt-get install -y nodejs && \
    npm install -g npm@latest && \
    npm install -g @vue/cli

WORKDIR /var/www

RUN npm uninstall --save-dev sass-loader && npm install --save-dev sass-loader@7.1.0
