<?php
require __DIR__ . '/../vendor/autoload.php';
include(dirname(__FILE__).'/../config.php');

// Make sure to put classes here:
require_once __DIR__ .'/../src/controllers/HomeController.php';

use Bramus\Router\Router;

$router = new Router();

if ($maintenanceMode) {
    // Redirect all traffic to the maintenance page
    echo $maintenanceMessage;
    exit();
}

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

$router->get("/templates/(.*)", function($filename){
    //echo 'You asked for ' . $filename;
    $templateImage = file_get_contents(__DIR__ . "/../src/storage/templates/".$filename."");
    header('Content-Type: image/jpeg');
    echo $templateImage;

});

// Add more routes and map them to controllers

$router->run();