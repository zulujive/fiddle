<?php
use OTPHP\TOTP;

if (isset($_POST["OTP"]))
{
    $secret = $_SESSION['secret'];
    $userOTP = $_POST["OTP"];

    $otp = TOTP::create($secret);
    if($otp->now() == $userOTP)
    {
        $_SESSION['logged_in'] = true;
        header("Location: /");
        exit();
    }
}