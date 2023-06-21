<?php
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

require __DIR__ . '/../vendor/autoload.php';
include(dirname(__FILE__).'/../config.php');
require_once __DIR__ .'/../src/controllers/ErrorController.php';

$ErrorHandler = new ErrorController();
$ErrorHandler->enable(DISPLAY_ERRORS);

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


/* ------------------------------------------------------------
|                           ---Classes---
|  All classes (controllers) belong here, make sure to add them
|  before attempting to use a new controller!
*/
require_once __DIR__ .'/../src/controllers/HomeController.php';
require_once __DIR__ .'/../src/controllers/AdminController.php';
require_once __DIR__ .'/../src/controllers/AuthController.php';

// Do not touch zone
use Bramus\Router\Router;
$router = new Router();
include_once __DIR__ .'/../src/middleware/AuthMiddleware.php';

if ($maintenanceMode) {
    // Redirect all traffic to the maintenance page
    echo $maintenanceMessage;
    exit();
}

require __DIR__ . '/../src/web/routes.php';