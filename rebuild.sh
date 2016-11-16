#!/usr/bin/env bash
php app/console doctrine:database:drop --force
php app/console doctrine:database:create

./build.sh