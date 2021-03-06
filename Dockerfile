FROM php:7.3-rc-fpm-alpine3.8 as builder

RUN apk --update --no-cache add \
    git \
    postgresql-dev; \
    docker-php-ext-install bcmath pgsql pdo pdo_pgsql && \
    sed -i '/phpize/i \
    [[ ! -f "config.m4" && -f "config0.m4" ]] && mv config0.m4 config.m4' \
    /usr/local/bin/docker-php-ext-configure && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    mkdir /app && \
    rm -rf /var/cache/apk/*

COPY ./composer.* /app/
WORKDIR /app

RUN composer install --no-dev -o


FROM php:7.3-rc-fpm-alpine3.8

LABEL maintainer "Quentin Bonaventure <q.bonaventure@gmail.com>"

RUN apk --update --no-cache add \
    git \
    postgresql-dev; \
    docker-php-ext-install bcmath pgsql pdo pdo_pgsql && \
    sed -i '/phpize/i \
    [[ ! -f "config.m4" && -f "config0.m4" ]] && mv config0.m4 config.m4' \
    /usr/local/bin/docker-php-ext-configure && \
    mkdir /app && \
    rm -rf /var/cache/apk/*

WORKDIR /app
RUN ls
COPY --from=builder /app/vendor /app/vendor
COPY ./src/ /app/src/
COPY ./public/ /app/public/
COPY ./config/ /app/config/
COPY ./db/ /app/db/
# COPY ./phinx.yml /app/
COPY entrypoint.sh /

WORKDIR /app

RUN cp -pf /app/config/autoload/bot.local.php.dist /app/config/autoload/bot.local.php && \
    cp -pf /app/config/autoload/broker.local.php.dist /app/config/autoload/broker.local.php && \
    cp -pf /app/config/autoload/db.local.php.dist /app/config/autoload/db.local.php && \
    cp -pf /app/config/autoload/discord.local.php.dist /app/config/autoload/discord.local.php && \
#    cp -pf /app/phinx.yml.dist /app/phinx.yml && \
    chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

CMD ["php", "public/run.php"]
