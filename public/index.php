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

$router->get('/style', function () {
    $cssFilePath = __DIR__ . '/../src/resources/css/style.css';
    if (file_exists($cssFilePath)) {
        header('Content-Type: text/css');
        readfile($cssFilePath);
    } else {
        http_response_code(404);
        echo '404 Not Found';
    }
});

$router->get('/login', function () {
    $controller = new HomeController();
    $controller->panelLogin();
});

$router->serve('/templates', __DIR__ . '/templates');

// Add more routes and map them to controllers

$router->run();