FROM php:8.1-fpm-buster

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

#  apt-get update && \ インストール可能なパッケージの「一覧」を更新
RUN apt-get update && \
  # Laravelのインストールに必要なパッケージをインストール git,unzip,libzip-dev...
  apt-get -y install --no-install-recommends git unzip libzip-dev libicu-dev libonig-dev && \
  # ↓2行 パッケージインストールで使用したキャッシュファイルを削除
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  # PHPの拡張ライブラリをインストール
  docker-php-ext-install intl pdo_mysql zip bcmath 

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
RUN apt-get install -y nodejs

COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /data
