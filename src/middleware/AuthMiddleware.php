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
// ---------------------------------
// |   Content Security Policy     |
// ---------------------------------

$bootstrapStyleHash = 'sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM';
$bootstrapScriptHash = 'sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz';
$cloudflareCdn = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/*';

$cspHeader = "default-src 'self'; script-src 'self' '$bootstrapScriptHash'; style-src https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css '$bootstrapStyleHash' 'self' 'unsafe-inline'; img-src 'self'; font-src 'self' https://cdnjs.cloudflare.com/ajax/libs/font-awesome/*;";

header("Content-Security-Policy: " . $cspHeader);

// ---------------------------------
// |       Auth Middleware         |
// ---------------------------------
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