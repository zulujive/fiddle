<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enabling Dual Factor Authentication</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body class="m-4">

    <h1 class="text-center">Enable Multi-Factor Authentication</h1>
    <p>
        By enabling multi-factor authentication, you understand that it may be impossible 
        to recover your account data should you lose your authentication app. Always ensure 
        you have a readily available backup in case of device failure.
    </p>
    
    <form class="container card bg-success text-white shadow" action="/admin/enable2FA" method="POST">
        <div class="form-group mt-3 mb-3">
            <label for="pwd-login">Confirm with Password</label>
            <input id="pwd-login" class="form-control shadow mb-3" type="password" name="password" required>
        </div>
        <button class="btn btn-outline-light" type="submit" style="width:7rem">Confirm</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>