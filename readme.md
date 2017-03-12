## About Blog Profile Use Laravel and VueJs

## Required

 - Git
 - Composer
 - PHP v.7.x
 - Mysql v.5.7.x
 - Node
 - Npm
 - bower
 - webpack

## Setup for project

```sh
$ git clone git@github.com:dung13890/Blog-VueJs.git
$ composer install --no-scripts
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate:refresh --seed
$ npm install
$ bower install
$ npm run production
```

## Dev

```sh
$ npm run dev or $ npm run watch
```

## Test

```sh
$ phpunit
```
