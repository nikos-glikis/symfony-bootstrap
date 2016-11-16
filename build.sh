#!/usr/bin/env bash

if [ -n "$1" ]
then
    rm -rf var/cache/$1/
    rm -rf var/sessions/$1/
    php bin/console doctrine:schema:update --force --env=$1
else
    # clear all cache
    php app/console cache:clear --env=prod --no-debug
    php app/console cache:clear --env=dev --no-debug
    php app/console cache:clear --env=test --no-debug

    php app/console cache:warmup --env=prod --no-debug
    php app/console cache:warmup --env=dev --no-debug
    php app/console cache:warmup --env=test --no-debug

    php bin/console assetic:dump --env=prod --no-debug
    php bin/console assetic:dump --env=dev --no-debug
    php bin/console assetic:dump --env=test --no-debug

    # clear all sessions
    rm -rf var/sessions/dev/
    rm -rf var/sessions/prod/
    rm -rf var/sessions/test/

    # update all
    php app/console doctrine:schema:update --force --env=dev
    php app/console doctrine:schema:update --force --env=prod
    php app/console doctrine:schema:update --force --env=test
fi

rm -rf var/log/*.log
php app/console assetic:dump