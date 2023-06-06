<?php

require_once __DIR__ . '/../methods/Csrf.php';

$error_message = null;

$csrfToken = Csrf::generateToken();

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Users</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg mb-3 bg-body-tertiary border-bottom border-bottom-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="/admin">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/admin/templates">Templates</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="/admin/users">Users</a>
                </li>
            </ul>
            <form class="d-flex" action="/logout" method="POST">
                <button class="btn btn-primary" type="submit">Logout</button>
            </form>
            </div>
        </div>
    </nav>

    <br>
    <h2 class="d-flex align-items-center justify-content-center">
            Create User
    </h2>
    <br>
    <form class="container card bg-primary text-white shadow" method="post" action="/admin/register" style="width: 40%;">
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
        <button class="btn btn-light shadow mt-3 mb-3" type="submit" value="submit" style="width: 20%;">Register</button>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>