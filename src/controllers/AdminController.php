<?php
namespace Src\Controllers;

class AdminController
{
    public function panel() {
        require_once __DIR__ . '/../resources/views/panel/panel.php';
    }
    public function templatePanel() {
        require_once __DIR__ . '/../resources/views/panel/templates.php';
    }
    public function userPanel() {
        require_once __DIR__ . '/../resources/views/panel/users.php';
    }
    public function newUser() {
        require_once __DIR__ . '/../resources/views/panel/auth/register.php';
    }
}