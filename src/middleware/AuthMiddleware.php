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

$bootstrapStyleHash = 'sha256-3aebdbbbf7fb68bdc987c484705a9e8dafae0fdbed879ef98dda1e19e262425f';
$bootstrapScriptHash = 'sha256-aa53d582f97eb594c2a5cc5824574707f9ba9837bce3046bfa5f3556860f4e04';
$cloudflareCdn = 'https://cdnjs.cloudflare.com';

$cspHeader = "default-src 'self'; script-src 'self' $bootstrapScriptHash; style-src 'self' $bootstrapStyleHash 'unsafe-inline'; img-src 'self';";

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