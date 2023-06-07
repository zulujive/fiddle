<?php

use GuzzleHttp\Client;
require_once __DIR__ . '/../methods/Csrf.php';
require_once __DIR__ . '/../methods/fetchStats.php';

$adminCount = fetchStats::countAdmins();
$userCount = fetchStats::countUsers();
$adminList = fetchStats::listAdmins();
$userList = fetchStats::listUsers();

$error_message = null;

$csrfToken = Csrf::generateToken();

if (!isset($_SESSION["registration_success"])) {
    $_SESSION["registration_success"] = null;
}

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
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2 m-0 d-flex min-height:100vh;">
      <nav class="navbar navbar-dark bg-primary flex-column m-0 flex-grow-1" style="margin-left:-1rem !important">
        <ul class="navbar-nav me-auto mb-lg-0 pb-3 m-0 ps-3">
            <li class="nav-item">
                <h3><a class="nav-link" href="/admin"><b>FiddleAdmin</b></a><h3>
            </li>
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
      </nav>
    </div>
    <div class="col-lg-10">
        <div class="m-4">
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $adminCount ?> Staff</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $userCount ?> Users</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form class="card bg-dark shadow p-3" method="post" action="/admin/register">
                        <h3 class="text-center">Create Staff Account</h3>
                        <?php 
                            if ($error_message !== null) {
                                $printed_error = '<div class="alert alert-warning mt-3 mb-0" role="alert">';
                                $printed_error .= $error_message;
                                $printed_error .= '</div>';
                                echo $printed_error;
                            }
                        ?>
                        <?php 
                            if ($_SESSION["registration_success"] === true) {
                                $success_message = '<div class="alert alert-success mt-3 mb-0" role="alert">';
                                $success_message .= 'User created successfully!';
                                $success_message .= '</div>';
                                echo $success_message;
                                $_SESSION["registration_success"] = null;
                            }
                        ?>
                        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                        <div class="form-group mt-3">
                            <label for="username-login">Username</label>
                            <input id="username-login" class="form-control bg-tertiary shadow" type="text" name="username" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="pwd-login">Password</label>
                            <input id="pwd-login" class="form-control bg-tertiary shadow" type="password" name="password" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="pwd-confirm">Confirm Password</label>
                            <input id="pwd-confirm" class="form-control bg-tertiary shadow" type="password" name="passwordConfirm" required>
                        </div>
                        <button class="btn btn-outline-secondary shadow mt-3 mb-3 w-50" type="submit" value="submit">Register</button>
                    </form>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card flex-fill p-3 shadow">
                        <h3 class="card-title">Staff</h3>
                        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                            <ul class="list-group list-group-flush">
                                <?php echo $adminList ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card flex-fill p-3 shadow">
                        <h3 class="card-title">Recent Signups</h3>
                        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                            <ul class="list-group list-group-flush">
                                <?php echo $userList ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>