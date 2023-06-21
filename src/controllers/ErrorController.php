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
            if ( isset($error["type"]) && $error["type"] == E_ERROR )
                require_once __DIR__ . '/../resources/views/500.php';
                exit();
        }

        function myErrorHandler() {
            require_once __DIR__ . '/../resources/views/500.php';
            exit();
        }

        if ($setting == true) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {

            register_shutdown_function( "check_for_fatal" );

            $httpResponse = http_response_code();

            if ($httpResponse !== '500') {
            } else {
            set_error_handler("myErrorHandler");
            }
        }
        
    }
}
