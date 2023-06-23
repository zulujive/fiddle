<?php
namespace Controllers\AdminController;

class AdminController
{
    public function panel() {
        require_once __DIR__ . '/../resources/views/panel.php';
    }
    public function templatePanel() {
        require_once __DIR__ . '/../resources/views/templates.php';
    }
    public function userPanel() {
        require_once __DIR__ . '/../resources/views/users.php';
    }
    public function newUser() {
        require_once __DIR__ . '/../resources/views/register.php';
    }
}