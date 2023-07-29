<?php
namespace src\methods;

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
            echo "<head>";
            echo "<link href=\"https:\/\/cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM\" crossorigin=\"anonymous\">";
            echo "</head>";
            echo "<body style=\"background-color: black; color: white; padding: 3rem;\">";
            echo "<h1>Error: 400</h1>";
            echo "<h3>Invalid CSRF token. Please enter the login page and try again.</h3>";
            echo "</body>";
            exit();
        }
    }
}