<?php
use OTPHP\TOTP;
use Src\Methods\Csrf;
//require_once __DIR__ . '/../../methods/Csrf.php';

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
    Csrf::verifyToken();

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