FROM php:7.2-fpm-alpine

RUN apk --update --no-cache add \
    git \
    postgresql-dev; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    docker-php-ext-install bcmath pgsql pdo pdo_pgsql && \
    sed -i '/phpize/i \
    [[ ! -f "config.m4" && -f "config0.m4" ]] && mv config0.m4 config.m4' \
    /usr/local/bin/docker-php-ext-configure && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    mkdir /app && \
    rm -rf /var/cache/apk/*

COPY ./src/ /app/src/
COPY ./public/ /app/public/
COPY ./config/ /app/config/
COPY ./composer.* /app/
COPY ./db/ /app/db/
COPY ./phinx.yml.dist /app/
COPY entrypoint.sh /

WORKDIR /app 

RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

#CMD ["php", "public/run.php"]
#CMD ["php", "public/run.php"]
