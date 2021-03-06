<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

```composer install```

```cp .env.example .env```

```php artisan key:generate```

```php artisan config:cache```

```php artisan migrate```


For Job chain

```php artisan queue:work```

```php artisan schedule:run```  --- schedule

or

```docker-compose exec app php artisan vote:clear``` --- add job now



_________________________________

##Run in Docker container

```docker run --rm -v $(pwd):/app composer install```

```cp .env.example .env```

```php artisan storage:link```

```docker-compose up -d```

```docker-compose exec app php artisan key:generate```

```docker-compose exec app php artisan config:cache```

```docker-compose exec app php artisan migrate```


For Job chain 

```docker-compose exec app php artisan queue:work```

```docker-compose exec app php artisan schedule:run```  --- schedule

or

```docker-compose exec app php artisan vote:clear``` --- add job now 




Heroku url:

http://develops-today-test.herokuapp.com

Postman collection in root folder - Post Api.postman_collection.json
