<?php
/*
============================================================
|                                                          |
|                   --CONFIGURATION--                      |
|  This file describes the important details of your       |
|  application. Please ensure all dependencies are         |
|  installed before you setup the file.                    |
|                                                          |
============================================================
*/
/*-------------------------------------------------------
|                    --PocketBase--
|  Setup a PocketBase database and fill out the following
|  parameters. Ensure you have a secure password set.
*/
// Put the host of the database configured here (no trailing slashes):
define('DB_HOST', 'http://127.0.0.1:8090');
// Put the database API key here:
define('DB_KEY', 'password');
/*-------------------------------------------------------
|                    --Rate Limiting--
|  Here you'll define rate limiting to prevent resource
|  usage and brute-force attacks (in minutes).
*/
define('LOGIN_LIMIT', 1);

// Enable or disable maintenance mode
$maintenanceMode = false;
$maintenanceMessage = "The website is currently undergoing maintenance. We'll be back soon!";

?>