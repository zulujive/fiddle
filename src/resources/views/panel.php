<?php

/*if ($_SESSION["logged_in"] !== true) {
    header("Location: /login");
    exit();
}*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>FiddleAdmin</title>

</head>
<body>
    <nav class="navbar navbar-expand-lg mb-3 bg-dark border-bottom border-bottom-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Templates</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Users</a>
            </li>
        </ul>
        <form class="d-flex">
            <button class="btn btn-primary">Logout</button>
        </form>
        </div>
    </div>
    </nav>
    <div class="m-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="d-flex align-items-center">
                FiddleAdmin <span class="badge bg-primary fs-7 ms-2">beta</span>
            </h1>
        </div>
        <p>
            Welcome to FiddleAdmin! This page is still currently under development.<br>
            FiddleAdmin is an admin panel for Fiddle built with Bootstrap and is 
            managed by a PocketBase backend in a PB&J stack.
        </p>
        <div class="card text-center shadow">
            <div class="card-header bg-secondary text-white shadow">
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
        <div class="card text-center shadow">
            <div class="card-body">
                <h5 class="card-title">Routes are implemented!</h5>
                <p class="card-text">
                    Fiddle now uses routes to handle traffic instead 
                    of relying on a traditional web server approach. 
                    This means better scalability, modularity and 
                    organization in the long run!
                </p>
            </div>
            <div class="card-footer text-body-secondary">
                6/2/2023
            </div>
        </div><br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>