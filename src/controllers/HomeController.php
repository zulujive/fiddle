<?php

class HomeController
{
    public function index()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/home.php';
    }
    public function style()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/css/style.css';
    }
}
