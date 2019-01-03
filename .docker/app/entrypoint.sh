#!/usr/bin/env bash

set -e

[[ -d vendor ]] ||composer install
php www/index.php migrations:continue
php www/index.php rabbitmq:setup-fabric
supervisord -c /var/www/html/config/supervisor.conf

exec apache2-foreground "$@"