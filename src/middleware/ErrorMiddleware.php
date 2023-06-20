<?php

class errorHandler
{
    public static function errorHandle() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        set_error_handler(function ($severity, $message, $file, $line) {

            $error = "Error [$severity]: $message in $file on line $line";
            
            echo "<div style='background-color: #FEE; padding: 10px;'>$error</div>";
        
            error_log($error);
        
            return true;
        });        

    }
}