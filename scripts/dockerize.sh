# Run ./dependencies.sh

# Run composer and php commands
composer install

php artisan key:generate

php artisan db:wipe

php artisan migrate

php artisan db:seed

php artisan storage:link

chmod -R 755 storage

