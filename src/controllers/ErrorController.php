<?php

class ErrorController
{
    public function notFound()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/404.php';
    }
    public function enable($setting)
    {
        if ($setting == true) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {
            set_error_handler(function ($severity, $message, $file, $line) {
                // Log the error
                error_log("Error [$severity]: $message in $file on line $line");
            
                // Display the custom error page
                echo 'Hello World!';
            
                // Stop script execution
                exit;
            });            
        }
    }
}
