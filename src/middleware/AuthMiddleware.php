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

$bootstrapStyleHash = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';
$bootstrapScriptHash = 'sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz';
$cloudflareCdn = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/*';

$cspHeader = "default-src 'self'; script-src 'self' '$bootstrapScriptHash'; style-src https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css $bootstrapStyleHash 'self' 'unsafe-inline'; img-src 'self'; font-src https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/*.woff2 'self' 'unsafe-inline';";

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