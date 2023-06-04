<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
    header("Location: /login");
    exit();
}

if ($_SESSION["logged_in"] !== true) {
    header("Location: /login");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>FiddleAdmin</title>

    <style>
        body {
            margin: 1rem;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="d-flex align-items-center">
            FiddleAdmin <span class="badge bg-primary fs-7 ms-2">beta</span>
        </h1>
        <form action="/logout" method="POST">
            <button class="btn btn-primary">Logout</button>
        </form>
    </div>
    <hr>
    <p>
        Welcome to FiddleAdmin! This page is still currently under development.<br>
        FiddleAdmin is an admin panel for Fiddle built with Bootstrap and is 
        managed by a PocketBase backend in a PB&J stack.
    </p>
    <div class="card text-center">
        <div class="card-header bg-primary text-white shadow">
            Featured News and Updates
        </div>
        <div class="card-body">
            <h5 class="card-title">Admin Panel Coming Soon!</h5>
            <p class="card-text">
                It may not look exciting now, but we promise that we'll have 
                a brand new beautiful admin panel to go along with fiddle. 
                You'll be able to publish templates, manage users and 
                update configuration.
            </p>
        </div>
        <div class="card-footer text-body-secondary">
            6/4/2023
        </div>
    </div><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>