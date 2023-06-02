<?php

// To use Fiddle, you must setup a mySQL or MariaDB database
// Put the host of the database configured here:
$hostDb = 'localhost';
// Put the name of the database configured here:
$dbName = 'fiddle';
// Put the username for the database here:
$dbUname = 'username';
// Put the password for the database here:
$dbPwd = 'password';

// Fiddle uses a simple authentication system for the admin panel.
// This feature will be overhauled soon, NEVER EVER use it in production
$valid_users = [
    "test" => "1234",
    // Add more authorized users here
];

?>