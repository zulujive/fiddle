<?php

use Src\Controllers\ErrorController;

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

$router->setBasePath(config('BASE_PATH'));

$router->setNamespace('Src\Controllers');

// Root route
$router->get('/', 'HomeController@index');
$router->get('/test', 'HomeController@test');

$router->get('/style', function () {
    $cssFilePath = __DIR__ . '/../resources/css/style.css';
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

$router->get('/admin', 'AdminController@panel');
$router->get('/admin/templates', 'AdminController@templatePanel');
$router->get('/admin/users', 'AdminController@userPanel');

// -------------------------------------

// Admin Authentication Routes

$router->get('/login', 'AuthController@panelLogin');
$router->post('/login', 'AuthController@panelLogin');
$router->post('/logout', 'AuthController@panelLogout');

$router->get('/login/2FA', 'AuthController@OTP');
$router->post('/login/2FA', 'AuthController@verifyOTP');

$router->get('/admin/enable2FA', 'AuthController@enableOTP');
$router->post('/admin/enable2FA', 'AuthController@deployOTP');
$router->get('/qrcode', 'AuthController@generateQR');

$router->post('/admin/register', 'AuthController@newUser');

// -------------------------------------

// Storage Routes
$router->get("/templates/(.*)", function($filename){
    $templateImage = PocketBaseUtils::serveTemplate($filename);
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