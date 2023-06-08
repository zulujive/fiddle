<?php
/*
if (!isset($_SESSION['secret']))
{
    header("Location: /login");
    exit();
}
if ($_SESSION['logged_in'] == true)
{
    header("Location: /admin");
    exit();
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Verification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body class="m-4">
    
    <form class="card" action="/login/2FA" method="POST">
        <div class="form-group mt-3">
            <label for="OTP">Please enter your one-time key:</label>
            <input id="OTP" class="form-control shadow" type="text" name="OTP" required>
        </div>
        <button class="btn btn-primary" type="submit">Verify</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>