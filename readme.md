REQUIREMENTS
------------
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- lravel 5.2
- apache/nginx


- Web server supports PHP 7.1 or higher (apache2/nginx)
- Composer 
- Git
- htacess enabled on apache


INSTALLATION
------------
~~~
Git clone https://github.com/ramibadran/api.git
cd api
composer install
php artisian 
php artisan migrate
php artisan db:seed --class=ClientTableSeeder
php artisan l5-swagger:publish
php artisan l5-swagger:generate
php artisan serve --port=8080

~~~
You can use your browser to access the project application with the following URL:
~~~
http://localhost:8080/api/v1/token
http://localhost:8080/api/v1/hotels?city=AMM&fromDate=2019-02-13&toDate=2019-02-15&numberOfAdults=2
http://localhost:8080/api/documentation
~~~

### Project Details
This Project consume third part hotels API's and returned result as a json format based on user queries 


Notes
-----
after you run the project at you local dev wou will see the following:
jwt token will generate using the follwing api:
http://localhost:8080/api/v1/token
- username and password will be available after you run the seeder command
- user the credentials that will have it on clients table
- calling above api will generate an access token with ttl 1 hour
- each time you call the the api the token will refresh
- please refere to swagger documentation to check the api details

hotels api responsible to return data from third part based on user queries:
- you have to pass the access token which you generated from first api (token) and pass it as Bearer header token (check swagger documentation above)
- in custome file under config directory,you can add other provider to allow the project consume more api provider with some chnages should be applied 
on the fractal and factory technology

