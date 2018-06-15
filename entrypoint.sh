#!/bin/sh

USER_ID=${LOCAL_USER_ID:-9001}

cd /app && composer install --no-dev

cp /app/config/autoload/bot.local.php.dist /app/config/autoload/bot.local.php
cp /app/config/autoload/broker.local.php.dist /app/config/autoload/broker.local.php
cp /app/config/autoload/db.local.php.dist /app/config/autoload/db.local.php
cp /app/config/autoload/discord.local.php.dist /app/config/autoload/discord.local.php
cp /app/phinx.yml.dist /app/phinx.yml
#chown $USER_ID:$USER_ID phinx.yml
#chmod 777 phinx.yml

sed -i "s/'owner_id' => ''/'owner_id' => '$FTCBOT_OWNER_ID'/g" /app/config/autoload/bot.local.php

sed -i "s/'host' => ''/'host' => '$FTCBOT_BROKER_HOST'/g" /app/config/autoload/broker.local.php
sed -i "s/'port' => ''/'port' => '$FTCBOT_BROKER_PORT'/g" /app/config/autoload/broker.local.php
sed -i "s/'username' => ''/'username' => '$FTCBOT_BROKER_USERNAME'/g" /app/config/autoload/broker.local.php
sed -i "s/'password' => ''/'password' => '$FTCBOT_BROKER_PASSWORD'/g" /app/config/autoload/broker.local.php

sed -i "s/'host' => ''/'host' => '$FTCBOT_DB_HOST'/g" /app/config/autoload/db.local.php
sed -i "s/'port' => ''/'port' => '$FTCBOT_DB_PORT'/g" /app/config/autoload/db.local.php
sed -i "s/'user' => ''/'user' => '$FTCBOT_DB_USER'/g" /app/config/autoload/db.local.php
sed -i "s/'password' => ''/'password' => '$FTCBOT_DB_PASSWORD'/g" /app/config/autoload/db.local.php
sed -i "s/'database' => ''/'database' => '$FTCBOT_DB_DBNAME'/g" /app/config/autoload/db.local.php
sed -i "s/'server' => ''/'server' => '$FTCBOT_DB_CACHE_SERVER'/g" /app/config/autoload/db.local.php
sed -i "s/'version' => ''/'version' => '$FTCBOT_DB_CACHE_VERSION'/g" /app/config/autoload/db.local.php

sed -i "s/'token' => ''/'token' => '$FTCBOT_DISCORD_TOKEN'/g" /app/config/autoload/discord.local.php
sed -i "s/'auth_token' => ''/'auth_token' => '$FTCBOT_DISCORD_AUTH_TOKEN'/g" /app/config/autoload/discord.local.php

sed -i "s/host:/host: $FTCBOT_DB_HOST/g" /app/phinx.yml
sed -i "s/port:/port: $FTCBOT_DB_PORT/g" /app/phinx.yml
sed -i "s/user:/user: $FTCBOT_DB_USER/g" /app/phinx.yml
sed -i "s/pass: ''/pass: '$FTCBOT_DB_PASSWORD'/g" /app/phinx.yml
sed -i "s/name:/name: $FTCBOT_DB_DBNAME/g" /app/phinx.yml

sleep 3

vendor/bin/phinx migrate -v


exec php /app/public/run.php
