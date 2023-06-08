<?php

/*if ($_SESSION["logged_in"] !== true) {
    header("Location: /login");
    exit();
}*/

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>FiddleAdmin</title>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 m-0 d-flex" style="min-height:100vh;">
            <nav class="navbar navbar-dark bg-primary flex-column m-0 flex-grow-1" style="margin-left:-1rem !important">
                <ul class="navbar-nav me-auto mb-lg-0 pb-3 m-0 ps-3">
                    <li class="nav-item">
                        <h3><a class="nav-link text-white" href="/admin"><b>FiddleAdmin</b></a></h3>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/templates">Templates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/admin/users">Users</a>
                    </li>
                </ul>
                <form class="mt-auto d-flex align-items-start" action="/logout" method="POST">
                    <button class="btn btn-secondary btn-md shadow" type="submit" value="submit">Logout</button>
                </form>
            </nav>
        </div>
        <div class="col-lg-10">
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
            <!-- NO CONTENT PAST THE DIV -->
        </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>