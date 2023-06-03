<?php

class HomeController
{
    public function panel()
    {
        // Load the view
        require_once __DIR__ . '/../resources/views/panel.php';
    }
    public function panelLogin() {
        require_once __DIR__ . '/../resources/views/login.php';
    }
}