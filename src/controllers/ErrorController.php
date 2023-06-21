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
            $whoops = new \Whoops\Run;
            $whoops->register();
        }
    }
}
