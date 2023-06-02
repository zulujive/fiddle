<?php
require __DIR__ . '/../vendor/autoload.php';
require_once 'HomeController.php';

use Bramus\Router\Router;

$router = new Router();

$router->get('/', new HomeController());

$router->get('/login', function () {
    echo 'Login page';
});

// Add more routes as needed

$router->run();
