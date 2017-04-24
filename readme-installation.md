# Requirements

PHP7

Database

 - mysql
 - mongodb

Service

 - elastic search
 - 

# Installations

cp .env.example .env
vim .env

composer selfupdate
composer install
composer dump -o

chmod -R 777 storage
chmod -R 777 public/sizeds

php artisan key:generate

### DB & Seed

php artisan migrate:refresh --seed
php artisan db:seed --class=DemoDatabaseSeeder

// Mongo index
http://xxx.xxx/power_admin/install/mongo_index


### Build Frontend

npm install bower -g
npm install gulp -g
npm install
bower install

cd resource/assets/semantic-ui
npm install

gulp
