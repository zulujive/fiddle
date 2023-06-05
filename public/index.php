<?php
session_set_cookie_params([
    'SameSite' => 'Strict',
    'lifetime' => 3600,
]);

session_start();

/*
######################################################################
#                                                                    #
#                         --PHP Routes--                             #
#  This file defines how traffic is routed based on its path. Best   #
#  practice is to use controllers (as defined in the controllers     #
#  folder). If you're confused, consult the documentation for Bramus #
#  router on GitHub.                                                 #
#                                                                    #
######################################################################
*/

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
}

require __DIR__ . '/../vendor/autoload.php';
include(dirname(__FILE__).'/../config.php');

// Make sure to put classes here:
require_once __DIR__ .'/../src/controllers/HomeController.php';
require_once __DIR__ .'/../src/controllers/AdminController.php';
require_once __DIR__ .'/../src/controllers/ErrorController.php';
require_once __DIR__ .'/../src/middleware/AuthMiddleware.php';

use Bramus\Router\Router;

$router = new Router();

// Instantiate the middleware class
$authMiddleware = new AuthMiddleware();

if ($maintenanceMode) {
    // Redirect all traffic to the maintenance page
    echo $maintenanceMessage;
    exit();
}
/*
-------------------------------------
|                                   |
|         Start Routes Here         |
|                                   |
-------------------------------------
*/

// Resource Routes
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

// -------------------------------------

// Admin Panel Routes (middleware applied)
$router->get('/login', function () {
    $controller = new AdminController();
    $controller->panelLogin();
});
$router->post('/login', [$authMiddleware, 'handle'], function () {
    $controller = new AdminController();
    $controller->panelLogin();
});
$router->post('/logout', [$authMiddleware, 'handle'], function () {
    $controller = new AdminController();
    $controller->panelLogout();
});
$router->get('/admin', [$authMiddleware, 'handle'], function () {
    $controller = new AdminController();
    $controller->panel();
});

// -------------------------------------

// Storage Routes
$router->get("/templates/(.*)", function($filename){
    $templateImage = file_get_contents(__DIR__ . "/../src/storage/templates/".$filename."");
    header('Content-Type: image/jpeg');
    echo $templateImage;

});

// -------------------------------------

// Error Routes
$router->set404(function () {
    http_response_code(404);
    $controller = new ErrorController();
    $controller->notFound();
});

// Add more routes and map them to controllers

$router->run();