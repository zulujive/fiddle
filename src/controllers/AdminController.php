<?php

class AdminController
{
    public function panel() {
        require_once __DIR__ . '/../resources/views/panel.php';
    }
    public function panelLogin() {
        require_once __DIR__ . '/../resources/views/login.php';
    }
    public function panelLogout() {
        require_once __DIR__ . '/../resources/views/logout.php';
    }
    public function templatePanel() {
        require_once __DIR__ . '/../resources/views/templates.php';
    }
    public function userPanel() {
        require_once __DIR__ . '/../resources/views/users.php';
    }
}