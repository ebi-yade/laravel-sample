FROM php:7.4.8-fpm-alpine

# Install packages and extensions depended on Laravel.
RUN apk --update-cache --no-cache add \
    curl \
    libzip-dev \
    libpng-dev \
    autoconf \
    gcc \
    g++ \
    make \
    git \
    bash \
    icu-dev \
    oniguruma-dev \
    # laravel-er-diagram-generatorに必要
    graphviz \
    fontconfig \
    # graphviz用フォントインストール
    && curl -O https://noto-website.storage.googleapis.com/pkgs/NotoSansCJKjp-hinted.zip \
    && mkdir -p /usr/share/fonts/NotoSansCJKjp \
    && unzip NotoSansCJKjp-hinted.zip -d /usr/share/fonts/NotoSansCJKjp/ \
    && rm NotoSansCJKjp-hinted.zip \
    && fc-cache -fv \
    # clear cache
    && rm -rf /var/cache/apk/* \
    && git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
    # Install dependencies for laravel.
    # https://laravel.com/docs/6.x
    && docker-php-ext-install \
    bcmath \
    pdo_mysql \
    mbstring \
    intl \
    zip \
    opcache \
    redis \
    gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
