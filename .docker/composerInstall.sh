#!/usr/bin/env bash


cd "$(dirname "$0")"


rm -rf ../vendor

docker exec -t preklad_app \
	composer install


