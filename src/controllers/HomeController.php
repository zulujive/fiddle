<?php
namespace Src\Controllers;

class HomeController
{
    public function index()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/home.php';
    }

    public function test()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/testTemplates.php';
    }
}
