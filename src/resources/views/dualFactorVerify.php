<?php
use OTPHP\TOTP;

if (!isset($_SESSION['secret']))
{
    header("Location: /login");
    exit();
}
if ($_SESSION['logged_in'] == true)
{
    header("Location: /admin");
    exit();
}
if ($_SESSION['secret'] == null)
{
    header("Location: /login");
    exit();
}



if (isset($_POST["OTP"]))
{
    $secret = $_SESSION['secret'];
    $userOTP = $_POST["OTP"];

    $otp = TOTP::create($secret);
    if($otp->now() == $userOTP)
    {
        $_SESSION['logged_in'] = true;
        header("Location: /admin");
        exit();
    } else {
        $_SESSION['secret'] = null;
        header("Location: /login");
        exit();
    }
}