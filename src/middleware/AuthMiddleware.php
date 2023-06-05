<?php

$router->before('GET|POST', '/admin', function() {
    if ($_SESSION['logged_in'] !== true) {
        header('Location: /login');
        exit();
    }
});