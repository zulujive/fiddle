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
        function check_for_fatal()
        {
            $error = error_get_last();
            if ( $error["type"] == E_ERROR )
                echo "Hello world";
        }

        function myErrorHandler() {
            echo "Error";
            exit();
        }

        if ($setting == true) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {
            register_shutdown_function( "check_for_fatal" );
            set_error_handler("myErrorHandler");
        }
        
    }
}
