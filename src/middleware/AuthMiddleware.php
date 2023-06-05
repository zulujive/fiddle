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

        $next();
    }
}

function isLoggedIn()
{
    // Check if user is logged in
    return $_SESSION['logged_in'];
}
