#!/bin/sh

# .dockerignore strips the contents of these folders, so make sure they exist.
mkdir -p /var/www/storage/logs \
         /var/www/storage/framework/cache/data \
         /var/www/storage/framework/sessions \
         /var/www/storage/framework/views \
         /var/www/bootstrap/cache

envsubst '${PORT}' < /etc/nginx/sites-available/default.template > /etc/nginx/sites-available/default

# Stop the deploy loudly if the database is unreachable instead of serving a broken site.
php artisan migrate --force || exit 1

# Runs on every deploy; firstOrCreate means it never overwrites an existing password.
php artisan db:seed --class=SuperAdminSeeder --force

PROGRAM_COUNT=$(php artisan tinker --execute="echo \App\Models\Program::count();")
if [ "$PROGRAM_COUNT" = "0" ]; then
    php artisan db:seed --force
fi

# Demo accounts and requests. Only runs when SEED_DEMO_DATA=true is set in Render.
# Safe to leave on (it never duplicates), but remove the variable before real use.
if [ "$SEED_DEMO_DATA" = "true" ]; then
    php artisan db:seed --class=DemoDataSeeder --force
fi

# Everything above runs as root and may create files (like laravel.log) owned by root.
# php-fpm serves requests as www-data, so hand ownership back before starting.
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R ug+rwX /var/www/storage /var/www/bootstrap/cache

service nginx start
php-fpm