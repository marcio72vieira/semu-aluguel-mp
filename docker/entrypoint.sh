#!/bin/bash

# rm -r /var/www/vendor /var/www/composer.lock
# composer install
composer install --no-dev
chown -R www-data:www-data /var/www/html/storage

exec "$@"
