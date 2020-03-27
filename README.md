<p align="center">
    <h1 align="center">GIF browsing app</h1>
    <br>
    This is a prototype of a GIF browsing app.
    This the project is a laravel project uses Vue.js as front end layer.
    
</p>

DIRECTORY STRUCTURE
-------------------

      app/                contains laravel models and controllers
      bootstrap/          contains laravel files
      config/             contains application configurations
      database/           contains migration files
      public/             contains css,js,... files
      resources/          contains Vue.js files, laravel views, css and lang files
      routes/             contains routing files for laravel
      storage/            contains storage files
      tests/              contains test cases files
      vendor/             contains dependent 3rd-party packages

Vue.js DIRECTORY STRUCTURE (resources\js)
-------------------
      app.js               main file for Vue.js application
      auth.js              authentication file
      Index.vue            index file for Vue.js application
      Router\router.js     routing file
      plugins              Vue.js plugins
      admin                Vue.js views (dashborad, newimage form, searchhistory, ...)
      auth                 Login form
      components           404 page
      helpers              contains some useful components for application


## Installation
1-) Run command (using PHP 7.3) to install dependent 3rd-party packages
```
composer install
```
2-) Run command  to install Vue.js dependent 3rd-party packages
```
npm install
```
4-) Create Database and Update database configurations in .env file (DB section)
```
```
5-) Run command
```
php artisan migrate
```
6-) Run command 
```
php artisan jwt:secret
```

## Running app
1-) Run laravel project
```
php artisn serve
```
2-) Run npm
```
npm run watch
```

## GIF browsing app

After running application we have already user in DB to login into application

App url : http://localhost:8000/ 

Login Credentials is

Email : yasiralawa@gmail.com
Password : 102030 

Login has Recaptcha verification, then authentication will be using JWT token

After logging into application we must add new GIF photos with keywords from new image option.

Now we can search images in home page : http://localhost:8000/ by entering keywords and press enter.

We get first three results from any search operation and we can get more results by clicking Load More button.

By clicking on any image in result a modal will be opened contains image carousel start with the clicked image.

We can browse search history from history option in fome page, the result will be datatable shows date and keywords for each search operation, in datatable we have pagination and sorting on date.


## Test Cases

We have one test case for testing login with fake user

testcase tests\Feature\UserTest.php

we can run it 
```
php vendor/phpunit/phpunit/phpunit  --filter  {testLoginApi}
```