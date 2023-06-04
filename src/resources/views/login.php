<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
}

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
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            // CSRF token mismatch, handle the error or abort the request
            die("CSRF token validation failed.");
          }
        $_SESSION["logged_in"] = true;
        //$log_login = fopen("private/auth.log", "a") or die("Unable to open file!");
      	//$login_timestamp = date("Y-m-d H:i:s");
      	//fwrite($log_login, $username."     ");
      	//fwrite($log_login, $login_timestamp."\n");
      	//fclose($log_login);
        header("Location: /admin");
        session_regenerate_id(true);
        exit();
    } else {
        $error_message = "Invalid username and/or password";
    }
}

if (!isset($_SESSION['csrf_token'])) {
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;
} else {
    $csrfToken = $_SESSION['csrf_token'];
}

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
    <h1 class="text-center">PxlsFiddle Admin</h1>
    <br>
    <form class="container card bg-primary text-white shadow" method="post" action="/login" style="width: 40%;">
        <?php echo '<br><p>' . $error_message . '</p>'; ?>
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <div class="form-group">
            <label for="username-login">Username</label>
            <input id="username-login" class="form-control shadow" type="text" name="username" required>
        </div><br>
        <div class="form-group">
            <label for="pwd-login">Password</label>
            <input id="pwd-login" class="form-control shadow" type="password" name="password" required>
        </div><br>
        <button class="btn btn-light shadow" type="submit" value="submit" style="width: 20%;">Login</button><br>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>