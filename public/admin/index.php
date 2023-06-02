<?php



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
    <h1 class="text-center">PxlsFiddle Admin</h1>
    <br>
    <form class="container card bg-primary text-white shadow" method="get" action="index.php" style="width: 40%;"><br>
        <div class="form-group">
            <label for="username-login">Username</label>
            <input id="username-login shadow" class="form-control" type="text" name="username" required>
        </div><br>
        <div class="form-group">
            <label for="pwd-login">Password</label>
            <input id="pwd-login shadow" class="form-control" type="password" name="password" required>
        </div><br>
        <button class="btn btn-light shadow" type="submit" value="submit" style="width: 20%;">Login</button><br>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>