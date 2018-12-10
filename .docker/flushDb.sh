#!/usr/bin/env bash


cd "$(dirname "$0")"

echo "Stopping mysql.."
docker-compose stop mysql

echo "Deleting data.."
rm -rf ./_volumes/mysql-data/

echo "Starting mysql.."
docker-compose up -d mysql
