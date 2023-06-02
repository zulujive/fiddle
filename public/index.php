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

$router->get('/templates/(.*)', function ($filename) {
    echo 'Hello world';
    
    $filePath = __DIR__ . '/../src/storage/templates/' . $filename;

    if (is_file($filePath)) {
        $mimeType = mime_content_type($filePath);
        header('Content-Type: ' . $mimeType);
        readfile($filePath);
    } else {
        http_response_code(404);
        echo 'File not found';
    }
});

$router->get("/templates/{filename}", function($filename){
    echo 'You asked for ' . $filename;
    //echo file_get_contents(__DIR__ . "/../src/storage/templates/".$filename.".png");
});

// Add more routes and map them to controllers

$router->run();