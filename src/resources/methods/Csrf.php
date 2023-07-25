<?php
class Csrf
{
    public static function generateToken()
    {
        $csrfToken = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $csrfToken;

        return $csrfToken;
    }
    public static function verifyToken()
    {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(400);
            echo "<body style=\"background-color: black; color: white; padding: 3rem;\">";
            echo "<h1>Error: 400</h1>";
            echo "<h3>Invalid CSRF token. Please enter the login page and try again.</h3>";
            echo "</body>";
            exit();
        }
    }
}