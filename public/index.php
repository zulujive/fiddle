<?php
require __DIR__ . '/../vendor/autoload.php';

// Make sure to put classes here:
require_once __DIR__ .'/../src/controllers/HomeController.php';

use Bramus\Router\Router;

$router = new Router();

$router->get('/', function () {
    $controller = new HomeController();
    $controller->index();
});

$router->get('/login', function () {
    $controller = new HomeController();
    $controller->panelLogin();
});

// Add more routes and map them to controllers

$router->run();