release : php bin/console doctrine:migrations:migrate --no-interaction

web: heroku-php-nginx -C nginx_app.conf public/
