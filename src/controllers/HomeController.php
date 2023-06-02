<?php

class HomeController
{
    public function index()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/home.php';
    }
    public function panelLogin() {
        echo 'Executing panelLogin()'; // Add this line for testing purposes
        // Rest of the code for handling the login logic
    }
}
