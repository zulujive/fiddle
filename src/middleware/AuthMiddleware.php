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

$bootstrapStyleHash = 'sha256-fx038NkLY4U1TCrBDiu5FWPEa9eiZu01EiLryshJbCo=';
$bootstrapScriptHash = 'sha256-qlPVgvl+tZTCpcxYJFdHB/m6mDe84wRr+l81VoYPTgQ=';
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