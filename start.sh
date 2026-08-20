#!/bin/sh
envsubst '${PORT}' < /etc/nginx/sites-available/default.template > /etc/nginx/sites-available/default
php artisan migrate --force
service nginx start
php-fpm