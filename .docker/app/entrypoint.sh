#!/usr/bin/env bash

set -e

##paste env variables
echo "parameters:" \
> ./app/config/env.neon

env \
| grep ^APP_ \
| sort \
| sed 's/=/: "/' \
| sed 's/$/"/' \
| sed 's/^/\t/' \
>> ./app/config/env.neon


[[ -d vendor ]] || composer install
php www/index.php migrations:continue
php www/index.php rabbitmq:setup-fabric
supervisord -c /var/www/html/config/supervisor.conf
/etc/init.d/cron start

exec apache2-foreground "$@"