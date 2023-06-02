<?php

use Cartalyst\Sentinel\Native\Facades\Sentinel;

// Register a new user
Sentinel::register([
    'email'    => 'test@example.com',
    'password' => 'foobar',
]);