<?php

class HomeController
{
    public function index()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/home.php';
    }
    public function panelLogin() {
        require_once __DIR__ . '/../resources/views/home.php';
    }
}
