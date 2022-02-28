<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Larablogger is blog create on Laravel framework  

The project has been inspired by Piotr Palarz Laravel course.
Course is for beginners, but contain very useful code.

## In this project I use.

- [laravel](https://laravel.com/docs/routing)
- [Custom template](https://www.larablogger.com)
- [Mysql](https://www.mysql.com/)

##  Instalation

```
Clone to yur local Pc folder
git clone https://github.com/Marcin13/larablogger.git

cd larablogger

composer update
composer install

cp .env.example .env

php artisan key:generate

Please file .env with yours credencial

APP_NAME=LaraBlogger
APP_ENV=local
APP_URL=http://larablogger.test

# Add this to make storage work #
FILESYSTEM_DRIVER=public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larablogger
DB_USERNAME=yourusername
DB_PASSWORD=yourpassword

php artisan migrate
php artisan bd:seed

php artisan storage:link

npm install
npm run dev
```
You can now open your project in the browser and run


