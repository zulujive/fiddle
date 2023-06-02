<?php

require_once 'vendor/autoload.php';

use Cartalyst\Sentinel\Sentinel;

// Register a new user
Sentinel::register([
    'email'    => 'test@example.com',
    'password' => 'foobar',
]);