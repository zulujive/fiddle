<?php
/*===========================================
|              FIDDLE AUTOLOADER            |
|  This file is for any file you'd like to  |
|  include that is used regularly and       |
|  globally. Don't use this for single-use  |
|  files as it may slow down execution time |
|==========================================*/

// Load the CSRF Utility
require_once __DIR__ . '/Csrf.php';