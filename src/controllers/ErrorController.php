<?php

namespace Src\Controllers;

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

            register_shutdown_function("check_for_fatal");

            $httpResponse = http_response_code();

            if ($httpResponse !== '500') {
            } else {
            set_error_handler("myErrorHandler");
            }
        }
        
    }
    public function about500()
    {
        require_once __DIR__ . '/../resources/views/info/500.php';
    }
}
