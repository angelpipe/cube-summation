# Cube summation

Solution to the hackerrank problem listed here https://www.hackerrank.com/challenges/cube-summation

## Code explanation

This app was made using Laravel, it means its layers adhere to Laravel's 
standards.

View is controlled by Laravel and some blade templates were created to 
provide minimal front end:
* /resources/views/base.blade.php
* /resources/views/index.blade.php
* /resources/views/parse.blade.php

Controller uses default Laravel's controller:
* /app/Http/Controllers/Controller.php

Business logic has two clases:
* /app/Cube/Parser.php: Its task is to receive and process all user input
* /app/Cube/Cube.php: Representation of the cube and its operations

There is no persistence layer.

Tests are under the tests folder.

## Requirements

* PHP >= 5.6.4

## How to run

```php artisan serve```

Then visit http://127.0.0.1:8000

IMPORTANT: The app will process any quantity of test cases, so the first 
input line with an integer is not necessary and will be marked as an error. 
Also, the app would be able to process any quantity of queries without 
specifying it; but this behavior was kept for integrity.

*Due the simplicity of the project, Laravel's default development server 
was used instead of homestead or docker as they would increase development
and set up*

## Github project

https://github.com/angelpipe/cube-summation
