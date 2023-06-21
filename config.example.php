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
//                 \/ \/ \/ \/ \/ \/ \/  Put URL here (no trailing slashes)
define('DB_HOST', 'http://127.0.0.1:8090');

//                \/ \/ \/ Put database password here (default "password")
define('DB_KEY', 'password');

/*-------------------------------------------------------
|                 --Server Settings--
|  Port number, firewall, etc.. Default settings work for
|  both production and development instances.
*/
//      \/ Name \/      \/ Port (usually anything except 80, 443, 22)
define('SET_PORTs', '7890');

/*-------------------------------------------------------
|                    --Rate Limiting--
|  Here you'll define rate limiting to prevent resource
|  usage and brute-force attacks (in minutes).
*/
//      \/ Name \/    \/ Rate Limit (in minutes)
define('LOGIN_LIMIT', 1);

/*-------------------------------------------------------
|                    --Display Errors--
|  False in production. Helps with debugging in
|  development and testing.
*/
//      \/ Name \/      \/ Setting (FALSE/true)
define('DISPLAY_ERRORS', true);

/*-------------------------------------------------------
|                 --Maintanance Mode--
|  If you need to disable the website, simply enable this
|  setting and edit message to your liking
*/
$maintenanceMode = false;
$maintenanceMessage = "The website is currently undergoing maintenance. We'll be back soon!";

?>