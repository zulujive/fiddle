<?php
require __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

$router->get('/', function () {
    echo 'Hello, World!';
});

$router->get('/login', function () {
    echo 'Login page';
});

// Add more routes as needed

$router->run();
