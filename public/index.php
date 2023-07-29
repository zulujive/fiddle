<?php
/*
######################################################################
#                                                                    #
#                   --Where Everything Begins--                      #
#  This file acts as the framework for the full application. Here    #
#  you'll find all the basic classes and methods that apply to the   #
#  entire application. All request first arrive here and are routed  #
#  based on certain parameters.                                      #
#                                                                    #
######################################################################
*/
ob_start();

require __DIR__ . '/../vendor/autoload.php';


use Bramus\Router\Router;
use Src\Controllers\ErrorController;


\Src\Methods\Environment::load();

$ErrorHandler = new ErrorController();
$ErrorHandler->enable(config('DISPLAY_ERRORS'));

// Begin the site-wide session
session_set_cookie_params([
    'SameSite' => 'Strict',
    'lifetime' => 432000,
]);
session_start();

date_default_timezone_set('America/Denver');

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
}


/* ------------------------------------------------------------
|                           ---Classes---
|  All classes (controllers) belong here, make sure to add them
|  before attempting to use a new controller!
*/

// Do not touch zone
$router = new Router();
include_once __DIR__ .'/../src/middleware/AuthMiddleware.php';
use Src\Methods\Pb\PocketBaseUtils;

if (config('MAINTENANCE_MODE')) {
    // Redirect all traffic to the maintenance page
    echo config('MAINTENANCE_MESSAGE');
    exit();
}

require __DIR__ . '/../src/web/routes.php';