#!/bin/sh
envsubst '${PORT}' < /etc/nginx/sites-available/default.template > /etc/nginx/sites-available/default
service nginx start
php-fpm