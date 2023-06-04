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
    <br>
    <h1>FiddleAdmin</h1>
    <hr>
    <p>
        Welcome to FiddleAdmin! This page is still currently under development.<br>
        FiddleAdmin is an admin panel for Fiddle built with Bootstrap and is 
        managed by a PocketBase backend in a PB&J stack.
    </p>
    <form action="/logout" method="POST">
        <button class="btn btn-primary" type="submit">Logout</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>