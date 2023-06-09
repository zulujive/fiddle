<?php
use GuzzleHttp\Client;
require_once __DIR__ . '/../methods/Csrf.php';
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../dev.php';

if ($_SESSION["logged_in"] == true) {
    header("Location: /admin");
    exit();
}

$error_message = null;

// Implement rate limiting for login
$_SESSION["login_locked"] = false;
if (!isset($_SESSION["failed_logins"])) {
    $_SESSION["failed_logins"] = 0;
}
function failedLogin() {
    $failures = $_SESSION["failed_logins"] + 1;
    $_SESSION["failed_logins"] = $failures;
}
if ($_SESSION["failed_logins"] >= 3) {
    if (isset($_SESSION['unlock_time']) && time() >= $_SESSION['unlock_time']) {
        $_SESSION['locked'] = false;
        unset($_SESSION['unlock_time']);
        $_SESSION["failed_logins"] = 0;
    } else {
    $error_message = "Too many login attempts";
    $_SESSION["login_locked"] = true;
    }
}
if ($_SESSION["failed_logins"] == 2) {
    $_SESSION['unlock_time'] = time() + (LOGIN_LIMIT * 60);
}

// Only process if username and password are present and login is not locked
if (isset($_POST["username"]) && isset($_POST["password"]) && $_SESSION["login_locked"] == false) {
    Csrf::verifyToken();
    $username_unsanitized = $_POST["username"];
    $password_unsanitized = $_POST["password"];
  	$username = filter_var($username_unsanitized, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $hashedPassword = $password_unsanitized;

    $client = new Client(['defaults' => [ 'exceptions' => false ]] );

    try {
        $response = $client->post('' . DB_HOST . '/api/collections/admins/auth-with-password', [
            'json' => [
                'identity' => $username,
                'password' => $hashedPassword,
            ]
        ], ['http_errors' => false]);
        if ($response->getStatusCode() === 200) {
            
            $responseData = json_decode($response->getBody(), true);
            $record = $responseData['record'];

            $_SESSION["username"] = $record['username'];
            $_SESSION["userID"] = $record['id'];
            $_SESSION["pb_token"] = $responseData['token'];

            $_SESSION["failed_logins"] = 0;

            if ($record['2FA'] == true) {
                // Load OTP secret to session variable
                $_SESSION['secret'] = $record['2FASecret'];
                $_SESSION['2FA'] = true;
                header("Location: /login/2FA");
                exit();
            }
            $_SESSION["2FA"] = false;
            $_SESSION["logged_in"] = true;
            session_regenerate_id(true);
            header("Location: /admin");
            exit();
        }
    // Catch an HTTP error in the event of a login failure
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $error_message = "Invalid username and/or password";
        failedLogin();
    }
}

$csrfToken = Csrf::generateToken();

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
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
    <small class="d-flex mb-3 ms-3 justify-content-start align-items-end position-fixed bottom-0 start-0 px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Fiddle <?php echo $siteVersion ?></small>
    <small class="d-flex mb-3 me-3 justify-content-end align-items-end position-fixed bottom-0 end-0 px-2 py-1 fw-semibold text-warning-emphasis bg-warning-subtle border border-warning-subtle rounded-2">Created by zulujive</small>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>