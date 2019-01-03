#!/usr/bin/env bash


cd "$(dirname "$0")"


rm -rf ../vendor

docker-compose exec monitoring \
    composer install


