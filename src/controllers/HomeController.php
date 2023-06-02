<?php

class HomeController
{
    public function index()
    {
        // Load the view
        require_once __DIR__ . '/../views/home.php';
    }
}
