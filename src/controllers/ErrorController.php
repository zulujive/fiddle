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
        function myErrorHandler() {
            echo "Error";
            exit();
        }
        
        if ($setting == true) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {
            set_error_handler("myErrorHandler");            
        }
        
    }
}
