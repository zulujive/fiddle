<?php
class AuthMiddleware
{
    public function handle($req, $res, $next)
    {
        // Perform middleware logic here
        if (!isLoggedIn()) {
            // Redirect to the login page or return an unauthorized response
            header("Location: /login");
            exit();
        }

        // If the user is authenticated, proceed to the next middleware or route handler
        $next();
    }
}

function isLoggedIn()
{
    // Check if the user is logged in based on your authentication mechanism
    // For example, check if a specific session variable is set
    if (!isset($_SESSION['logged_in'])) {
        $_SESSION['logged_in'] = false;
    }
    return $_SESSION['logged_in'];
}
