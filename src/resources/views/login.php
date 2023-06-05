<?php

require_once __DIR__ . '/../methods/Csrf.php';

if ($_SESSION["logged_in"] == true) {
    header("Location: /admin");
    exit();
}

$error_message = null;

include(dirname(__FILE__).'/../../../config.php');
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username_unsanitized = $_POST["username"];
    $password_unsanitized = $_POST["password"];
  	$username = filter_var($username_unsanitized, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $password = filter_var($password_unsanitized, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    if (isset($valid_users[$username]) && $valid_users[$username] == $password) {
        Csrf::verifyToken();
        $_SESSION["logged_in"] = true;
        header("Location: /admin");
        session_regenerate_id(true);
        exit();
    } else {
        $error_message = "Invalid username and/or password";
    }
}

$csrfToken = Csrf::generateToken();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Admin</title>
</head>
<body>
    <br>
    <h1 class="d-flex align-items-center justify-content-center">
            FiddleAdmin <span class="badge bg-secondary fs-7 ms-2 shadow-sm">beta</span>
    </h1>
    <br>
    <form class="container card bg-primary text-white shadow" method="post" action="/login" style="width: 40%;">
        <?php 
            if ($error_message !== null) {
                $printed_error = '<div class="alert alert-warning mt-3 mb-0" role="alert">';
                $printed_error .= $error_message;
                $printed_error .= '</div>';
                echo $printed_error;
            }
        ?>
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <div class="form-group mt-3">
            <label for="username-login">Username</label>
            <input id="username-login" class="form-control shadow" type="text" name="username" required>
        </div>
        <div class="form-group mt-3">
            <label for="pwd-login">Password</label>
            <input id="pwd-login" class="form-control shadow" type="password" name="password" required>
        </div>
        <button class="btn btn-light shadow mt-3 mb-3" type="submit" value="submit" style="width: 20%;">Login</button>
    </form>
    <small class="d-flex justify-content-start mb-3 align-items-end position-fixed bottom-0 start-0 px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Fiddle v0.0.0</small>
    <small class="d-flex justify-content-end me-3 align-items-end position-fixed bottom-0 end-0 px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Created by zulujive</small>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>