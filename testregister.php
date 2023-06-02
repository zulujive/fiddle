<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;

require_once 'vendor/autoload.php';

// Register a new user
Sentinel::register([
    'email'    => 'test@example.com',
    'password' => 'foobar',
]);