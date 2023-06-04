<?php
class Csrf
{
    public static function generateToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrf_token'] = $csrfToken;
        } else {
            $csrfToken = $_SESSION['csrf_token'];
        }
        return $csrfToken;
    }
    public static function verifyToken()
    {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            header("Location: /login");
            exit();
        }
    }
}