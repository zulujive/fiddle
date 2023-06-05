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

$bootstrapStyleHash = 'sha256-d0b418ae4b7d91889127767575c9ce57aa715c6215ef293fa030cb55b3b408c1';
$bootstrapScriptHash = 'sha256-432dcb740086c0389579a29ebdd4a6d5ec55238ed53df70710119b8ad03887fe';
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