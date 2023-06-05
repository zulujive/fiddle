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

$router->before('GET|POST', '/admin', function() {
    if ($_SESSION['logged_in'] !== true) {
        header('Location: /login');
        exit();
    }
});