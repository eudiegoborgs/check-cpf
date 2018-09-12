cd /var/www/html/app

composer install --no-progress --no-suggest -q  --no-interaction

php-fpm -D && nginx -g 'daemon off;'