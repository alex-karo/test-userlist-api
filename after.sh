cd /home/vagrant/userlist/
cp .env.example .env
composer install > /dev/null 2>&1
php artisan migrate
php artisan db:seed