<?php

/*
######################################################################
#                                                                    #
#                       ----Middleware----                           #
#  This file defines the pages that should be protected by           #
#  authentication. Remember that anything here will be executed      #
#  before any other routes.                                          #
#                                                                    #
######################################################################
*/

$bootstrapStyleHash = 'sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM';
$bootstrapScriptHash = 'sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz';
$cloudflareCdn = 'https://cdnjs.cloudflare.com';

$cspHeader = "default-src 'self'; script-src 'self' '$bootstrapScriptHash'; style-src 'self' '$bootstrapStyleHash'; img-src 'self';";

header("Content-Security-Policy: " . $cspHeader);

$router->before('GET|POST', '/admin', function() {
    if ($_SESSION['logged_in'] !== true) {
        header('Location: /login');
        exit();
    }
});
$router->before('GET|POST', '/admin/(.*)', function() {
    if ($_SESSION['logged_in'] !== true) {
        header('Location: /login');
        exit();
    }
});