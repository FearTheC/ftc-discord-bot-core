#!/bin/sh

USER_ID=${LOCAL_USER_ID:-9001}

cp -pf /app/phinx.yml.dist /app/phinx.yml

sed -i "s/host:/host: $FTCBOT_DB_HOST/g" /app/phinx.yml
sed -i "s/port:/port: $FTCBOT_DB_PORT/g" /app/phinx.yml
sed -i "s/user:/user: $FTCBOT_DB_USER/g" /app/phinx.yml
sed -i "s/pass: ''/pass: '$FTCBOT_DB_PASSWORD'/g" /app/phinx.yml
sed -i "s/name:/name: $FTCBOT_DB_DBNAME/g" /app/phinx.yml

vendor/bin/phinx migrate -v

exec "$@"
