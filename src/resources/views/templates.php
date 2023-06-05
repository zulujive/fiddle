<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Templates</title>
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
                <a class="nav-link active" href="/admin/templates">Templates</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/admin/users">Users</a>
                </li>
            </ul>
            <form class="d-flex" action="/logout" method="POST">
                <button class="btn btn-primary" type="submit">Logout</button>
            </form>
            </div>
        </div>
    </nav>
</body>
</html>