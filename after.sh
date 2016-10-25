cd /home/vagrant/userlist/
cp .env.example .env
php artisan migrate
php artisan db:seed