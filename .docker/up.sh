#!/usr/bin/env bash

cd "$(dirname "$0")"

docker-compose \
	up \
	--build \
	--remove-orphans \
	-d
