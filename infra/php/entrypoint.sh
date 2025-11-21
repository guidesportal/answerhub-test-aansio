#!/bin/sh
set -e
cleanup() {
    echo "Running shutdown tasks..."
    php artisan cache:clear
    php artisan migrate:rollback
    rm /home/app/.migrated
    rm /home/app/.seeded
}
trap cleanup SIGTERM
if [ ! -f /home/app/.env ]; then
    cp /home/app/.env.example /home/app/.env
fi
if [ ! -f /home/app/.migrated ]; then
    php artisan migrate --force
    touch /home/app/.migrated
fi
if [ ! -f /home/app/.seeded ]; then
    php artisan db:seed --class=CreateTestData --force
    touch /home/app/.seeded
fi

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
        set -- php "$@"
fi

exec "$@" &
wait $!
