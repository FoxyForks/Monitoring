FROM sunfoxcz/php7-fpm

RUN apt-get update \
&&  apt-get -y install cron

# Add crontab file in the cron directory
ADD cron /etc/crontab

# Give execution rights on the cron job
RUN chmod 0644 /etc/crontab

CMD ["cron", "-f"]