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
                echo "Oops, there was an error. If you are a developer, you can enable debugging for development environments.";
        }

        function myErrorHandler() {
            echo "Oops, there was an error. If you are a developer, you can enable debugging for development environments.";
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
