#!/bin/sh

USER_ID=${LOCAL_USER_ID:-9001}

vendor/bin/phinx migrate -e ${ENVIRONMENT} -v

exec "$@"
