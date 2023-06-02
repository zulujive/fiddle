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
    <h1>PxlsFiddle Admin</h1>
    <br>
    <form class="container card" method="get" action="index.php" style="width: 40%;">
        <h3>Sign in</h3>
        <div class="form-group">
            <label for="username-login">Username</label>
            <input id="username-login" class="form-control" type="text" name="username">
        </div><br>
        <div class="form-group">
            <label for="pwd-login">Password</label>
            <input id="pwd-login" class="form-control" type="text" name="password">
        </div><br>
        <button class="btn btn-primary" type="button" style="width: 20%;">Submit</button><br>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>