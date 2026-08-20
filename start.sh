#!/bin/sh
envsubst '${PORT}' < /etc/nginx/sites-available/default.template > /etc/nginx/sites-available/default
php artisan migrate --force

PROGRAM_COUNT=$(php artisan tinker --execute="echo \App\Models\Program::count();")
if [ "$PROGRAM_COUNT" = "0" ]; then
    php artisan db:seed --force
fi

service nginx start
php-fpm