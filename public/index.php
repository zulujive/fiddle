<?php
require __DIR__ . '/../src/middleware/ErrorMiddleware.php';
new errorHandler();
errorHandler()->errorHandle();

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
// Begin the site-wide session
session_set_cookie_params([
    'SameSite' => 'Strict',
    'lifetime' => 3600,
]);
session_start();

date_default_timezone_set('America/Denver');

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
}

require __DIR__ . '/../vendor/autoload.php';
include(dirname(__FILE__).'/../config.php');

/* ------------------------------------------------------------
|                           ---Classes---
|  All classes (controllers) belong here, make sure to add them
|  before attempting to use a new controller!
*/
require_once __DIR__ .'/../src/controllers/HomeController.php';
require_once __DIR__ .'/../src/controllers/AdminController.php';
require_once __DIR__ .'/../src/controllers/ErrorController.php';
require_once __DIR__ .'/../src/controllers/AuthController.php';

// Do not touch zone
use Bramus\Router\Router;
$router = new Pouter();
include_once __DIR__ .'/../src/middleware/AuthMiddleware.php';

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

// Root route
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


$router->get('/admin', function () {
    $controller = new AdminController();
    $controller->panel();
});
$router->get('/admin/templates', function () {
    $controller = new AdminController();
    $controller->templatePanel();
});
$router->get('/admin/users', function () {
    $controller = new AdminController();
    $controller->userPanel();
});

// -------------------------------------

// Admin Authentication Routes

$router->get('/login', function () {
    $controller = new AuthController();
    $controller->panelLogin();
});
$router->post('/login', function () {
    $controller = new AuthController();
    $controller->panelLogin();
});

$router->post('/logout', function () {
    $controller = new AuthController();
    $controller->panelLogout();
});

$router->get('/login/2FA', function () {
    $controller = new AuthController();
    $controller->OTP();
});
$router->post('/login/2FA', function () {
    $controller = new AuthController();
    $controller->verifyOTP();
});
$router->get('/admin/enable2FA', function () {
    $controller = new AuthController();
    $controller->enableOTP();
});
$router->post('/admin/enable2FA', function () {
    $controller = new AuthController();
    $controller->deployOTP();
});
$router->get('/qrcode', function () {
    $controller = new AuthController();
    $controller->generateQR();
});

$router->post('/admin/register', function () {
    $controller = new AuthController();
    $controller->newUser();
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