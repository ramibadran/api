# Hotels API

Hotels API is an API that consumes third party hotels APIs and returns the filtered results in JSON format based on user queries.

## Installing

After you have all the requirements setup, clone the project and start it by running the following commands in your terminal:

~~~
Git clone https://github.com/ramibadran/api.git
cd api
cp .env_stg .env (change the variable basd on your configurations) 
composer install
php artisan migrate
php artisan db:seed --class=ClientTableSeeder
php artisan l5-swagger:publish
php artisan l5-swagger:generate
php artisan serve --port=8080
~~~
Use the below URLs to verify your installation
~~~
http://localhost:8080/api/v1/token
http://localhost:8080/api/v1/hotels
http://localhost:8080/api/documentation
~~~

### Prerequisites

- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- laravel 5.2 (Follow the instructions in Laravel's documentation https://laravel.com/docs/5.7/installation)
- apache/nginx
- Web server supports PHP 7.1 or higher (apache2/nginx)
- Composer 
- Git
- htacess enabled on apache

## Running the tests
Composer test

## Deployment

N/A

## Built With

* [Laravel](https://laravel.com/docs/5.2) - The web framework used
* [Composer](https://getcomposer.org/doc/) - Dependency Management
* [Artisan](https://laravel.com/docs/5.0/artisan) - Used to generate RSS Feeds

## Authors

* **Rami Badran** 

