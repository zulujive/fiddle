<?php
// Start the session
session_start();

// Perform logout operation
session_destroy();

// Redirect to the login page or any other desired location
header("Location: /login");
exit();
?>
