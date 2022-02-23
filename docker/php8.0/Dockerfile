FROM php:8.0-cli-alpine
RUN set -eux \
  && apk add --no-cache \
    bash \
    icu-libs \
  && apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    icu-dev \
  && docker-php-ext-install -j$(nproc) \
    intl \
  && apk del --no-cache .build-deps
WORKDIR /app
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
