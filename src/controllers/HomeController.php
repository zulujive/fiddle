<?php
namespace Controllers\HomeController;

class HomeController
{
    public function index()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/home.php';
    }
}
